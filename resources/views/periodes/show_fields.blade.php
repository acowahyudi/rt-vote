<!-- Mulai Vote Field -->
<div class="col-sm-12">
    {!! Form::label('mulai_vote', 'Mulai Vote:') !!}
    <p>{{ $periode->mulai_vote }}</p>
</div>

<!-- Selesai Vote Field -->
<div class="col-sm-12">
    {!! Form::label('selesai_vote', 'Selesai Vote:') !!}
    <p>{{ $periode->selesai_vote }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $periode->keterangan }}</p>
</div>

