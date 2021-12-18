<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', '名前:') !!}
    <p>{{ $spot->name }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', '住所:') !!}
    <p>{{ $spot->address }}</p>
</div>

<!-- Tel Field -->
<div class="col-sm-12">
    {!! Form::label('tel', 'TEL:') !!}
    <p>{{ $spot->tel }}</p>
</div>

<!-- Spot Location Field -->
<div class="col-sm-12">
    {!! Form::label('spot_location', '位置情報:') !!}
    <p>{{ $spot->spot_location }}</p>
</div>

<!-- Standard Term Field -->
<div class="col-sm-12">
    {!! Form::label('standard_term', '目安観光時間:') !!}
    <p>{{ $spot->standard_term }}</p>
</div>


<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $spot->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $spot->updated_at }}</p>
</div>


<!-- Photo Updated -->
<div class="col-sm-12">
    {!! Form::label('photo_path', '代表写真:') !!}<br/>
    <!-- <img src="{{asset('public/tmp/phpSHMvLr')}}" class="w-100 mb-3"> -->
    <img src="{{'/storage/' . $spot->photo_path}}" class="w-50 mb-3">
    
</div>

