<?php

namespace App\Http\Controllers;

use App\Models\Riset;
use App\Models\Anggota_Riset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RisetController extends Controller
{
    // Display list of riset
    public function index()
    {
        $risets = Riset::with('anggota.user')
                     ->latest()
                     ->paginate(10); // 10 items per page
        return view('waka_humas.riset_inovasi_produk.index', compact('risets'));
    }

    // Show create form
    public function create()
    {
        $users = User::whereHas('roles', function($q) {
            $q->where('name', '!=', 'admin');
        })->orDoesntHave('roles')->get();
        return view('waka_humas.riset_inovasi_produk.create', compact('users'));
    }

    // Store new riset
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tim_riset' => 'required|array|min:1',
            'tim_riset.*' => 'exists:users,id',
            'file_proposal' => 'required|file|mimes:pdf|max:10240',
            'dokumentasi' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload files
        $proposalPath = $request->file('file_proposal')->store('public/riset/proposal');
        $dokumentasiPath = $request->file('dokumentasi')->store('public/riset/dokumentasi');

        // Create riset
        $riset = Riset::create([
            'topik' => $validated['topik'],
            'deskripsi' => $validated['deskripsi'],
            'tim_riset' => $validated['tim_riset'],
            'file_proposal' => $proposalPath,
            'dokumentasi' => $dokumentasiPath,
        ]);

        // Add team members
        foreach ($validated['tim_riset'] as $userId) {
            Anggota_Riset::create([
                'id_risets' => $riset->id,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('riset.index')->with('success', 'Riset berhasil diajukan');
    }

    // Show single riset
    public function show(Riset $riset)
    {
        $riset->load('anggota.user');
        return view('waka_humas.riset_inovasi_produk.show', compact('riset'));
    }

    // Show edit form
    public function edit(Riset $riset)
    {
        $users = User::whereHas('roles', function($q) {
            $q->where('name', '!=', 'admin');
        })->orDoesntHave('roles')->get();
        $selectedMembers = $riset->anggota->pluck('user_id')->toArray();
        return view('waka_humas.riset_inovasi_produk.edit', compact('riset', 'users', 'selectedMembers'));
    }

    // Update riset
    public function update(Request $request, Riset $riset)
    {
        $validated = $request->validate([
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tim_riset' => 'required|array|min:1',
            'tim_riset.*' => 'exists:users,id',
            'file_proposal' => 'nullable|file|mimes:pdf|max:10240',
            'dokumentasi' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update file if new one is uploaded
        if ($request->hasFile('file_proposal')) {
            Storage::delete($riset->file_proposal);
            $validated['file_proposal'] = $request->file('file_proposal')->store('public/riset/proposal');
        }

        if ($request->hasFile('dokumentasi')) {
            Storage::delete($riset->dokumentasi);
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('public/riset/dokumentasi');
        }

        // Update riset
        $riset->update($validated);

        // Update team members
        $riset->anggota()->delete();
        foreach ($validated['tim_riset'] as $userId) {
            Anggota_Riset::create([
                'id_risets' => $riset->id,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('riset.show', $riset)->with('success', 'Riset berhasil diperbarui');
    }

    // Delete riset
    public function destroy(Riset $riset)
    {
        Storage::delete([$riset->file_proposal, $riset->dokumentasi]);
        $riset->delete();
        return redirect()->route('riset.index')->with('success', 'Riset berhasil dihapus');
    }
}
