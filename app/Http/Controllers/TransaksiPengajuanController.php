<?php

namespace App\Http\Controllers;

use App\Models\msnotifikasi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\trpengajuanovertime;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class TransaksiPengajuanController extends Controller
{
    public function index(Request $request): View 
    {
        $search = $request->input('search');

        // Query pencarian 
        $pengajuan = trpengajuanovertime::with('dpo_mskaryawan')
            ->when($search, function ($query, $search) {
                return $query->whereHas('dpo_mskaryawan', function ($query) use ($search) {
                    $query->where('kry_name', 'like' , "%$search%");
                });
            })
            ->latest()->paginate(10);     

        return view('pengajuan.index', compact('pengajuan')); 
    }

    public function create(): View 
    {
        return view('pengajuan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pjn_type'              => 'required|string|max:50',
            'pjn_description'       => 'string|max:250',
            'pjn_excel_proof'       => 'nullable|mimes:xlsx, xls|max:10240',
            'pjn_pdf_proof'         => 'required|mimes:pdf|max:10240',
            'pjn_review_notes'      => 'nullable|string|max:250'
        ]);

        // Menyimpan file Excel jika ada
        $excel = null;
        if ($request->hasFile('pjn_excel_proof')) {
            $file = $request->file('pjn_excel_proof');
            $excel = $file->store('uploads/excel', 'public'); // Menyimpan file Excel
        }

        // Menyimpan file PDF 
        $pdf = null;
        if ($request->hasFile('pjn_pdf_proof')) {
            $file = $request->file('pjn_pdf_proof');
            $pdf = $file->store('uploads/pdf', 'public'); // Menyimpan file PDF
        }

        trpengajuanovertime::create([
            'pjn_type'              => $request->pjn_type,
            'pjn_description'       => $request->pjn_description,
            'pjn_excel_proof'       => $excel,
            'pjn_pdf_proof'         => $pdf,
            'pjn_review_notes'      => $request->pjn_review_notes,
            'pjn_status'            => 'Draft'
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil disimpan.');
    }

    public function edit(string $id): View
    {
        $pengajuan = trpengajuanovertime::findOrFail($id);

        // Tampilkan form edit 
        return view('pengajuan.update', compact('pengajuan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'pjn_type'              => 'required|string|max:50',
            'pjn_description'       => 'string|max:250',
            'pjn_excel_proof'       => 'nullable|mimes:xlsx, xls|max:10240',
            'pjn_pdf_proof'         => 'required|mimes:pdf|max:10240',
            'pjn_review_notes'      => 'nullable|string|max:250'
        ]);

        $pengajuan = trpengajuanovertime::findOrFail($id);

        // Menyimpan file Excel jika ada file baru
        $excel = $pengajuan->pjn_excel_proof; 
        if ($request->hasFile('pjn_excel_proof')) {
            // Hapus file lama jika ada
            if ($excel) {
                Storage::disk('public')->delete($excel);
            }
            // Simpan file baru
            $file = $request->file('pjn_excel_proof');
            $excel = $file->store('uploads/excel', 'public');
        }

        // Menyimpan file PDF jika ada file baru
        $pdf = $pengajuan->pjn_pdf_proof; 
        if ($request->hasFile('pjn_pdf_proof')) {
            // Hapus file lama jika ada
            if ($pdf) {
                Storage::disk('public')->delete($pdf);
            }
            // Simpan file baru
            $file = $request->file('pjn_pdf_proof');
            $pdf = $file->store('uploads/pdf', 'public');
        }

        $pengajuan->update([
            'pjn_type'              => $request->pjn_type,
            'pjn_description'       => $request->pjn_description,
            'pjn_excel_proof'       => $excel,
            'pjn_pdf_proof'         => $pdf,
            'pjn_review_notes'      => $request->pjn_review_notes,
            'pjn_status'            => 'Draft',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diupdate.');
    }

    public function submit(string $id): RedirectResponse
    {
        $pengajuan = trpengajuanovertime::findOrFail($id);

        $pengajuan->update([
            'pjn_status'        => 'Diajukan',
            // 'pjn_modified_by'   => auth()->user()->name ?? 'karyawan', // Sesuaikan dengan autentikasi
        ]);

        // Simpan notifikasi
        msnotifikasi::create([
            'status' => 'Belum Dibaca',
            'pjn_id' => $pengajuan->id,
            
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diajukan.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $pengajuan = trpengajuanovertime::findOrFail($id);

        // Hapus file yang diunggah jika ada
        if ($pengajuan->pjn_excel_proof) {
            Storage::disk('public')->delete($pengajuan->pjn_excel_proof);
        }

        if ($pengajuan->pjn_pdf_proof) {
            Storage::disk('public')->delete($pengajuan->pjn_pdf_proof);
        }

        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dihapus.');
    }

}
