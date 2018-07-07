<script>
    function notify (message, type) {
    	if (type == 'success') {
        	toastr.success(message);
    	} else if (type == 'danger') {
    		toastr.error(message);
    	}
    }

    function slugify (text) {
        return text.toString()
            .toLowerCase()
            .replace(/\s+/g, '-')    
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    if ('{{ session('status') }}') {
        notify('{{ session('status') }}', 'success');
    } else if ('{{ $errors->has('name') }}') {
        notify('{{ $errors->first('name') }}', 'danger');
    } else if ('{{ $errors->has('channel_name') }}') {
        notify('{{ $errors->first('channel_name') }}', 'danger');
    } else if ('{{ $errors->has('channel_description') }}') {
        notify('{{ $errors->first('channel_description') }}', 'danger');
    } else if ('{{ $errors->has('password') }}') {
        notify('{{ $errors->first('password') }}', 'danger');
    } else if ('{{ $errors->has('new_password') }}') {
        notify('{{ $errors->first('new_password') }}', 'danger');
    } else if ('{{ $errors->has('new_password_confirmation') }}') {
        notify('{{ $errors->first('new_password_confirmation') }}', 'danger');
    } else if ('{{ $errors->has('number') }}') {
        notify('{{ $errors->first('number') }}', 'danger');
    } else if ('{{ $errors->has('name') }}') {
        notify('{{ $errors->first('name') }}', 'danger');
    } else if ('{{ $errors->has('date') }}') {
        notify('{{ $errors->first('date') }}', 'danger');
    } else if ('{{ $errors->has('cvv') }}') {
        notify('{{ $errors->first('cvv') }}', 'danger');
    }
    
    $('.save-btn').click(function(event) {
        event.preventDefault();
        $(this).removeClass().addClass('btn btn-sm btn-focus m-btn m-btn--custom m-btn--wide m-btn--icon m-loader m-loader--light m-loader--right');
        $(this).html('Saving');
        $(this).closest('form').submit();
    });
</script>