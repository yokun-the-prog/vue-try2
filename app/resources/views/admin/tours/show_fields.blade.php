<!-- User Name Field -->
<div class="col-sm-12">
    {!! Form::label('user_name', 'ユーザー名:') !!}
    <p>{{ $tour->user->name }}</p>
</div>

<!-- Schedule Field -->
<div class="col-sm-12">
    {!! Form::label('schedule', '観光計画日:') !!}
    <p>{{ $tour->schedule }}</p>
</div>

<!-- Departure Spot Field -->
<div class="col-sm-12">
    {!! Form::label('departure_spot', '出発地:') !!}
    <p>{{ $tour->departure_spot }}</p>
</div>

<!-- Departure At Field -->
<div class="col-sm-12">
    {!! Form::label('departure_at', '出発時間:') !!}
    <p>{{ $tour->departure_at }}</p>
</div>

<!-- Return Spot Field -->
<div class="col-sm-12">
    {!! Form::label('return_spot', '帰宅地:') !!}
    <p>{{ $tour->return_spot }}</p>
</div>

<!-- Return At Field -->
<div class="col-sm-12">
    {!! Form::label('return_at', '帰宅時間:') !!}
    <p>{{ $tour->return_at }}</p>
</div>


<!-- Photorally Division Id Field -->
<div class="col-sm-12">
    {!! Form::label('photorally_division', 'フォトラリー実施有無:') !!}
    <p>{{ $tour->photorally_division->name }}</p>
</div>

<!-- Transport Division Id Field -->
<div class="col-sm-12">
    {!! Form::label('transport_division', '交通手段:') !!}
    <p>{{ $tour->transport_division->name }}</p>
</div>


<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $tour->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $tour->updated_at }}</p>
</div>

