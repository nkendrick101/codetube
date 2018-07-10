<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
   <link rel="stylesheet" href="{{ asset('css/booster.css') }}">
   <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
   <link rel="stylesheet" href="{{ asset('css/line-awesome.css') }}">
   <link rel="stylesheet" href="{{ asset('css/vendors.bundle.css') }}">
   <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}">
   <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
   <script>
      window.codetube = { 
         url: '{{ config("app.url") }}',
         user: {
            id: '{{ Auth::check() ? Auth::user()->id : 'null' }}',
            authenticated: '{{ Auth::check() ? true: false }}',
         }
      }; 
   </script>
</head>
   <body class="page-preloading">
      <div class="page-preloader">
         <div class="preloader">
            <div id="preloader-icon" class="m-loader m-loader--focus"></div>
         </div>
      </div>
      <div id="app" class="page-wrapper">
         @guest
            @include('layouts.partials._header-guest')
         @else
            @include('layouts.partials._header-auth')
            @include('layouts.modals._upload-video')
            @include('layouts.modals._upload-image')
         @endguest
         <div class='page-content'>
            @yield('content')
            @include('layouts.modals._contact')
            @include('layouts.partials._footer')
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
      <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('js/vendors.bundle.js') }}"></script>
      <script src="{{ asset('js/scripts.bundle.js') }}"></script>
      <script src="{{ asset('js/page-preloading.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>
      <script>
         var status = '{{ session("message_response") }}';

         if (status == 'success') {
            swal({
               type: 'success',
               title: 'Message sent!',
               text: 'We\'ll be in touch very soon.',
               confirmButtonClass: "btn btn-focus m-btn m-btn--wide",
               animation: true
            });
         } else if (status == 'error') {
            swal({
               type: 'error',
               title: 'Ooops!',
               text: 'Something went wrong.',
               confirmButtonClass: "btn btn-focus m-btn m-btn--wide",
               animation: true
            });
         }

         var response_error = '{{ $errors->has('message_name') || $errors->has('message_email') || $errors->has('message_body') }}';
        
         if (response_error) {
            $('#contact-modal').modal('show');
         }
      </script>
      @yield('scripts')
   </body>
</html>
