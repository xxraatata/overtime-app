@extends('layouts.Layout.Layout')

@section('title', 'Tambah Pengajuan Overtime')

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Employee Self Service Politeknik Astra</a> / 
        <span>Riwayat Karyawan</span>
    </div>
    <div class="header">
        <div class="form-title">Tambah Pengajuan Overtime</div>
    </div>
    <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="col col-6">
                <label>Jenis Pengajuan <span class="required">*</span></label>
                <select name="jenis_pengajuan" required>
                    <option value="">-- Pilih Jenis Pengajuan --</option>
                    @foreach($jenisPengajuan as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-6">
                <label>Keterangan <span class="required">*</span></label>
                <input type="text" name="keterangan" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col col-6">
                <label>Tanggal <span class="required">*</span></label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="col col-6">
                <label>Bukti Penunjang</label>
                <input type="file" name="bukti">
            </div>
        </div>
        <div class="form-actions">
            <a href="{{ route('pengajuan.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">Simpan</button>
        </div>
    </form>
</div>
@endsection
