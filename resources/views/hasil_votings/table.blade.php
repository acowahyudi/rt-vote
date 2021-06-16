<div class="table-responsive">
    <table class="table" id="hasilVotings-table">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Penduduk/Pemilih</th>
                <th>Kandidat</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($hasilVotings as $hasilVoting)
            <tr>
                <td>{{ $hasilVoting->periode->keterangan }}</td>
            <td>{{ $hasilVoting->penduduk->nama }}</td>
            <td>{{ $hasilVoting->kandidat->nama }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['hasilVotings.destroy', $hasilVoting->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('hasilVotings.show', [$hasilVoting->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('hasilVotings.edit', [$hasilVoting->id]) }}" class='btn btn-default btn-xs'>
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
