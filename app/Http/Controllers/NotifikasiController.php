<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\msnotifikasi;
use App\Models\trpengajuanovertime;
use Illuminate\View\View;

class NotifikasiController extends Controller
{
    public function index(Request $request): View 
    {
        $search = $request->input('search');

        // Query pencarian 
        $pengajuan = trpengajuanovertime::with('dpo_mskaryawan')
            ->when($search, function ($query, $search) {
                return $query->whereHas('dpo_mskaryawan', function ($query) use ($search) {
                    $query->where('kry_id_alternative', 'like' , "%$search%")
                    ->orWhere('kry_name', 'like', "%$search%");
                });
            })
            ->latest()->paginate(10);

        return view('pengajuan.index', compact('pengajuan')); 
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     // Validasi data
    //     $request->validate([
    //         'ntf_message'           => 'required|string|max:500',
    //     ]);

    //     msnotifikasi::create([
    //         'ntf_message'           => $request->ntf_message,
    //         'ntf_status'            => 'Belum Dibaca',
    //     ]);

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil ditambahkan.');
    // }

    public function update(Request $request, string $id): RedirectResponse
    {
        $notifikasi = msnotifikasi::findOrFail($id);

        $request->validate([
            'pjn_status'        => 'required|in:Disetujui,Ditolak', 
            'pjn_review_notes'  => $request->pjn_status === 'Ditolak' ? 'required|string|max:255' : 'nullable|string|max:255', // Notes wajib jika Ditolak
            'pjn_modified_by'   => 'required|string|max:50', // User pengubah
        ]);

        $notifikasi->update([
            'pjn_status'        => $request->pjn_status,
            'pjn_review_notes'  => $request->pjn_review_notes,
            'pjn_modified_by'   => $request->pjn_modified_by,
            'pjn_modified_date' => now(),
        ]);

        return redirect()->route('notifikasi.index')->with('success', 'Pengajuan berhasil ' . strtolower($request->pjn_status) . '.');
    }

}
