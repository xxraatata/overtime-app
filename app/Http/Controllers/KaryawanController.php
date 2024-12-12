<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\mskaryawan;
use Illuminate\View\View;

class KaryawanController extends Controller
{
    public function index(Request $request): View 
    {
        $search = $request->input('search');

        // Query pencarian 
        $karyawan = mskaryawan::when($search, function ($query, $search) {
            return $query->where('kry_id_alternative', 'like', "%$search%")
                         ->orWhere('kry_name', 'like', "%$search%");
        })->latest()->paginate(10);     

        return view('karyawan.index', compact('karyawan')); 
    }

    public function create(): View 
    {
        return view('karyawan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'kry_id_alternative'    => 'required|string|max:10',
            'kry_jabatan'           => 'required|string|max:50',
            'kry_name'              => 'required|string|max:100',
            'kry_username'          => 'required|string|max:50',
            'kry_password'          => 'required|string|max:50',
            'kry_email'             => 'required|string|max:100'
        ]);

        mskaryawan::create([
            'kry_id_alternative'    => $request->kry_id_alternative,
            'kry_jabatan'           => $request->kry_jabatan,
            'kry_name'              => $request->kry_name,
            'kry_username'          => $request->kry_username,
            'kry_password'          => $request->kry_password,
            'kry_email'             => $request->kry_email,
            'kry_status'            => 'Aktif',
            'kry_created_by'        => $request->kry_id_alternative,
            'kry_modified_by'       => $request->kry_id_alternative
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $karyawan = mskaryawan::findOrFail($id);

        // Tampilkan form edit 
        return view('karyawan.update', compact('karyawan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'kry_id_alternative'    => 'required|string|max:10',
            'kry_jabatan'           => 'required|string|max:50',
            'kry_name'              => 'required|string|max:100',
            'kry_username'          => 'required|string|max:50',
            'kry_password'          => 'required|string|max:50',
            'kry_email'             => 'required|string|max:100'
        ]);

        $karyawan = mskaryawan::findOrFail($id);

        $karyawan->update([
            'kry_id_alternative'    => $request->kry_id_alternative,
            'kry_jabatan'           => $request->kry_jabatan,
            'kry_name'              => $request->kry_name,
            'kry_username'          => $request->kry_username,
            'kry_password'          => $request->kry_password,
            'kry_email'             => $request->kry_email,
            'kry_status'            => 'Aktif',
            'kry_created_by'        => $request->kry_id_alternative,
            'kry_modified_by'       => $request->kry_id_alternative
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $karyawan = mskaryawan::findOrFail($id);

        // Mengubah status menjadi 0 (tidak aktif)
        $karyawan->update([
            'kry_status' => 'Tidak Aktif'
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
