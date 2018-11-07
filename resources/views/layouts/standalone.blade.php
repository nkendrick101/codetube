<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/booster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  </head>
  <body class="page-preloading">
    <div class="page-preloader">
      <div class="preloader">
        <div id="preloader-icon" class="m-loader m-loader--focus"></div>
      </div>
    </div>
    <div class="page-wrapper">
      @yield('content')
    </div>
    <script src="{{ asset('js/vendors.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('js/page-preloading.js') }}"></script>
  </body>
</html>
