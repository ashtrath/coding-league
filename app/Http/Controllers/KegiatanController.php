<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('tags')->paginate(10);
        
        return Inertia::render('Kegiatan/Index', [
            'kegiatans' => $kegiatans
        ]);
    }

    public function create()
    {
        return Inertia::render('Kegiatan/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'content' => 'required|string',
            'image' => 'required|string|max:255',
            'status' => 'required|in:Terbit,Draft',
            'tags' => 'array',
            'tags.*' => 'string|max:20'
        ]);

        DB::transaction(function () use ($request) {
            $imagePath = $request->file('image')->store('kegiatan_images', 'public');

            // Membuat data kegiatan
            $kegiatan = Kegiatan::create([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'image' => $imagePath,
                'status' => $request->status,
            ]);

            // Menangani tag
            if ($request->has('tags')) {
                $tags = collect($request->tags)->map(function ($tagName) {
                    return Tag::firstOrCreate(['name' => $tagName]);
                });
                $kegiatan->tags()->sync($tags->pluck('id'));
            }
        });

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dibuat!');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('tags');
        
        return Inertia::render('Kegiatan/Show', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kegiatan->load('tags');
        
        return Inertia::render('Kegiatan/Edit', [
            'kegiatan' => $kegiatan,
            'tags' => $kegiatan->tags->pluck('name')
        ]);
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255',
            'status' => 'required|in:Terbit,Draft',
            'tags' => 'array',
            'tags.*' => 'string|max:20'
        ]);

        DB::transaction(function () use ($request, $kegiatan) {
            // Memperbarui data kegiatan
            $kegiatan->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
            ]);

            if ($request->hasFile('image')) {
                if ($kegiatan->image) {
                    Storage::disk('public')->delete($kegiatan->image);
                }
                $kegiatan->image = $request->file('image')->store('kegiatan_images', 'public');
                $kegiatan->save();
            }

            // Menangani tag
            if ($request->has('tags')) {
                $tags = collect($request->tags)->map(function ($tagName) {
                    return Tag::firstOrCreate(['name' => $tagName]);
                });
                $kegiatan->tags()->sync($tags->pluck('id'));
            } else {
                $kegiatan->tags()->detach();
            }
        });

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        DB::transaction(function () use ($kegiatan) {
            if ($kegiatan->image) {
                Storage::disk('public')->delete($kegiatan->image);
            }

            $kegiatan->tags()->detach();
            $kegiatan->delete();
        });

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function tags(Request $request)
    {
        $query = $request->input('query');
        $tags = Tag::where('name', 'like', "%{$query}%")->limit(10)->get();
        
        return response()->json($tags);
    }
}