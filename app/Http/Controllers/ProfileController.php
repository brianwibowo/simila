<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        
        // Calculate user summary stats based on their role
        $stats = [
            'role_name' => $user->roles->pluck('name')->first() ?? 'User',
            'created_at' => $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-',
            'verified' => !empty($user->email_verified_at),
        ];

        return view('profile.show', compact('user', 'stats'));
    }

    /**
     * Display the account settings page.
     */
    public function settings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'nis' => ['nullable', 'string', 'max:50'],
            'kompetensi_keahlian' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.current_password' => 'Kata sandi saat ini tidak cocok.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah!');
    }

    /**
     * Display user balance / activity & portfolio summary.
     */
    public function balance()
    {
        $user = Auth::user();
        
        // Activity & participation summary
        $activities = [
            'status_akun' => 'Aktif / Terverifikasi',
            'skor_keaktifan' => 95,
            'kredit_portofolio' => 120,
            'program_diikuti' => 4,
        ];

        return view('profile.balance', compact('user', 'activities'));
    }
}
