@extends('layouts.app')

@section('title')
  Video name
@endsection

@section('content')
  <div class="container-fluid" style="background-color: #000;">
    <div class="container">
      @if ($video->isProcessed() && $video->canBeAccessed(Auth::user()))
        <video-player video-uuid="{{ $video->uuid }}" video-url="{{ $video->getStreamUrl() }}" thumbnail-url="{{ $video->getThumbnail() }}"></video-player>
      @endif
      @if (!$video->isProcessed())
        <div class="video-placeholder">
          <div class="video-placeholder__header">
            The video is processing
          </div>
        </div>
      @elseif (!$video->canBeAccessed(Auth::user()))
        <div class="video-placeholder">
          <div class="video-placeholder__header">
            This video is private
          </div>
        </div>
      @endif
    </div>
  </div>

  <div class="container m--margin-bottom-45">
    <div class="row">
      <div class="col-sm-6 m--align-left">
        <div class="card" style="background-color: transparent;">
          <div class="card-body">
            <div class="card-info">
              <div class="media">
                <div class="media-left">
                  <a href="#" 
                    data-toggle="m-popover" 
                    data-trigger="hover" 
                    title="<strong>{{ $channel->user->name }}<strong>" 
                    data-placement="top" 
                    data-html="true" 
                    data-content="{{ $channel->description ? $channel->description : 'Channel has no description' }}" 
                    data-skin="dark"
                  >
                    <img src="{{ $channel->image }}" alt="" class="d-flex mr-3 channel-img img-circle" style="width: 50px; height:auto;">
                  </a>
                </div>
                <div class="media-right">
                  <h4 class="card-title">{{ $video->title }}</h4>
                  <p class="card-text"><small class="text-muted">Published on {{ $video->posted_at() }}</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 m--align-right m--margin-top-20">
        @if ($video->votesAllowed() && Auth::check())
          <video-voting video-uuid="{{ $video->uuid }}"></video-voting>
        @endif
        <subscribe-button channel-slug="{{ $channel->slug }}"></subscribe-button>
      </div>
    </div>

    @if ($video->isPrivate() && Auth::check() && $video->ownedByUser(Auth::user()))
      <div class="m-alert m-alert--icon alert alert-info fade show m--margin-top-25 m--margin-bottom-35">
        <div class="m-alert__icon">
          <i class="flaticon-danger"></i>
        </div>
        <div class="m-alert__text">
          Your video is currently private. Only you can see it.
        </div>
        <div class="m-alert__actions" style="width: 220px;">
          <a href="#" class="btn btn-outline-light btn-sm m-btn">
            Modify
          </a>
          &nbsp;&nbsp;
          <a href="#" class="btn btn-outline-light btn-sm m-btn" data-dismiss="alert">
            Dismiss
          </a>
        </div>
      </div>
    @endif

    @if ($video->commentsAllowed() && !$video->isPrivate())
      <div class="m-portlet__footer" style="padding-top: 30px; border-top: 1px dashed #ebedf2;">
        <video-comments video-uuid="{{ $video->uuid }}" user-image="{{ $video->channel->image }}"></video-comments>
      </div>
    @else
      <div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair m--margin-top-15">
        <div class="m-portlet__head">
          <div class="align-items-center">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text" style="color: #6c757d;">
                  {{ $video->comments->count() }} comments
                </h3>
              </div>
            </div>
          </div>
        </div>
        <div class="m-portlet__footer" style="border-top: 1px dashed #ebedf2; box-shadow: 0 1px 0 rgba(0,0,0,0.05) inset, 0 2px 0 rgba(0,0,0,0.1);">
          <div class="alert m-alert--default m-alert--icon" style="margin-bottom:0; background-color: #f9fafa;">
            <div class="m-alert__icon">
              <i class="flaticon-exclamation-2"></i>
            </div>
            <div class="m-alert__text">
              <strong>
                Notification!
              </strong>
              Comments are disable for this video.
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection
