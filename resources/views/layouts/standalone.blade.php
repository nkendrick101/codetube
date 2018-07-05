<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
   <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
   <link rel="stylesheet" href="{{ asset('css/pace.css') }}">
   <link rel="stylesheet" href="{{ asset('css/booster.css') }}">
   <link rel="stylesheet" href="{{ asset('css/metronic.css') }}">
   <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
   <link rel="stylesheet" href="{{ asset('css/line-awesome.css') }}">
   <link rel="stylesheet" href="{{ asset('css/vendors.bundle.css') }}">
   <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}">
   <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800">
</head>
   <body>
      @yield('content')
      <script src="{{ asset('js/vendors.bundle.js') }}"></script>
      <script src="{{ asset('js/scripts.bundle.js') }}"></script>
      <script src="{{ asset('js/aos.js') }}"></script>
      <script src="{{ asset('js/pace.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>
   </body>
</html>