@extends('layouts.standalone')

@section('title')
    {{ __('Register') }}
@endsection

@section('content')
    <div class="flex-center full-height">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo text-center m--margin-bottom-15">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}">
                    </a>
                </div>

                <div class="m-login__signin">
                    <div class="m-login__head m--margin-bottom-25">
                        <h3 class="m-login__title text-center">
                            {{ __('Sign up') }}
                        </h3>
                    </div>
                    @if($errors->has('name'))
                        <div class="alert alert-danger m-alert m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('name') }}
                        </div>
                    @elseif($errors->has('email'))
                        <div class="alert alert-danger m-alert m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('email') }}
                        </div>
                    @elseif($errors->has('channel_name'))
                        <div class="alert alert-danger m-alert m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('channel_name') }}
                        </div>
                    @elseif($errors->has('password'))
                        <div class="alert alert-danger m-alert m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <form class="m-login__form m-form" action="{{ route('register') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        
                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" 
                                    class="form-control m-input" 
                                    placeholder="Full name" 
                                    name="name" 
                                    value="{{ old('name', '') }}"
                                >
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-user"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input" placeholder="Email address" name="email" value="{{ old('email', '') }}">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-at"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input" placeholder="Channel name" name="channel_name" value="{{ old('channel_name', '') }}">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-play"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="password" 
                                    class="form-control m-input" 
                                    placeholder="Password" 
                                    name="password"
                                >
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-unlock-alt"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="m-login__form-action m--margin-top-10">
                            <button class="btn btn-focus btn-block" type="submit">
                                Sign up
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center m--margin-top-20">
                    <span style="color: #aba5b6;">Or</span>
                </div>

                <div class="text-center m--margin-top-20">
                    <a href="#" class="btn btn-brand m-btn btn-sm m-btn m-btn--icon btn-facebook">
                        <span>
                            <i class="fa fa-facebook"></i>
                            <span>
                                facebook
                            </span>
                        </span>
                    </a>

                    &nbsp;

                    <a href="#" class="btn btn-brand m-btn btn-sm m-btn m-btn--icon btn-google">
                        <span>
                            <i class="fa fa-google"></i>
                            <span>
                                google
                            </span>
                        </span>
                    </a>

                    &nbsp;

                    <a href="#" class="btn btn-brand m-btn btn-sm m-btn m-btn--icon btn-twitter">
                        <span>
                            <i class="fa fa-twitter"></i>
                            <span>
                                twitter
                            </span>
                        </span>
                    </a>
                </div>

                <hr class="m-separator m-separator--dashed m--margin-top-40">

                <div class="text-center m--margin-top-25">
                    <span style="color: #aba5b6;">Already have an account ?</span>
                    &nbsp;&nbsp;
                    <a href="{{ route('login') }}" class="m-link" style="color: #847b93;">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection