<li class="nav-item">
    <a href="{{ route('home') }}"
       class="nav-link {{ Request::is('home*') ? 'active' : '' }}"><i class="fa fa-home"></i> <p>Beranda</p>
    </a>
</li>

@if(\Illuminate\Support\Facades\Auth::user()->roles_id==1)
    <li class="nav-item">
        <a href="{{ route('kelurahans.index') }}"
           class="nav-link {{ Request::is('kelurahans*') ? 'active' : '' }}"><i class="fa fa-database"></i> <p>Data Kelurahan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('rukunTetanggas.index') }}"
           class="nav-link {{ Request::is('rukunTetanggas*') ? 'active' : '' }}"><i class="fa fa-database"></i> <p>Data RT</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('roles.index') }}"
           class="nav-link {{ Request::is('roles*') ? 'active' : '' }}"><i class="fa fa-user"></i> <p>Role User</p>
        </a>
    </li>
@endif
@if(\Illuminate\Support\Facades\Auth::user()->roles_id!=2)
    <li class="nav-item">
        <a href="{{ route('penduduks.index') }}"
           class="nav-link {{ Request::is('penduduks*') ? 'active' : '' }}"><i class="fa fa-users"></i> <p>Data Penduduk</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('periodes.index') }}"
           class="nav-link {{ Request::is('periodes*') ? 'active' : '' }}"><i class="fa fa-calendar"></i> <p> Periode Pemilu</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('kandidats.index') }}"
           class="nav-link {{ Request::is('kandidats*') ? 'active' : '' }}"><i class="fa fa-address-book"></i> <p>Data Calon Ketua RT</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('kegiatanRTs.index') }}"
           class="nav-link {{ Request::is('kegiatanRTs*') ? 'active' : '' }}"><i class="fa fa-newspaper"></i> <p>Kegiatan RT</p>
        </a>
    </li>
@endif

<li class="nav-item">
    <a href="{{ route('cekHasilVoting') }}"
       class="nav-link {{ Request::is(['cekHasilVoting*','hasilVotingByRT*']) ? 'active' : '' }}"><i class="fa fa-chart-bar"></i> <p>Hasil Voting</p>
    </a>
</li>


