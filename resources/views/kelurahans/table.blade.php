<div class="table-responsive">
    <table class="table" id="kelurahans-table">
        <thead>
            <tr>
                <th>Kelurahan</th>
        <th>Kecamatan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($kelurahans as $kelurahan)
            <tr>
                <td>{{ $kelurahan->kelurahan }}</td>
            <td>{{ $kelurahan->kecamatan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['kelurahans.destroy', $kelurahan->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('kelurahans.show', [$kelurahan->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('kelurahans.edit', [$kelurahan->id]) }}" class='btn btn-default btn-xs'>
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
