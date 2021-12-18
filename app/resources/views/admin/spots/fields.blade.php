<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '名前:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', '住所:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tel', 'TEL:') !!}
    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
</div>


<!-- Spot Location Field -->
<div class="form-group col-sm-12">
    {!! Form::label('spot_location', '位置情報:') !!}
    {!! Form::text('spot_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Standard Term Field -->
<div class="form-group col-sm-12">
    {!! Form::label('standard_term', '標準観光時間:') !!}
    {!! Form::text('standard_term', null, ['class' => 'form-control']) !!}
</div>


<!-- Standard Term Field -->
<div class="form-group col-sm-12">
    {!! Form::label('photo_path', '代表写真:') !!}<br>
    {!! Form::file('photo_path', null, ['class' => 'form-control-file']) !!}
</div>


