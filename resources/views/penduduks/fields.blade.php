<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Nik Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nik', 'Nik:') !!}
    {!! Form::text('nik', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Kelurahan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kelurahan_id', 'Kelurahan:') !!}
    {!! Form::select('kelurahan_id', $kelurahan, null ,['placeholder'=>'Pilih Kelurahan', 'class' => 'form-control', 'id'=>'kelurahan_id']) !!}
</div>

<!-- RT Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rukun_tetangga_id', 'RT:') !!}
    {!! Form::select('rukun_tetangga_id', [], null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

@if(\Illuminate\Support\Facades\Auth::user()->roles_id==1)
    <!-- Roles Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('roles_id', 'Role:') !!}
        {!! Form::select('roles_id', $roles, null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>
@else
    {!! Form::hidden('roles_id', 2, null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
@endif

    @push('page_scripts')
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $('#kelurahan_id').on('change', function () {
            $.ajax({
                url: '{{ route('rtByKelurahan') }}',
                method: 'get',
                data: {id: $(this).val()},
                success: function (response) {
                    $.each(response, function (id, name) {
                        $('#rukun_tetangga_id').empty().append(new Option(name, id)).focus();
                    })
                },
                error: function (error) {
                    console.log(error);
                    alert("Error: "+error);
                }
            })
        });
    </script>
@endpush
