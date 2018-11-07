@extends('layouts.app')

@section('title')
  Search
@endsection

@section('content')
  <div class="container m--margin-top-35 m--margin-bottom-25">
    <div class="row">
      @foreach ($videos as $video)
        <div class="col-lg-4 m--margin-bottom-35">
          <div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair video-container">
            <div class="m-portlet__body" style="padding: 0.2rem 0.2rem;">
              <div class="card">
                <div class="card-body">
                  <a href="/videos/{{ $video->uuid }}">
                    <img src="{{ $video->getThumbnail() }}" class="card-img img-fluid" alt="Card image">
                  </a>
                  <div class="card-info" style="padding-top: 10px;padding-bottom: 5px;">
                    <div class="row">
                      <div class="col-sm-6 m--align-left">
                        <div class="media ml-2">
                          <div class="media-body">
                            <h6 class="card-title">{{ $video->title }}</h6>
                            <p class="card-text"><small class="text-muted">{{ $video->channel->user->name }}</small></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 m--align-right">
                        @if (!$video->isProcessed())
                          <h6 class="text-muted mr-2">
                            Processing &nbsp; {{ $video->processed_percentage ? $video->processed_percentage : '0'}}%
                          </h6>
                        @else
                          <h6 class="text-muted mr-2">
                            {{ $video->views->count() . ' ' . str_plural('view', $video->views->count()) }}
                          </h6>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{ $videos->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection
