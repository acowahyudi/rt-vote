<div class="table-responsive">
    <table class="table" id="kegiatanRTs-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Foto</th>
                @if(\Illuminate\Support\Facades\Auth::user()->roles_id==1)
                    <th>RT</th>
                    <th colspan="3">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($kegiatanRTs as $kegiatanRT)
            <tr>
                <td>{{ $kegiatanRT->title }}</td>
                <td><img style="width: 300px" src="{{asset($kegiatanRT->foto)}}"></td>
                @if(\Illuminate\Support\Facades\Auth::user()->roles_id==1)
                    <td>
                        {{ $kegiatanRT->rukunTetangga->rt }}<span class="badge badge-dark small m-0">{{$kegiatanRT->rukunTetangga->kelurahan->kelurahan}}</span>

                    </td>
                    <td width="120">
                        {!! Form::open(['route' => ['kegiatanRTs.destroy', $kegiatanRT->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('kegiatanRTs.edit', [$kegiatanRT->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
