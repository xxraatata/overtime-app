<?php

namespace App\Http\Controllers;

use App\Models\trpengajuanovertime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function riwayat(Request $request): View
    {
        $pengajuan = trpengajuanovertime::where('pjn_kry_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pages.Karyawan.RiwayatKaryawan', compact('pengajuan'));
    }

    public function create(): View
    {
        return view('pages.Karyawan.TambahPengajuanKaryawan');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
            'bukti_excel' => 'required|file|mimes:xlsx,xls',
            'bukti_pdf' => 'required|file|mimes:pdf'
        ]);

        $excelPath = $request->file('bukti_excel')->store('public/overtime/excel');
        $pdfPath = $request->file('bukti_pdf')->store('public/overtime/pdf');

        trpengajuanovertime::create([
            'pjn_type' => $validated['jenis'],
            'pjn_description' => $validated['keterangan'],
            'pjn_excel_proof' => $excelPath,
            'pjn_pdf_proof' => $pdfPath,
            'pjn_status' => 'Pending',
            'pjn_created_by' => auth()->id(),
            'pjn_modified_by' => auth()->id(),
            'pjn_kry_id' => auth()->id()
        ]);

        return redirect()->route('karyawan.pengajuan')
            ->with('success', 'Pengajuan overtime berhasil dibuat');
    }

    public function edit(string $id): View
    {
        $pengajuan = trpengajuanovertime::where('pjn_kry_id', auth()->id())
            ->findOrFail($id);

        return view('pages.Karyawan.EditPengajuanKaryawan', compact('pengajuan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $pengajuan = trpengajuanovertime::where('pjn_kry_id', auth()->id())
            ->findOrFail($id);

        $validated = $request->validate([
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
            'bukti_excel' => 'nullable|file|mimes:xlsx,xls',
            'bukti_pdf' => 'nullable|file|mimes:pdf'
        ]);

        if ($request->hasFile('bukti_excel')) {
            Storage::delete($pengajuan->pjn_excel_proof);
            $excelPath = $request->file('bukti_excel')->store('public/overtime/excel');
            $pengajuan->pjn_excel_proof = $excelPath;
        }

        if ($request->hasFile('bukti_pdf')) {
            Storage::delete($pengajuan->pjn_pdf_proof);
            $pdfPath = $request->file('bukti_pdf')->store('public/overtime/pdf');
            $pengajuan->pjn_pdf_proof = $pdfPath;
        }

        $pengajuan->update([
            'pjn_type' => $validated['jenis'],
            'pjn_description' => $validated['keterangan'],
            'pjn_modified_by' => auth()->id()
        ]);

        return redirect()->route('karyawan.pengajuan')
            ->with('success', 'Pengajuan overtime berhasil diperbarui');
    }

    public function detail(string $id): View
    {
        $pengajuan = trpengajuanovertime::where('pjn_kry_id', auth()->id())
            ->with('dpo_mskaryawan')
            ->findOrFail($id);

        return view('pages.Karyawan.DetailPengajuanKaryawan', compact('pengajuan'));
    }
}
