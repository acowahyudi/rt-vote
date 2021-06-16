<div class="table-responsive">
    <table class="table" id="tingkatPendidikans-table">
        <thead>
            <tr>
                <th>Pendidikan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tingkatPendidikans as $tingkatPendidikan)
            <tr>
                <td>{{ $tingkatPendidikan->pendidikan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tingkatPendidikans.destroy', $tingkatPendidikan->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tingkatPendidikans.show', [$tingkatPendidikan->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tingkatPendidikans.edit', [$tingkatPendidikan->id]) }}" class='btn btn-default btn-xs'>
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
