<div class="table-responsive">
    <table class="table" id="periodes-table">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Mulai Vote</th>
                <th>Selesai Vote</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($periodes as $periode)
            <tr>
                <td>{{ $periode->keterangan }}</td>
                <td>{{ $periode->mulai_vote->format("d M Y") }}</td>
                <td>{{ $periode->selesai_vote->format("d M Y") }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['periodes.destroy', $periode->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('periodes.show', [$periode->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('periodes.edit', [$periode->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
