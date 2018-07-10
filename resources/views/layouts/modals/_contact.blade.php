<div id="contact-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="m-portlet m-portlet--full-height">
                <form class="m-form m-form--state" action="/contact" method="POST" autocomplete="off" novalidate>
                    {{ csrf_field() }}

                    <div class="m-portlet__head m--padding-left-25 m--padding-right-20">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Contact
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon" data-dismiss="modal">
                                        <i class="la la-close"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="m-portlet__body m--padding-left-25 m--padding-right-25">
                        <p class="alert m-alert--default">
                            <strong>
                                Notification!  
                            </strong>
                            Don't be shy. We need love, too! Send us some here. All thoughts, comments, and feedback are vibrantly appreciated, and promptly addressed.
                        </p>

                        <div class="form-group m-form__group {{ $errors->has('message_name') ? 'has-danger' : '' }}">
                            <label for="message_name">
                                Full name
                            </label>
                            <div class="m-input-icon m-input-icon--left">
                                <input id="message_name" type="text" name="message_name" class="form-control m-input" value="{{ old('message_name', '') }}" placeholder="John Doe" autofocus>
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-user"></i>
                                    </span>
                                </span>
                            </div>

                            @if($errors->has('message_name'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('message_name') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group m-form__group {{ $errors->has('message_email') ? 'has-danger' : '' }}">
                            <label for="message_email">
                                Email Address
                            </label>
                            <div class="m-input-icon m-input-icon--left">
                                <input id="message_email" type="email" name="message_email" class="form-control" value="{{ old('message_email', '') }}" placeholder="john.doe@domain.com">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-at"></i>
                                    </span>
                                </span>
                            </div>

                            @if($errors->has('message_email'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('message_email') }}
                                </div>
                            @endif
                        </div>
            
                        <div class="form-group m-form__group {{ $errors->has('message_body') ? 'has-danger' : '' }}">
                            <label for="message_body">
                                Message
                            </label>

                            <textarea id="message_body" name="message_body" class="form-control" maxlength="2000" rows=5 placeholder="Your message goes here">{{ old('message_body', '') }}</textarea>

                            @if($errors->has('message_body'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('message_body') }}
                                </div>
                            @endif
                        </div>
                    </div>
          
                    <div class="m-portlet__foot m--padding-left-25 m--padding-right-25">
                        <div class="m-form__actions">
                            <div class="row">
                                <button class="btn btn-block btn-focus m-btn m-btn--wide modal-btn">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>