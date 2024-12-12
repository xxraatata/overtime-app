<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\msjabatan;
use Illuminate\View\View;

class JabatanController extends Controller
{
    public function index(Request $request): View 
    {
        $search = $request->input('search');

        // Query pencarian 
        $jabatan = msjabatan::when($search, function ($query, $search) {
            return $query->where('jbt_name', 'like', "%$search%");
        })->latest()->paginate(10);     

        return view('jabatan.index', compact('jabatan')); 
    }

    public function create(): View 
    {
        return view('jabatan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'jbt_name'              => 'required|string|max:50'
        ]);

        msjabatan::create([
            'jbt_name'              => $request->jbt_name,
            'jbt_status'            => 'Aktif',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $jabatan = msjabatan::findOrFail($id);

        // Tampilkan form edit 
        return view('jabatan.update', compact('jabatan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'jbt_name'              => 'required|string|max:50'
        ]);

        $jabatan = msjabatan::findOrFail($id);

        $jabatan->update([
            'jbt_name'              => $request->jbt_name,
            'jbt_status'            => 'Aktif',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diupdate.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $jabatan = msjabatan::findOrFail($id);

        // Mengubah status menjadi 0 (tidak aktif)
        $jabatan->update([
            'jbt_status' => 'Tidak Aktif'
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
