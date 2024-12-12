<html>
<head>
    <title>Sistem Informasi Akademik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div class="header">
        <div class="breadcrumb">
            <a href="{{ route('Dashboard') }}">Employee Self Service Politeknik Astra</a> / <span>Riwayat Karyawan</span>
        </div>
    </div>
    <div class="container">
        <div class="form-title">
            Tambah Pengajuan Overtime
            <hr>
        </div>
        
        <form>
            <div class="form-group">
                <div class="col col-6">
                    <label for="jenis">Jenis Pengajuan <span class="required">*</span></label>
                    <select name="jenis" id="jenis" required>
                        <option disabled selected>-- Pilih Jenis Pengajuan --</option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
                <div class="col col-6">
                    <label for="keterangan">Keterangan <span class="required">*</span></label>
                    <input type="text" name="keterangan" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col col-6">
                    <label for="tanggal">Tanggal <span class="required">*</span></label>
                    <input type="date" name="tanggal" required>
                </div>
                <div class="col col-6">
                    <label for="bukti">Bukti Penunjang <span class="required">*</span></label>
                    <input type="file" name="bukti" required>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>