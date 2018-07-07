<form action="/account/{{ '@' . $user->channelSlug() }}/channel"
	class="m-form m-form--fit m-form--label-align-right m-form--state"
	method="post" 
	autocomplete="off"
>
	{{ csrf_field() }}
	
	<div class="m-portlet__body">
		<div class="form-group m-form__group row {{ $errors->has('channel_name') ? 'has-danger' : '' }}">
			<label class="col-form-label col-lg-2 col-sm-12">
				Channel Name
			</label>
			<div class="col-lg-10 col-md-12 col-sm-12">
				<div class="m-input-icon m-input-icon--left">
					<input type="text" name="channel_name" class="form-control m-input" value="{{ old('channel_name', $user->channelName()) }}" placeholder="Channel name">
					<span class="m-input-icon__icon m-input-icon__icon--left">
						<span>
							<i class="la la-play"></i>
						</span>
					</span>
				</div>
				@if ($errors->has('channel_name'))
					<div class="form-control-feedback">
						{{ $errors->first('channel_name') }}
					</div>
				@endif
			</div>
		</div>

		<div class="form-group m-form__group row {{ $errors->has('channel_description') ? 'has-danger' : '' }}">
			<label class="col-form-label col-lg-2 col-sm-12">
				Channel Description
			</label>
			<div class="col-lg-10 col-md-12 col-sm-12">
				<textarea id="channel_description" name="channel_description" class="form-control" rows="5" maxlength="500">{{ old('channel_description', $user->channelDescription()) }}</textarea>
				@if ($errors->has('channel_description'))
					<div class="form-control-feedback">
						{{ $errors->first('channel_description') }}
					</div>
				@endif
				<span class="m-form__help">
					Share your channel description
				</span>
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