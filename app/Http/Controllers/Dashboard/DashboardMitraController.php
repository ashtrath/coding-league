<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\MitraStatus;
use App\Enums\UserRole;
use App\Models\Mitra;
use App\Models\User;
use App\Notifications\MitraBaruNotification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardMitraController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);
        $query = Mitra::select([
            'mitras.id',
            'mitras.user_id',
            'mitras.name_mitra',
            'mitras.name_company',
            'mitras.status',
            'mitras.created_at',
            'users.description'
        ])
        ->join('users', 'mitras.user_id', '=', 'users.id');

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

        $mitra = Mitra::create($validate);

        if (Auth::check()) {
            if ($user && $user->first_time_user === 1) {
                $user->update(['first_time_user' => 0]);
            }

            return redirect()->route('dashboard.profile.edit');
        } else {
            $this->sendNotification($mitra);
            return redirect()->route('dashboard.mitra.index')->with('success', 'Mitra Berhasil Dibuat.');

        }
    }

    private function sendNotification(UserRole $mitra)
    {
        $adminUsers = User::where('role', UserRole::Admin)->get();

        foreach ($adminUsers as $admin) {
            $admin->notify(new MitraBaruNotification($mitra));  
        }
    }

    public function edit(string $id)
    {
        return Inertia::render('Dashboard/Mitra/edit', ['mitra' => $id]);
    }

    public function show(string $id)
    {
        return Inertia::render('Dashboard/Mitra/show', ['mitra' => $id]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name_mitra' => 'required|string|max:255',
            'name_company' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'address' => 'required|string',
            'status' => 'required|in:' . implode(',', array_column(MitraStatus::cases(), 'value')),
        ]);

        $mitra = Mitra::findOrFail($id);
        $mitra->update($validatedData);

        return redirect()->route('dashboard.mitra.show', $id)->with('success', 'Mitra Berhasil Diupdate.');
    }

    public function destroy(string $id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();
        return redirect()->route('dashboard.mitra.index')->with('success', 'Mitra Berhasil Dihapus.');
    }
}
