<div class="menu">
    <a href="{{ route('Dashboard') }}" class="{{ request()->routeIs('Dashboard') ? 'active' : '' }}">Beranda</a>
    <a href="#" class="{{ request()->routeIs('calendar') ? 'active' : '' }}">Kalender</a>
    <a href="#" class="{{ request()->routeIs('medical') ? 'active' : '' }}">Medical</a>
    <a href="#" class="{{ request()->routeIs('permission') ? 'active' : '' }}">Perizinan</a>
    <a href="#" class="{{ request()->routeIs('attendance') ? 'active' : '' }}">Absensi</a>
    <a href="#" class="{{ request()->routeIs('report') ? 'active' : '' }}">Laporan</a>
    <a href="{{ route('pengajuan.index') }}" class="{{ request()->routeIs('pengajuan.*') ? 'active' : '' }}">Overtime</a>
    <a href="#" class="{{ request()->routeIs('notification') ? 'active' : '' }}">
        Notifikasi <span class="notification">{{ $notificationCount ?? 0 }}</span>
    </a>
</div> 