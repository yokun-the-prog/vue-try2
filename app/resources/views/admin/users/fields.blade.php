<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '名前:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role', '役割') !!}</br>
    {!! Form::select('role', ['admin' => 'admin', 'guest' => 'guest'], ['class' => 'form-control']) !!}
</div>    

