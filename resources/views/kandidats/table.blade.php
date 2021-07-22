<div class="table-responsive">
    <table class="table" id="kandidats-table">
        <thead>
            <tr>
                <th>No Calon</th>
                <th>Foto</th>
                <th>Calon Ketua RT</th>
                <th>Visi/Misi</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($kandidats as $kandidat)
            <tr>
                <td><b>{{ $kandidat->no_calon }}</b></td>
                <td>
                    <img class="rounded" style="width: 120px" src="{{asset($kandidat->foto)}}">
                </td>
                <td style="white-space: nowrap">
                    <b>Nama :</b> {{ $kandidat->user->name }}<br>
                    <b>Periode :</b> {{$kandidat->periode->keterangan}}
                </td>

                <td>{{ $kandidat->visi }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['kandidats.destroy', $kandidat->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('kandidats.show', [$kandidat->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('kandidats.edit', [$kandidat->id]) }}" class='btn btn-default btn-xs'>
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
