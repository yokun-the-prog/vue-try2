<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>そうだ、南知多行こう。</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <app-component v-bind:user_info='{{Auth::user()}}'>
    </app-component>
</div>
<script src="{{ asset('/js/app.js') }}" defer></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- <script async
    src="https://maps.googleapis.com/maps/api/json?key=AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc&libraries=directions">
</script> -->

</body>
</html>