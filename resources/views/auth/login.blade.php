@extends('layouts.standalone')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
    <div class="flex-center full-height">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container" data-aos="fade-down">
                <div class="m-login__logo text-center m--margin-bottom-15">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}">
                    </a>
                </div>
                
                <div class="m-login__signin">
                    <div class="m-login__head m--margin-bottom-25">
                        <h3 class="m-login__title text-center">
                            {{ __('Sign in') }}
                        </h3>
                    </div>
                    
                    @if($errors->has('email'))
                        <div class="alert alert-danger m-alert m-alert--air m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('email') }}
                        </div>
                    @elseif($errors->has('password'))
                        <div class="alert alert-danger m-alert m-alert--air m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('password') }}
                        </div>
                    @elseif(session('notification'))
                        <div class="alert alert-warning m-alert m-alert--air m-alert--outline">
                            {{ session('notification') }}
                        </div>
                    @endif

                    <form class="m-login__form m-form" action="{{ route('login') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        
                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" 
                                    class="form-control m-input"
                                    placeholder="Email Address" 
                                    name="email" 
                                    value="{{ old('email', '') }}"
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

                        <div class="row m-login__form-sub m--margin-top-10">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox m-checkbox--solid m-checkbox--focus">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    {{ __('Remember me') }}
                                    <span></span>
                                </label>
                            </div>
                     
                            <div class="col m--align-right m-login__form-right">
                                <a id="m_login_forget_password" href="{{ route('password.request') }}" class="m-link m-link--focus">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>

                        <div class="m-login__form-action m--margin-top-10">
                            <button class="btn btn-focus btn-block m-btn m-btn--air" type="submit">
                                {{ __('Sign in') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center m--margin-top-20">
                    <span style="color: #aba5b6;">{{ __('Or') }}</span>
                </div>

                <div class="text-center m--margin-top-20">
                    <a href="/facebook/sign-in" class="btn btn-brand m-btn btn-sm m-btn m-btn--icon btn-facebook">
                        <span>
                            <i class="fa fa-facebook"></i>
                            <span>
                                {{ __('facebook') }}
                            </span>
                        </span>
                    </a>

                    &nbsp;

                    <a href="/google/sign-in" class="btn btn-brand m-btn btn-sm m-btn m-btn--icon btn-google">
                        <span>
                            <i class="fa fa-google"></i>
                            <span>
                                {{ __('google') }}
                            </span>
                        </span>
                    </a>

                    &nbsp;

                    <a href="/twitter/sign-in" class="btn btn-brand m-btn btn-sm m-btn m-btn--icon btn-twitter">
                        <span>
                            <i class="fa fa-twitter"></i>
                            <span>
                                {{ __('twitter') }}
                            </span>
                        </span>
                    </a>
                </div>
                
                <hr class="m-separator m-separator--dashed m--margin-top-40">

                <div class="text-center m--margin-top-25">
                    <span style="color: #aba5b6;">{{ __('Don\'t have an account yet ?') }}</span>
                    &nbsp;&nbsp;
                    <a href="{{ route('register') }}" class="m-link" style="color: #847b93;">
                        {{ __('Sign Up') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection