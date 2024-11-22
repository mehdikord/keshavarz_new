<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="enamad" content="595012" >

    <title>کشاورز - همراه همیشگی کشاورزان</title>

    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="{{asset('front/css/font.css')}}">
    <meta name="enamad" content="11919696">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="My description here">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>
    <link rel="manifest" href="{{asset('manifest.json')}}">

    @vite(['resources/js/front.js'])

</head>

<body>
<button id="installButton" style="display: none;margin-top: 300px">Install App</button>

<div id="app">



</div>

<script src="{{asset('service-worker.js')}}" ></script>
</body>

</html>

