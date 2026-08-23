<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna terstruktur berdasarkan role, pencarian, dan pagination.
     */
    public function index(Request $request)
    {
        $selectedRole = $request->query('role', 'all');
        $search = $request->query('search', '');
        $perPage = (int) $request->query('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $roles = Role::all();
        $totalAll = User::count();

        // Hitung jumlah user per role secara efisien
        $roleCounts = [];
        foreach ($roles as $r) {
            $roleCounts[$r->name] = User::role($r->name)->count();
        }

        // Query pengguna
        $query = User::with('roles')->latest();

        if ($selectedRole && $selectedRole !== 'all') {
            $query->role($selectedRole);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('kompetensi_keahlian', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate($perPage)->withQueryString();

        return view('admin.users.index', compact(
            'users',
            'roles',
            'selectedRole',
            'search',
            'totalAll',
            'roleCounts',
            'perPage'
        ));
    }

    /**
     * Memperbarui role dan kriteria user
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'jenis_guru' => 'nullable|string|in:guru pembimbing,guru produktif',
        ]);

        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat mengubah role admin untuk akun Anda sendiri.');
        }

        $user->syncRoles([$request->role]);

        if ($request->role === 'guru' && $request->has('jenis_guru')) {
            $user->update(['jenis_guru' => $request->jenis_guru]);
        } else {
            $user->update(['jenis_guru' => null]);
        }

        return redirect()->back()
            ->with('success', 'Role pengguna ' . $user->name . ' berhasil diperbarui menjadi ' . $request->role . '.');
    }
}