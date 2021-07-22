<div class="table-responsive">
    <table class="table" id="rukunTetanggas-table">
        <thead>
            <tr>
                <th>RT</th>
                <th>Kelurahan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rukunTetanggas as $rukunTetangga)
            <tr>
                <td>{{ $rukunTetangga->rt }}</td>
            <td>{{ $rukunTetangga->kelurahan->kelurahan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['rukunTetanggas.destroy', $rukunTetangga->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('rukunTetanggas.show', [$rukunTetangga->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('rukunTetanggas.edit', [$rukunTetangga->id]) }}" class='btn btn-default btn-xs'>
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
