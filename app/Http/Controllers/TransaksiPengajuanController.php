<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class TransaksiPengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request): View 
    {
        $search = $request->input('search');
        
        // Panggil store procedure untuk mendapatkan data
        $pengajuan = DB::select('EXEC dbo.dpo_getPengajuanOvertime ?', [$search]);
        
        return view('pengajuan.index', [
            'pengajuan' => collect($pengajuan)->paginate(10)
        ]);
    }

    public function create(): View 
    {
        return view('pengajuan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'jenis_pengajuan' => 'required|exists:msjabatan,id',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Menyimpan file bukti jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('uploads/bukti', 'public');
        }

        // Panggil store procedure
        $result = DB::select('EXEC dbo.dpo_createPengajuanOvertime ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [
            $request->jenis_pengajuan, // p1
            $request->keterangan,      // p2
            null,                      // p3 (bukti excel)
            $buktiPath,                // p4 (bukti pdf)
            Auth::user()->kry_username,  // p5 (username)
            // Parameter 6-50 diisi null karena tidak digunakan
            ...array_fill(0, 45, null)
        ]);

        // Handle response dari store procedure
        if ($result[0]->hasil === 'OK') {
            return redirect()->route('pengajuan.index')
                ->with('success', 'Pengajuan berhasil disimpan. ID: ' . $result[0]->AlternativeID);
        } else {
            return back()->withErrors(['error' => $result[0]->hasil]);
        }
    }

    public function edit(string $id): View
    {
        // Panggil store procedure untuk mendapatkan data pengajuan
        $pengajuan = DB::select('EXEC dbo.dpo_getPengajuanById ?', [$id]);
        
        if (empty($pengajuan)) {
            abort(404, 'Pengajuan tidak ditemukan');
        }

        return view('pengajuan.update', [
            'pengajuan' => $pengajuan[0]
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'jenis_pengajuan' => 'required|exists:msjabatan,id',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Menyimpan file bukti jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('uploads/bukti', 'public');
        }

        // Panggil store procedure untuk update
        $result = DB::select('EXEC dbo.dpo_updatePengajuanOvertime ?, ?, ?, ?, ?, ?', [
            $id,
            $request->jenis_pengajuan,
            $request->keterangan,
            $request->tanggal,
            $buktiPath,
            Auth::user()->kry_username
        ]);

        if ($result[0]->hasil === 'OK') {
            return redirect()->route('pengajuan.index')
                ->with('success', 'Pengajuan berhasil diupdate.');
        } else {
            return back()->withErrors(['error' => $result[0]->hasil]);
        }
    }

    public function submit(string $id): RedirectResponse
    {
        // Panggil store procedure untuk submit pengajuan
        $result = DB::select('EXEC dbo.dpo_submitPengajuanOvertime ?, ?', [
            $id,
            Auth::user()->kry_username
        ]);

        if ($result[0]->hasil === 'OK') {
            return redirect()->route('pengajuan.index')
                ->with('success', 'Pengajuan berhasil diajukan.');
        } else {
            return back()->withErrors(['error' => $result[0]->hasil]);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        // Panggil store procedure untuk hapus pengajuan
        $result = DB::select('EXEC dbo.dpo_deletePengajuanOvertime ?', [$id]);

        if ($result[0]->hasil === 'OK') {
            return redirect()->route('pengajuan.index')
                ->with('success', 'Pengajuan berhasil dihapus.');
        } else {
            return back()->withErrors(['error' => $result[0]->hasil]);
        }
    }

}
