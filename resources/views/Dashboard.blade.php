@extends('layouts.Layout.Layout')

@section('content')
<div class="content">
    <h1>Beranda</h1>
    <p>Selamat datang di Employment Self Service Politeknik Astra. Silahkan klik pada menu di atas untuk memulai menggunakan sistem ini.</p>
    
    <p>Panduan</p>
    <ul>
        <li>
            Pembuatan klaim pengobatan, kacamata, dan sumbangan rumah sakit
            <a href="#">klik disini.</a>
        </li>
        <li>
            Pembuatan cuti dan perizinan
            <a href="#">klik disini.</a>
        </li>
    </ul>
</div>

<div class="sidebar">
    <h2>Status Pemakaian</h2>
    <div class="progress-bar">
        <div class="progress large">84%</div>
    </div>

    <h2>Sisa Cuti</h2>
    <div class="progress-bar">
        <div class="progress small">3 hari</div>
    </div>
    
    <p>Klik pada grafik untuk detail lebih lanjut.</p>
</div>
@endsection