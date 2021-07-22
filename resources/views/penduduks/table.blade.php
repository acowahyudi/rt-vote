<div class="table-responsive">
    <table class="table" id="penduduks-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($penduduks as $penduduk)
            <tr>
                <td>{{ $penduduk->name }}</td>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->email }}</td>
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
