<?php

namespace App\Http\Controllers;

use App\Enums\MitraStatus;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MitraController extends Controller
{

    public function index()
    {
        $mitras = Mitra::all();
        return Inertia::render('Mitra/Index', ['mitras' => $mitras]);
    }

    public function create()
    {
        return Inertia::render('Mitra/Create');
    }

    public function store(Request $request, User $user)
    {
        $validate = $request->validate([
            'name_company' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'address' => 'required|string',
        ]);

        $validate['status'] = MitraStatus::Active;

        Mitra::create($validate);

        if (Auth::check()) {
            if ($user && $user->first_time_user === 1) {
                $user->update(['first_time_user' => 0]);
            }

            return redirect()->route('profile.edit');
        } else {
            return redirect()->route('mitra.index')->with('success', 'Mitra Berhasil Dibuat.');
        }
    }

    public function edit(Mitra $mitra)
    {
        return Inertia::render('Mitra/Edit', ['mitra' => $mitra]);
    }

    public function show(Mitra $mitra)
    {
        return Inertia::render('Mitra/Show', ['mitra' => $mitra]);
    }

    public function update(Request $request, Mitra $mitra)
    {
        $validate = $request->validate([
            'name_company' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'address' => 'required|string',
            'status' => 'required|in:' . implode(',', array_column(MitraStatus::cases(), 'value')),
        ]);

        $mitra->update($validate);

        return redirect()->route('mitra.show', $mitra)->with('success', 'Mitra Berhasil Diupdate.');
    }

    public function destroy(Mitra $mitra)
    {
        $mitra->delete();
        return redirect()->route('mitra.index')->with('success', 'Mitra Berhasil Dihapus.');
    }
}
