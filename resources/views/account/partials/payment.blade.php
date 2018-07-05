<div class="m--padding-top-40">
	<div class="form-group m-form__group row m--padding-left-30 m--padding-right-30">
		<div class="col-12">
			<div class="m-alert m-alert--outline alert alert-info" role="alert">
                <div class="m-alert__text">
                    <strong>Notification!</strong>
                    Your payment details inserted herein do not touch our servers. They are securely processed and saved  by our payment gateway, <a href="https://braintreepayments.com" class="m-link m-link--info" target="_blank">Braintree</a>. In case you have any questions or concerns, please do not hesitate to contact us or our support team at <a href="#" class="m-link m-link--info">codetube.app@gmail.com</a>. We'll be happy to help.
                </div>
            </div>
        </div>
    </div>

    <div class="m--padding-left-30">
		<a id="add-card" href="#" class="btn btn-focus m-btn--wide">
			<span>
				Add Card
			</span>
		</a>
		<div class="m-separator m-separator--dashed d-xl-none"></div>
	</div>

	<div class="m_datatable m--padding-left-30 m--padding-right-30 m--padding-top-30 m--padding-bottom-30" id="base_responsive_columns"></div>

    <div id="payment-form-container" class="{{ $errors->count() > 0 || session('error') ? '' : 'm--hide' }}">
    	<div class="m-separator m-separator--dashed"></div>
    	
		<div id="card-wrapper" class="card-wrapper m--padding-top-30 m--padding-bottom-10 m--padding-left-10 m--padding-right-10"></div>

		<form id="credit-card-form" action="/account/{{ '@' . $user->channelName() . '/payment'}}" class="m-form m-form--fit m-form--label-align-right m-form--state" method="post" autocomplete="off">
			{{ csrf_field() }}
			
			<input id="token" type="hidden" name="token">

			<div class="m-portlet__body">
				<div class="form-group m-form__group row {{ $errors->has('number') ? 'has-danger' : '' }}">
					<label class="col-form-label col-lg-2 col-sm-12">
						Card Number
					</label>
					<div class="col-lg-9 col-md-12 col-sm-12">
						<div class="m-input-icon m-input-icon--left">
							<input id="card-number" class="form-control m-input {{ $errors->has('number') ? 'form-control-danger' : '' }}" type="text" name="number" placeholder="Card number" value="{{ old('number') }}">
							<span class="m-input-icon__icon m-input-icon__icon--left">
								<span>
									<i class="la la-credit-card"></i>
								</span>
							</span>
						</div>
						@if ($errors->has('number'))
							<div class="form-control-feedback">
								{{ $errors->first('number') }}
							</div>
						@endif
						<span class="m-form__help">
							Digite apenas os numeros indicados no seu cartao
						</span>
					</div>
				</div>

				<div class="form-group m-form__group row {{ $errors->has('name') ? 'has-danger' : '' }}">
					<label class="col-form-label col-lg-2 col-sm-12">
						Cardholder
					</label>
					<div class="col-lg-9 col-md-12 col-sm-12">
						<div class="m-input-icon m-input-icon--left">
							<input id="name" class="form-control m-input {{ $errors->has('name') ? 'form-control-danger' : '' }}" type="text" name="name" placeholder="Cardholder name" value="{{ old('name') }}"/>
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
						<span class="m-form__help">
							Digite apenas letras
						</span>
					</div>
				</div>

				<div class="form-group m-form__group row {{ $errors->has('date') ? 'has-danger' : '' }}">
					<label class="col-form-label col-lg-2 col-sm-12">
						Exp. Date
					</label>
					<div class="col-lg-9 col-md-12 col-sm-12">
						<div class="m-input-icon m-input-icon--left">
							<input id="date" class="form-control m-input {{ $errors->has('date') ? 'form-control-danger' : '' }}" type="text" name="date" placeholder="Expiry date" value="{{ old('date') }}"/>
							<span class="m-input-icon__icon m-input-icon__icon--left">
								<span>
									<i class="la la-calendar"></i>
								</span>
							</span>
						</div>
						@if ($errors->has('date'))
							<div class="form-control-feedback">
								{{ $errors->first('date') }}
							</div>
						@endif
						<span class="m-form__help">
							Digite data em <code>mm/yy</code> ou <code>mm/yyyy</code> formato
						</span>
					</div>
				</div>

				<div class="form-group m-form__group row {{ $errors->has('cvv') ? 'has-danger' : '' }}">
					<label class="col-form-label col-lg-2 col-sm-12">
						CVV
					</label>
					<div class="col-lg-9 col-md-12 col-sm-12">
						<div class="m-input-icon m-input-icon--left">
							<input id="cvv" class="form-control m-input {{ $errors->has('cvv') ? 'form-control-danger' : '' }}" type="text" name="cvv" placeholder="CVV"/>
							<span class="m-input-icon__icon m-input-icon__icon--left">
								<span>
									<i class="la la-unlock-alt"></i>
								</span>
							</span>
						</div>
						@if ($errors->has('cvv'))
							<div class="form-control-feedback">
								{{ $errors->first('cvv') }}
							</div>
						@endif
						<span class="m-form__help">
							Digite cvv em <code>***</code> formato
						</span>
					</div>
				</div>
			</div>	

			<div class="m-portlet__foot">
				<div class="m-form__actions">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-7">
							<button type="submit" class="btn btn-sm btn-focus m-btn m-btn--custom m-btn--wide m-btn--icon m-btn--air save-btn">
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
	</div>
</div>