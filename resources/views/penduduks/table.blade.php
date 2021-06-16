<div class="table-responsive">
    <table class="table" id="penduduks-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Agama</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($penduduks as $penduduk)
            <tr>
                <td>{{ $penduduk->nama }}</td>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->jenis_kelamin=="L"?"Laki - Laki":"Perempuan" }}</td>
                <td>{{ $penduduk->tempat_lahir }}, {{ $penduduk->tgl_lahir->format("d M Y") }}</td>
                <td>{{ $penduduk->agama }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['penduduks.destroy', $penduduk->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('penduduks.show', [$penduduk->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('penduduks.edit', [$penduduk->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
