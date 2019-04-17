<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>


  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>

  <!-- Scripts -->
  <script src="{{ asset('js/static/innerSite.js') }}"></script>
  <script src="{{ asset('js/static/DataManager.js') }}"></script>
  <script src="{{ asset('js/static/ModelManager.js') }}"></script>
  <script src="{{ asset('js/static/CanvasManager.js') }}"></script>

  <script src="{{ asset('js/static/globe/third-party/gl-matrix.js') }}"></script>
  <script src="{{ asset('js/static/globe/rendering/Camera.js') }}"></script>
  <script src="{{ asset('js/static/globe/rendering/Program.js') }}"></script>
  <script src="{{ asset('js/static/globe/rendering/ProgramManager.js') }}"></script>
  <script src="{{ asset('js/static/globe/rendering/TextureManager.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/PointGlobeDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/NebulaDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/BokehDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/BackgroundDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/RingDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/EarthquakeDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/drawables/BigQuakeDrawable.js') }}"></script>
  <script src="{{ asset('js/static/globe/geometry/Model.js') }}"></script>
  <script src="{{ asset('js/static/globe/utils/LatLng.js') }}"></script>
  <script src="{{ asset('js/static/globe/utils/ProjectionUtil.js') }}"></script>

  <script src="{{ asset('js/static/third-party/brandkit/Animation.js') }}"></script>
  <script src="{{ asset('js/static/third-party/brandkit/Ease.js') }}"></script>
  <script src="{{ asset('js/static/third-party/brandkit/Ajax.js') }}"></script>
  <script src="{{ asset('js/static/third-party/brandkit/Signal.js') }}"></script>
  <script src="{{ asset('js/static/third-party/greensock/SplitText.js') }}"></script>
  <script src="{{ asset('js/static/third-party/greensock/TweenMax.js') }}"></script>

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://www.google.com/recaptcha/api.js" defer></script>

  <!-- Fonts -->
  <script src="{{ asset('js/static/WebFontConfig.js') }}" defer></script>
  <script src="{{ asset('js/static/third-party/google/WebFontLoader.js') }}" defer></script>

  <!-- Other JS -->

  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
  <script src="https://www.google.com/recaptcha/api.js" defer></script>

  <!-- Styles -->
  <link href="{{ asset('css/static/desktop.css') }}" rel="stylesheet">
  <link href="{{ asset('css/static/mobile.css') }}" rel="stylesheet">
  <link href="{{ asset('css/inner.css') }}" rel="stylesheet">
</head>

<body class="inner">
@yield('header') @yield('content')
</body>

</html>