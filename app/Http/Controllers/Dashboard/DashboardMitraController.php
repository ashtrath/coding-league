<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\MitraStatus;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardMitraController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $page = $request->input('page', 1);
        $query = Mitra::select(['user_id', 'name_mitra', 'name_company', 'phone_number', 'address', 'status',]);

        $mitras = $query->paginate($perPage, ['*'], 'page', $page);

        return Inertia::render('Dashboard/Mitra/index', [
            'data' => $mitras->items(),
            'pagination' => [
                'total' => $mitras->total(),
                'per_page' => $mitras->perPage(),
                'current_page' => $mitras->currentPage(),
                'last_page' => $mitras->lastPage(),
                'from' => $mitras->firstItem(),
                'to' => $mitras->lastItem(),
                'next_page_url' => $mitras->nextPageUrl(),
                'prev_page_url' => $mitras->previousPageUrl(),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/Mitra/create');
    }

    public function store(Request $request, User $user)
    {
        $validate = $request->validate([
            'name_mitra' => 'required|string|max:255',
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

            return redirect()->route('dashboard.profile.edit');
        } else {
            return redirect()->route('dashboard.mitra.index')->with('success', 'Mitra Berhasil Dibuat.');
        }
    }

    public function edit(Mitra $mitra)
    {
        return Inertia::render('Dashboard/Mitra/edit', ['mitra' => $mitra]);
    }

    public function show(Mitra $mitra)
    {
        return Inertia::render('Dashboard/Mitra/show', ['mitra' => $mitra]);
    }

    public function update(Request $request, Mitra $mitra)
    {
        $validate = $request->validate([
            'name_mitra' => 'required|string|max:255',
            'name_company' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'address' => 'required|string',
            'status' => 'required|in:' . implode(',', array_column(MitraStatus::cases(), 'value')),
        ]);

        $mitra->update($validate);

        return redirect()->route('dashboard.mitra.show', $mitra)->with('success', 'Mitra Berhasil Diupdate.');
    }

    public function destroy(Mitra $mitra)
    {
        $mitra->delete();
        return redirect()->route('dashboard.mitra.index')->with('success', 'Mitra Berhasil Dihapus.');
    }
}