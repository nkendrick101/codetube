@extends('layouts.app')

@section('title')
	Profile
@endsection

@section('content')
	<div class="container m--margin-top-25 m--margin-bottom-25">
		<div class="row">
			<div class="col-xl-3 m--margin-bottom-25">
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
					<div class="m-portlet__body" style="padding: 2.2rem 2.2rem 2rem;">
						<div class="m-card-profile">
							<div class="m-card-profile__pic">
								<div class="m-card-profile__pic-wrapper">
									<img id="user-image" src="{{ $channel->image }}" class="img-fluid">
								</div>
							</div>

							<div class="m-card-profile__details">
								<span class="m--font-bolder lead">
									{{ $channel->user->name }}
								</span>
								<br>
								<a href="#" class="m-card-profile__email m-link m--margin-bottom-20">
									{{ $channel->user->email }}
								</a>
								<br>
								<small>
									Joined {{ $channel->user->created_at->diffForHumans() }}
								</small>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-9">
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
					<div class="m-portlet__head">
						{{ strtok($channel->user->name, ' ') }}'s Videos
					</div>
					<div class="m-portlet__body">
						@if (!$channel->isVisible(optional(auth()->user())->id))
							{{ strtok($channel->user->name, ' ') }}'s channel is private
						@elseif ($videos->count() === 0)
							No videos
						@else
							<div class="row">
								@foreach ($videos as $index => $video) 
									<div class="col-lg-6 {{ $index !== $videos->count() - 1 ? 'm--margin-bottom-25' : '' }}">
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
																			<p class="card-text"><small class="text-muted">{{ $channel->user->name }}</small></p>
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
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection