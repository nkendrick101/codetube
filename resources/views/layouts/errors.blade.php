@extends('layouts.standalone')

@section('content')
  <div class="flex-center full-height">
    <div class="container text-center">
      <h2 class="text-danger m--margin-bottom-20 display-3" style="font-weight: 300;">
        @yield('title')
      </h2>
      <p style="color: #9e97aa;">
      @yield('message') <br><br><br>
      <a href="{{ URL::previous() }}" class="m-link">Go back</a>
      </p>
    </div>
  </div>
@endsection
