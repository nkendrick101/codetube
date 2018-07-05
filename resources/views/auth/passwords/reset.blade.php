@extends('layouts.standalone')

@section('title')
    {{ __('Reset Password') }}
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
                            {{ __('Reset Password') }}
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
                    @elseif($errors->has('password_confirmation'))
                        <div class="alert alert-danger m-alert m-alert--air m-alert--outline">
                            <strong>
                                Ooops! &nbsp;
                            </strong>
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif

                    <form class="m-login__form m-form" action="{{ route('password.request') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" 
                                    class="form-control m-input" 
                                    placeholder="Email address" 
                                    name="email" 
                                    value="{{ old('email', '') }}" 
                                    autofocus
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
                                    placeholder="New password" 
                                    name="password"
                                >
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-unlock"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group m-form__group">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="password" 
                                    class="form-control m-input" 
                                    placeholder="Confirm new password" 
                                    name="password_confirmation"
                                >
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-unlock-alt"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="m-login__form-action m--margin-top-10">
                            <button class="btn btn-focus btn-block m-btn m-btn--air m-btn--custom m-login__btn m-login__btn--primary" type="submit">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
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