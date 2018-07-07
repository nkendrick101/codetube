<form action="/account/{{ '@' . $user->channelSlug() }}/password"
	class="m-form m-form--fit m-form--label-align-right m-form--state" 
	method="post"
>
	{{ csrf_field() }}
	
	<div class="m-portlet__body">
		<div class="form-group m-form__group row m--margin-top-25 {{ $errors->has('password') ? 'has-danger' : ''  }}">
			<label class="col-form-label col-lg-2 col-sm-12">
				Current <br> Password
			</label>
			<div class="col-lg-10 col-md-12 col-sm-12">
				<div class="m-input-icon m-input-icon--left">
					<input class="form-control m-input {{ $errors->has('password') ? 'form-control-danger' : '' }}" type="password" name="password" placeholder="Current/old password">
					<span class="m-input-icon__icon m-input-icon__icon--left">
						<span>
							<i class="la la-key"></i>
						</span>
					</span>
				</div>
				@if ($errors->has('password'))
					<div class="form-control-feedback">
						{{ $errors->first('password') }}
					</div>
				@endif
			</div>
		</div>

		<div class="form-group m-form__group row {{ $errors->has('new_password') ? 'has-danger' : '' }}">
			<label class="col-form-label col-lg-2 col-sm-12">
				New <br> Password
			</label>
			<div class="col-lg-10 col-md-12 col-sm-12">
				<div class="m-input-icon m-input-icon--left">
					<input class="form-control m-input {{ $errors->has('new_password') ? 'form-control-danger' : '' }}" type="password" name="new_password" placeholder="Your new password">
					<span class="m-input-icon__icon m-input-icon__icon--left">
						<span>
							<i class="la la-unlock"></i>
						</span>
					</span>
				</div>
				@if ($errors->has('new_password'))
					<div class="form-control-feedback">
						{{ $errors->first('new_password') }}
					</div>
				@endif
			</div>
		</div>

		<div class="form-group m-form__group row {{ $errors->has('new_password_confirmation') ? 'has-danger' : '' }}">
			<label class="col-form-label col-lg-2 col-sm-12">
				Confirm <br> New Password 
			</label>
			<div class="col-lg-10 col-md-12 col-sm-12">
				<div class="m-input-icon m-input-icon--left">
					<input class="form-control m-input {{ $errors->has('new_password_confirmation') ? 'form-control-danger' : '' }}" name="new_password_confirmation" type="password" placeholder="Confirm your new password">
					<span class="m-input-icon__icon m-input-icon__icon--left">
						<span>
							<i class="la la-unlock-alt"></i>
						</span>
					</span>
				</div>

				@if ($errors->has('new_password_confirmation'))
					<div class="form-control-feedback">
						{{ $errors->first('new_password_confirmation') }}
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