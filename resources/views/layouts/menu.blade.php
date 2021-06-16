<li class="nav-item">
    <a href="{{ route('home') }}"
       class="nav-link {{ Request::is('home*') ? 'active' : '' }}"><i class="fa fa-home"></i> <p>Beranda</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('periodes.index') }}"
       class="nav-link {{ Request::is('periodes*') ? 'active' : '' }}"><i class="fa fa-calendar"></i> <p> Periode Pemilu</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('penduduks.index') }}"
       class="nav-link {{ Request::is('penduduks*') ? 'active' : '' }}"><i class="fa fa-users"></i> <p>Data Warga</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('kandidats.index') }}"
       class="nav-link {{ Request::is('kandidats*') ? 'active' : '' }}"><i class="fa fa-address-book"></i> <p>Data Calon Ketua RT</p>
    </a>
</li>

{{--<li class="nav-item">--}}
{{--    <a href="{{ route('tingkatPendidikans.index') }}"--}}
{{--       class="nav-link {{ Request::is('tingkatPendidikans*') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i> <p>Tingkat Pendidikan</p>--}}
{{--    </a>--}}
{{--</li>--}}

<li class="nav-item">
    <a href="{{ route('hasilVotings.index') }}"
       class="nav-link {{ Request::is('hasilVotings*') ? 'active' : '' }}"><i class="fa fa-chart-bar"></i> <p>Hasil Voting</p>
    </a>
</li>
