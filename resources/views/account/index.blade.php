@extends('layouts.app')

@section('title')
	Account
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
									<a href="#" data-toggle="modal" data-target="#upload-image-modal">
										<img id="user-image" src="{{ $user->channel()->first()->image }}" class="img-link img-fluid">
									</a>
								</div>
							</div>

							<div class="m-card-profile__details">
								<span class="m--font-bolder lead">
									{{ $user->name }}
								</span>
								<br>
								<a href="#" class="m-card-profile__email m-link m--margin-bottom-20">
									{{ $user->email }}
								</a>
								<br>
								<a href="#" class="btn btn-sm btn-focus" data-toggle="modal" data-target="#upload-image-modal">
									Change Image
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-9">
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair m-portlet--tabs">
					<div class="m-portlet__head">
						<div class="m-portlet__head-tools">
							<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary">
								<li class="nav-item m-tabs__item">
									<a href="{{ route('account', ['username' => $user->channel()->first()->slug, 'section' => 'profile']) }}" class="nav-link m-tabs__link {{ $section === 'profile' ? 'active' : '' }}">
										<i class="flaticon-user"></i>
										Profile
									</a>
								</li>

								<li class="nav-item m-tabs__item">
									<a href="{{ route('account', ['username' => $user->channel()->first()->slug, 'section' => 'channel']) }}" class="nav-link m-tabs__link {{ $section === 'channel' ? 'active' : '' }}">
										<i class="flaticon-imac"></i>
										My Channel
									</a>
								</li>

								<li class="nav-item m-tabs__item">
									<a href="{{ route('account', ['username' => $user->channel()->first()->slug, 'section' => 'payment']) }}" class="nav-link m-tabs__link {{ $section === 'payment' ? 'active' : '' }}">
										<i class="flaticon-coins"></i>
										Payments
									</a>
								</li>

								<li class="nav-item m-tabs__item">
									<a href="{{ route('account', ['username' => $user->channel()->first()->slug, 'section' => 'password']) }}" class="nav-link m-tabs__link {{ $section === 'password' ? 'active' : '' }}">
										<i class="flaticon-lock-1"></i>
										Password
									</a>
								</li>

								<li class="nav-item m-tabs__item">
									<a href="{{ route('account', ['username' => $user->channel()->first()->slug, 'section' => 'settings']) }}" class="nav-link m-tabs__link {{ $section === 'settings' ? 'active' : '' }}">
										<i class="flaticon-settings"></i>
										Settings
									</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="tab-content">
						<div id="progress-bar--parent" class="m--padding-left-30 m--padding-right-30 m--padding-top-30 m--hide">
							<div class="progress m-progress--sm">
								<div id="progress-bar" 
									class="progress-bar progress-bar-animated m--bg-focus" 
									role="progressbar" 
									style="width: 35%; height: 5px;" 
									aria-valuemin="0" 
									aria-valuemax="100">
								</div>
							</div>
						</div>

						<div class="tab-pane {{ $section === 'profile' ? 'active' : '' }}">
							@if ($section === 'profile')
								@include('account.partials.profile')
							@endif
						</div>
						
						<div class="tab-pane {{ $section === 'channel' ? 'active' : '' }}">
							@include('account.partials.channel')
						</div>

						<div class="tab-pane {{ $section === 'payment' ? 'active' : '' }}">
							@include('account.partials.payment')
						</div>

						<div class="tab-pane {{ $section === 'password' ? 'active' : '' }}">
							@include('account.partials.password')
						</div>

						<div class="tab-pane {{ $section === 'settings' ? 'active' : '' }}">
							@include('account.partials.settings')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@include('account.partials.scripts._master_scripts')
	@include('account.partials.scripts._profile_scripts')
	@include('account.partials.scripts._payment_scripts')
@endsection