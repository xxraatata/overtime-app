<html>
    <head>
        <title>
        Employee Self Service Politeknik Astra
        </title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </head>
    <body>
        <div class="header">
            <img alt="Politeknik Astra Logo" sizes="400%" src="https://www.polytechnic.astra.ac.id/storage/2024/03/Logogram-Astra.png">
            <div class="title">
                Employee Self Service
                <span class="subtitle">Politeknik Astra</span>
            </div>
            <div class="menu">
                <a href="{{ route('Dashboard') }}">Beranda</a>
                <a href="#">Kalender</a>
                <a href="#">Medical</a>
                <a href="#">Perizinan</a>
                <a href="#">Absensi</a>
                <a href="#">Laporan</a>
                <a href="{{ route('pengajuan.index') }}">Overtime</a>
                <a href="#">Notifikasi <span class="notification"> 15956</span> </a>
            </div>
            <div class="user">
                Hai, Ruci
            </div>
        </div>
        <div class="container">
            <div class="content">
                <h1>
                    Beranda
                </h1>
                <p>
                    Selamat datang di Employment Self Service Politeknik Astra. Silahkan klik pada menu di atas untuk memulai menggunakan sistem ini.
                </p>
                <p>
                    Panduan
                </p>
                <ul>
                    <li>
                        Pembuatan klaim pengobatan, kacamata, dan sumbangan rumah sakit
                        <a href="#">klik disini. </a>
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
                <div class="progress-bar">
                    <div class="progress" style="width: 0%;">
                </div>

            </div>
            <p>Klik pada grafik untuk detail lebih lanjut.</p>
        </div>
    </body>
</html>