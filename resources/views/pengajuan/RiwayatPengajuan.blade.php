<html>
<head>
    <title>Sistem Informasi Akademik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('js/main.js') }}"></script>
</head>
<body>
    <div class="header">
        <div class="breadcrumb">
            <a href="{{ route('Dashboard') }}">Employee Self Service Politeknik Astra</a> / <span>Riwayat Karyawan</span>
        </div>
    </div>
    <div class="container">
        <div class="form-title">
            Riwayat Pengajuan Overtime
            <hr>
        </div>

        <button class="btn"><a href="{{ route('pengajuan.create') }}" style="color: white; text-decoration: none;">+ Tambah Baru</a></button>
        <br><br>
        
        <div class="search-bar">
            <input type="text" placeholder="Pencarian" name="cari">
            <button id="filterBtn" class="btn filter-btn" onclick="toggleFilter()">
                <i class="fas fa-filter"></i> <span>Filter</span>
            </button>

            <!-- Filter Popup -->
            <div id="filterPopup" class="filter-popup">
                <div class="form-group">
                    <label>Tanggal Mulai:</label>
                    <input type="date" id="startDate">
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir:</label>
                    <input type="date" id="endDate">
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select id="status">
                        <option value="">Semua</option>
                        <option value="draft">Draft</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Pengajuan:</label>
                    <select id="jenisPengajuan">
                        <option value="">Semua</option>
                        <option value="basis-data">Basis Data</option>
                        <option value="pemrograman">Pemrograman V</option>
                        <option value="rpl">Rekayasa Perangkat Lunak</option>
                    </select>
                </div>
                <div style="text-align: right; margin-top: 15px;">
                    <a href="{{ route('pengajuan.index') }}" class="btn-cancel">Batal</a>
                    <button class="btn" onclick="applyFilter()">Terapkan</button>
                </div>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">NIDN</th>
                    <th class="text-left">Nama</th>
                    <th class="text-left">Jenis Pengajuan</th>
                    <th class="text-left">Tanggal</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="draft">
                    <td class="text-center">1</td>
                    <td class="text-center">0987654321</td>
                    <td class="text-left">RADIT SURYA WIJAYA</td>
                    <td class="text-left">Basis Data</td>
                    <td class="text-left">Senin, 11 November 2024</td>
                    <td class="text-center">Draft</td>
                    <td class="text-center">
                        <i class="fas fa-paper-plane action-icon" onclick="window.location.href='Admin.html'"></i>
                        <i class="fas fa-pencil-alt action-icon" onclick="window.location.href='TambahPengajuanKaryawan.html'"></i>
                        <i class="fas fa-trash action-icon"></i>
                        <i class="fas fa-list action-icon" onclick="window.location.href='DetailPengajuanKaryawan.html'"></i>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">0987654321</td>
                    <td class="text-left">RADIT SURYA WIJAYA</td>
                    <td class="text-left">Pemrograman V</td>
                    <td class="text-left">Jumat, 8 November 2024</td>
                    <td class="text-center">Disetujui</td>
                    <td class="text-center">
                        <i class="fas fa-list action-icon"></i>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td class="text-center">0987654321</td>
                    <td class="text-left">RADIT SURYA WIJAYA</td>
                    <td class="text-left">Rekayasa Perangkat Lunak</td>
                    <td class="text-left">Jumat, 25 Oktober 2024</td>
                    <td class="text-center">Ditolak</td>
                    <td class="text-center">
                        <i class="fas fa-list action-icon"></i>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td class="text-center">0987654321</td>
                    <td class="text-left">RADIT SURYA WIJAYA</td>
                    <td class="text-left">Pemrograman V</td>
                    <td class="text-left">Jumat, 25 Oktober 2024</td>
                    <td class="text-center">Disetujui</td>
                    <td class="text-center">
                        <i class="fas fa-list action-icon"></i>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td class="text-center">0987654321</td>
                    <td class="text-left">RADIT SURYA WIJAYA</td>
                    <td class="text-left">Basis Data</td>
                    <td class="text-left">Senin, 18 November 2024</td>
                    <td class="text-center">Diajukan</td>
                    <td class="text-center">
                        <i class="fas fa-list action-icon"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>