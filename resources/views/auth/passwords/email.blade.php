@extends('layouts.standalone')

@section('title')
    {{ __('Passoword Reset') }}
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
                            {{ __('Passoword Reset') }}
                        </h3>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success m-alert m-alert--air m-alert--outline">
                            {{ session('status') }}
                        </div>
                    @elseif($errors->has('email'))
                        <div class="alert alert-danger m-alert m-alert--air m-alert--outline">
                            <strong>Ooops! &nbsp;</strong>
                            {{ $errors->first('email') }}
                        </div>
                    @else
                        <div class="alert alert-warning m-alert m-alert--air m-alert--outline">
                            <strong>{{ __('Notification!') }}</strong>
                            {{ __('Para iniciar o processo de restauracao da sua palavra passe preencha o endereco de email usado durante o registro.') }}
                        </div>
                    @endif

                    <form class="m-login__form m-form" action="{{ route('password.email') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}

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

                        <div class="m-login__form-action m--margin-top-10">
                            <button class="btn btn-focus btn-block m-btn m-btn--air m-btn--custom m-login__btn m-login__btn--primary" type="submit">
                                Send Password Reset Link
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