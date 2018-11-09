<form action="/account/{{ '@' . $user->channelSlug() }}/profile"
  class="m-form m-form--fit m-form--label-align-right m-form--state"
  method="POST" 
  autocomplete="off"
>
  {{ csrf_field() }}

  <div class="m-portlet__body m--margin-bottom-45">
    <div class="form-group m-form__group row m--margin-top-25 {{ $errors->has('name') ? 'has-danger' : '' }}">
      <label class="col-form-label col-lg-2 col-sm-12">
        Full Name
      </label>
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="m-input-icon m-input-icon--left">
          <input class="form-control m-input {{ $errors->has('name') ? 'form-control-danger' : '' }}" 
            type="text" 
            name="name" 
            placeholder="Full name" 
            value="{{ old('name', $user->name) }}"
          />
          <span class="m-input-icon__icon m-input-icon__icon--left">
            <span>
              <i class="la la-user"></i>
            </span>
          </span>
        </div>
        @if ($errors->has('name'))
          <div class="form-control-feedback">
            {{ $errors->first('name') }}
          </div>
        @endif
      </div>
    </div>

    <div class="form-group m-form__group row">
      <label class="col-form-label col-lg-2 col-sm-12">
        Email Address
      </label>
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="m-input-icon m-input-icon--left">
          <input type="email" class="form-control m-input" value="{{ $user->email }}" disabled>
          <span class="m-input-icon__icon m-input-icon__icon--left">
            <span>
              <i class="la la-inbox"></i>
            </span>
          </span>
        </div>
      </div>
    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

    <div class="form-group m-form__group row {{ $errors->has('facebook_id') ? 'has-danger' : '' }}">
      <label class="col-form-label col-lg-2 col-sm-12">
        Facebook
      </label>
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="input-group m-input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              www.facebook.com/
            </span>
          </div>
          <input class="form-control m-input {{ $errors->has('facebook_id') ? 'form-control-danger' : '' }}" 
            type="text" 
            name="facebook_id" 
            placeholder="Facebook" 
            value="{{ old('facebook_id', $user->facebook_id) }}"
          />
        </div>
        @if ($errors->has('facebook_id'))
          <div class="form-control-feedback">
            {{ $errors->first('facebook_id') }}
          </div>
        @endif
      </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('google_id') ? 'has-danger' : '' }}">
      <label class="col-form-label col-lg-2 col-sm-12">
        Google
      </label>
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="input-group m-input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              www.google.com/
            </span>
          </div>
          <input class="form-control m-input {{ $errors->has('google_id') ? 'form-control-danger' : '' }}" type="text" name="google_id" placeholder="Google plus" value="{{ old('google_id', $user->google_id) }}">
        </div>
        @if ($errors->has('google_id'))
          <div class="form-control-feedback">
            {{ $errors->first('google_id') }}
          </div>
        @endif
      </div>
    </div>

    <div class="form-group m-form__group row {{ $errors->has('twitter_id') ? 'has-danger' : '' }}">
      <label class="col-form-label col-lg-2 col-sm-12">
        Twitter
      </label>
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="input-group m-input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              www.twitter.com/
            </span>
          </div>
          <input class="form-control m-input {{ $errors->has('twitter_id') ? 'form-control-danger' : '' }}" type="text" name="twitter_id" placeholder="Twitter" value="{{ old('twiter_id', $user->twitter_id) }}">
        </div>
        @if ($errors->has('twitter_id'))
          <div class="form-control-feedback">
            {{ $errors->first('twitter_id') }}
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="m-portlet__foot">
    <div class="m-form__actions">
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
          <button type="submit" class="btn btn-sm btn-focus m-btn m-btn--custom m-btn--wide m-btn--icon save-btn">
            Save
          </button>
          &nbsp;&nbsp;
          <button class="btn btn-sm btn-secondary m-btn m-btn--custom ">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</form>
