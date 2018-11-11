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
    <script>
      $('#signin-btn, #signup-btn, #send-password-btn, #reset-password-btn').on('click', function () {
        $(this).removeClass().addClass('btn btn-focus btn-block m-btn m-btn--air m-btn--custom m-login__btn m-login__btn--primary m-loader m-loader--light m-loader--right disabled');
        const id = $(this)[0].id;

        if (id === 'signin-btn') {
          $(this).html('SIGNING IN');
        }
        else if (id === 'signup-btn') {
          $(this).html('SIGNING UP');
        }
        else if (id === 'send-password-btn') {
          $(this).html('SENDING');
        }
        else if (id === 'reset-password-btn') {
          $(this).html('RESETTING');
        }
      });  
    </script>
  </body>
</html>
