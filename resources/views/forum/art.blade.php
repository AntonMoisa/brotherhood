@extends('forum.layouts.inner')
@include('forum.modules.header')
@section('content')
    <main class="page-content container" id="app">

        <video-slider></video-slider>

    </main>

    <div id="quake-info">
        <span></span>
    </div>

    <canvas id="globe-canvas" width="1024" height="1024"></canvas>
@endsection