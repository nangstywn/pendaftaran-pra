<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.prodi.mahasiswa') ? 'active' : '' }}"
        href="{{ route('dosen.prodi.mahasiswa') }}">
        <span class="menu-icon">
            <span><i class="fas fa-user-friends fs-2x"></i></span>
        </span>
        <span class="menu-title">Daftar Mahasiswa</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.prodi.dosen') ? 'active' : '' }}" href="{{ route('dosen.prodi.dosen') }}">
        <span class="menu-icon">
            <span><i class="fas fa-user-graduate fs-2x"></i></span>
        </span>
        <span class="menu-title"> Daftar Dosen</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.prodi.bimbingan.*') ? 'active' : '' }}"
        href="{{ route('dosen.prodi.bimbingan.index') }}">
        <span class="menu-icon">
            <span><i class="far fa-file-word fs-2x"></i></span>
        </span>
        <span class="menu-title"> Bimbingan Pra</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.prodi.ujian.*') ? 'active' : '' }}"
        href="{{ route('dosen.prodi.ujian.index') }}">
        <span class="menu-icon">
            <span>
                <i class="far fa-calendar-alt fs-2x"></i>
            </span>
        </span>
        <span class="menu-title"> Jadwal Ujian</span>
    </a>
</div>
