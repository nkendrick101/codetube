<form action="/account/{{ '@' . $user->channelSlug() }}/settings"
  class="m-form m-form--fit m-form--label-align-right m--form-state" 
  method="POST"
>
  {{ csrf_field() }}

  <div class="m-portlet__body">
    <div class="form-group m-form__group row m--margin-top-15">
      <label class="col-form-label col-lg-2 col-sm-12">
        Notify
      </label>
      <div class="col-lg-9 col-md-12 col-sm-12">
        <div class="m-checkbox-list">
          <label class="m-checkbox m-checkbox--solid m-checkbox--focus">
            <input type='hidden' name='content_notification' value='off'/>
            <input type="checkbox" name="content_notification" {{ optional($user->setting)->content_notification === true ? 'checked' : '' }} />
            Quando um novo material e lancado
            <span></span>
          </label>
          <label class="m-checkbox m-checkbox--solid m-checkbox--focus">
            <input type="hidden" name="password_notification" value="off">
            <input type="checkbox" 
              name="password_notification" 
              {{ optional($user->setting)->password_notification === true ? 'checked' : '' }}
            />
            Quando a minha palavra passe e mudada
            <span></span>
          </label>
        </div>
      </div>
    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

    <div class="form-group m-form__group row">
      <label class="col-form-label col-lg-2 col-sm-12">
        Privacy
      </label>
      <div class="col-lg-9 col-md-12 col-sm-12">
        <div class="m-checkbox-list">
          <label class="m-checkbox m-checkbox--solid m-checkbox--focus">
            <input type="hidden" name="profile_visibility" value="off" />
            <input type="checkbox" name="profile_visibility" {{ optional($user->setting)->profile_visibility === true ? 'checked' : '' }} />
            Permitir os outros usuarios a acederem of meu perfil
            <span></span>
          </label>
          <label class="m-checkbox m-checkbox--solid m-checkbox--focus">
            <input type="hidden" name="email_notification" value="off" />
            <input type="checkbox" name="email_notification" {{ optional($user->setting)->email_notification === true ? 'checked' : '' }} />
            Desactivar notificacao por email
            <span></span>
          </label>
        </div>
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
