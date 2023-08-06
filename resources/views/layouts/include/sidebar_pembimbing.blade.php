<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.pembimbing.pra*') ? 'active' : '' }}"
        href="{{ route('dosen.pembimbing.pra.index') }}">
        <span class="menu-icon">
            <span><i class="fas fa-tasks fs-1"></i></span>

        </span>
        <span class="menu-title">Pengajuan Pra</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.pembimbing.bimbingan.*') ? 'active' : '' }}"
        href="{{ route('dosen.pembimbing.bimbingan.index') }}">
        <span class="menu-icon">
            <span><i class="far fa-file-word fs-2x"></i></span>

        </span>
        <span class="menu-title"> Bimbingan Skripsi</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Route::is('dosen.pembimbing.ujian.*') ? 'active' : '' }}"
        href="{{ route('dosen.pembimbing.ujian.index') }}">
        <span class="menu-icon">
            <span>
                <i class="far fa-calendar-alt fs-2x"></i>
            </span>
        </span>
        <span class="menu-title"> Jadwal Ujian</span>
    </a>
</div>
