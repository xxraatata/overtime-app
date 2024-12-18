<?php

namespace App\Http\Controllers;

use App\Models\trpengajuanovertime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function dataPengajuan(Request $request): View
    {
        $search = $request->input('search');
        
        $pengajuan = trpengajuanovertime::with('dpo_mskaryawan')
            ->when($search, function ($query, $search) {
                return $query->whereHas('dpo_mskaryawan', function ($query) use ($search) {
                    $query->where('kry_name', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('pages.Admin.DataPengajuanKaryawan', compact('pengajuan'));
    }

    public function detailPengajuan(string $id): View
    {
        $pengajuan = trpengajuanovertime::with('dpo_mskaryawan')->findOrFail($id);
        return view('pages.Admin.DetailPengajuan', compact('pengajuan'));
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $pengajuan = trpengajuanovertime::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
            'review_notes' => 'required|string'
        ]);

        $pengajuan->update([
            'pjn_status' => $request->status,
            'pjn_review_notes' => $request->review_notes,
            'pjn_modified_by' => auth()->user()->kry_id
        ]);

        return redirect()->route('admin.pengajuan')
            ->with('success', 'Status pengajuan berhasil diperbarui');
    }
} 