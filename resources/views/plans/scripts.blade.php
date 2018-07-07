<script>
    // card selector
    $('#card').selectpicker();

    // address selector
    var places = places({
        container: document.querySelector('#address'),
        language: 'en',
        countries: 'us',
        templates: {
            value: function(suggestion) {
                return suggestion.name;
            }
        }
    });

    // auto-fill address form
    places.on('change', function resultSelected (event) {
        $('#zipcode').val(event.suggestion.postcode);
    });

    // notification helper
    function notify (message, type) {
    	if (type == 'success') {
        	toastr.success(message);
    	} else if (type == 'danger') {
    		toastr.error(message);
    	}
    }

    // slugify helper
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')    
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    // brace yourself this is insultingly long
    $('.join-plan').click(function(event) {
        event.preventDefault();

        // Assume no error
        var cardType = '';
        var errNumber = '';
        var errName = '';
        var errDate = '';
        var errCVV = '';
        var errAddress = '';
        var errZip = '';

        // validate card-number
        $('#card-number').validateCreditCard(function(result) {
            if (!result.luhn_valid) {
                errNumber = $('#card-number').val().length === 0 ? 'Credit card number is required.' : 'Invalid credit card number.';
                $('#number-form').addClass('has-danger');
                $('#card-number').addClass('form-control-danger');
                $('#number-form-input').removeClass('m--hide').html(errNumber);

                var scroll = new SmoothScroll();
                var anchor = document.querySelector('#credit-card-form');
                var options = { speed: 5000, easing: 'cubic' };
                scroll.animateScroll( anchor, options );

                notify('Sorry, an error has occurred.', 'danger');
            }
            else {
                errNumber = '';
                $('#number-form').removeClass('has-danger');
                $(this).removeClass('form-control-danger');
                $('#number-form-input').addClass('m--hide').html(errNumber);
            }
            if (result.card_type) {
                cardType = result.card_type.name;
            }
        });

        // validate name
        var name = $('#name').val();
        errName = name.length === 0 ? 'Cardholder is required.' : '';

        if (errName.length) {
            $('#name-form').addClass('has-danger');
            $('#name').addClass('form-control-danger');
            $('#name-form-input').removeClass('m--hide').html(errName);

            if (!errNumber.length) {
                var scroll = new SmoothScroll();
                var anchor = document.querySelector('#cvv-form');
                var options = { speed: 5000, easing: 'cubic' };
                scroll.animateScroll( anchor, options );
                notify('Sorry, an error has occurred.', 'danger');
            }
        }
        else {
            errName = '';
            $('#name-form').removeClass('has-danger');
            $('#name').removeClass('form-control-danger');
            $('#name-form-input').addClass('m--hide').html(errName);
        }

        // validate date
        var date = $('#date').val();
        errDate = date.length === 0 ? 'Credit card expiration date is required.' : parseInt(date.replace(/ /g, '').split('/')[0]) > 12 ? 'Invalid date.' : '';

        if (errDate.length) {
            $('#date-form').addClass('has-danger');
            $('#date').addClass('form-control-danger');
            $('#date-form-input').removeClass('m--hide').html(errDate);

            if (!errNumber.length && !errName.length) {
                var scroll = new SmoothScroll();
                var anchor = document.querySelector('#date-form');
                var options = { speed: 5000, easing: 'cubic' };
                scroll.animateScroll( anchor, options );
                notify('Sorry, an error has occurred.', 'danger');
            }
        }
         else {
            errDate = '';
            $('#date-form').removeClass('has-danger');
            $('#date').removeClass('form-control-danger');
            $('#date-form-input').addClass('m--hide').html(errDate);
        }
        
        // validate cvv
        var cvv = $('#cvv').val();
        errCVV =  cvv.length === 0 || cvv.length < 3 || (cvv.length === 4 && cardType !== 'amex') ? 'CVV must be 4 digits for American Express and 3 digits for other card types.' : ''; 

        if (errCVV.length) {
            $('#cvv-form').addClass('has-danger');
            $('#cvv').addClass('form-control-danger');
            $('#cvv-form-input').removeClass('m--hide').html(errCVV);

            if (!errNumber.length && !errName.length && !errDate.length) {
                var scroll = new SmoothScroll();
                var anchor = document.querySelector('#cvv-form');
                var options = { speed: 5000, easing: 'cubic' };
                scroll.animateScroll( anchor, options );
                notify('Sorry, an error has occurred.', 'danger');
            }
        }
        else {
            errCVV = '';
            $('#cvv-form').removeClass('has-danger');
            $('#cvv').removeClass('form-control-danger');
            $('#cvv-form-input').addClass('m--hide').html(errCVV);
        }

        // validate address
        var address = $('#address').val();
        errAddress = address.length === 0 ? 'Billing address is required.' : '';

        if (errAddress.length) {
            $('#address-form').addClass('has-danger');
            $('#address').addClass('form-control-danger');
            $('#address-form-input').removeClass('m--hide').html(errAddress);

            if (!errNumber.length && !errName.length && !errDate.length && !errCVV.length) {
                var scroll = new SmoothScroll();
                var anchor = document.querySelector('#cvv-form');
                var options = { speed: 5000, easing: 'cubic' };
                scroll.animateScroll( anchor, options );
                notify('Sorry, an error has occurred.', 'danger');
            }
        }
        else {
            errAddress = '';
            $('#address-form').removeClass('has-danger');
            $('#address').removeClass('form-control-danger');
            $('#address-form-input').addClass('m--hide').html(errAddress);
        }

        // validate zipcode
        var zipcode = $('#zipcode').val();
        errZip = zipcode.length !== 5 || !(/^\d+$/.test(zipcode)) ? 'Zipcode must be 5 digit number.' : ''; 

        if (errZip.length) {
            $('#zipcode-form').addClass('has-danger');
            $('#zipcode').addClass('form-control-danger');
            $('#zipcode-form-input').removeClass('m--hide').html(errZip);

            if (!errNumber.length && !errName.length && !errDate.length && !errCVV.length && !errAddress.length) {
                var scroll = new SmoothScroll();
                var anchor = document.querySelector('#zipcode-form');
                var options = { speed: 5000, easing: 'cubic' };
                scroll.animateScroll( anchor, options );
                notify('Sorry, an error has occurred.', 'danger');
            }
        }
        else {
            errZip = '';
            $('#zipcode-form').removeClass('has-danger');
            $('#zipcode').removeClass('form-control-danger');
            $('#zipcode-form-input').addClass('m--hide').html(errZip);
        }

        if (!errNumber.length && !errDate.length && !errCVV.length && !errZip.length) {
            $(this).removeClass().addClass('btn btn-sm btn-focus m-btn m-btn--custom m-btn--wide m-btn--icon join-plan m-loader m-loader--light m-loader--right');
            $(this).html('Joining');
            
            // Tokenize credit card
            $.ajax({
                url: '{{ config('app.url') }}' + '/braintree',
                type: 'get',
            }).done(function (response) {
                var client = new braintree.api.Client({ clientToken: response.data.token });
                client.tokenizeCard({
                    number: $('#card-number').val().replace(/ /g, ''),
                    cardholderName: $('#name').val(),
                    expirationDate: $('#date').val().replace(/ /g, ''),
                    cvv: $('#cvv').val(),
                    billingAddress: {
                        postalCode: $('#zipcode').val()
                    }
                }, function (err, nonce) {
                    if (err) {
                        console.log(err);
                    }
                    $('#nonce').val(nonce);
                    $('#credit-card-form').submit();
                });
            });
        }
    });

 	if ('{{ $errors->has('address') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
    else if ('{{ $errors->has('city') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
    else if ('{{ $errors->has('zipcode') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
     else if ('{{ $errors->has('number') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
    else if ('{{ $errors->has('name') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
    else if ('{{ $errors->has('date') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
    else if ('{{ $errors->has('cvv') }}') {
        notify('Sorry, an error has occurred.', 'danger');
    }
    else if ('{{ $errors->has('nonce') }}') {
        notify('Couldn\'t verify your credit card.', 'danger');
    }

    $(window).on('load', function(event) {
        var index = parseInt($('#card').find(":selected").text());
        var cards = JSON.parse('<?= json_encode($cards); ?>');

        var number = '{{ old('number') }}'.length !== 0 ? '{{ old('number') }}' : Number.isInteger(index) ? cards[index].maskedNumber.replace('******', cards[index].bin).replace(/(\d{4})/g, '$1 ').replace(/(^\s+|\s+$)/,'') : '**** **** **** ****';
        var name = '{{ old('name') }}'.length !== 0 ? '{{ old('name') }}' : Number.isInteger(index) ? cards[index].cardholderName : 'Full name';
        var date = '{{ old('date') }}'.length !== 0 ? '{{ old('date') }}' : Number.isInteger(index) ? cards[index].expirationDate : '**/**';
        var type = Number.isInteger(index) ? 'jp-card-' + slugify(cards[index].cardType) + ' jp-card-identified' : '';

        $('.jp-card').addClass(type);
        $('.jp-card-number').html(number);
        $('.jp-card-name').html(name);
        $('.jp-card-expiry').html(date);
        $('.jp-card-cvc').html('');

        $('#card-number').val(number === '**** **** **** ****' ? '' : number);
        $('#name').val(name === 'Full name' ? '' : name);
        $('#date').val(date === '**/**' ? '' : date);

        // setup credit card form
        $('#credit-card-form').card({
            container: '#card-wrapper',
            formSelectors: {
                numberInput: 'input#card-number',
                nameInput: 'input#name',
                expiryInput: 'input#date',
                cvcInput: 'input#cvv',
            },
            placeholders: {
                number: number,
                name: name,
                expiry: date,
                cvv: '***',
            }
        });
        
        // identify credit card brand
        if (Number.isInteger(index)) {
            $('.jp-card').addClass('jp-card-' + slugify(cards[index].cardType) + ' jp-card-identified');
        }
    });

    $('#card').on('change', function(event) {
        var index = parseInt($(this).find(":selected").text());
        var cards = JSON.parse('<?= json_encode($cards); ?>');

        var number = '{{ old('number') }}'.length !== 0 ? '{{ old('number') }}' : Number.isInteger(index) ? cards[index].maskedNumber.replace('******', cards[index].bin).replace(/(\d{4})/g, '$1 ').replace(/(^\s+|\s+$)/,'') : '**** **** **** ****';
        var name = '{{ old('name') }}'.length !== 0 ? '{{ old('name') }}' : Number.isInteger(index) ? cards[index].cardholderName : 'Full name';
        var date = '{{ old('date') }}'.length !== 0 ? '{{ old('date') }}' : Number.isInteger(index) ? cards[index].expirationDate : '**/**';
        var type = Number.isInteger(index) ? 'jp-card jp-card-' + slugify(cards[index].cardType) + ' jp-card-identified' : '';

        $('.jp-card').removeClass().addClass(type);
        $('.jp-card-number').html(number);
        $('.jp-card-name').html(name);
        $('.jp-card-expiry').html(date);
        $('.jp-card-cvc').html('');

        $('#card-number').val(number === '**** **** **** ****' ? '' : number);
        $('#name').val(name === 'Full name' ? '' : name);
        $('#date').val(date === '**/**' ? '' : date);

        // setup credit card form
        $('#credit-card-form').card({
            container: '#card-wrapper',
            formSelectors: {
                numberInput: 'input#card-number',
                nameInput: 'input#name',
                expiryInput: 'input#date',
                cvcInput: 'input#cvv',
            },
            placeholders: {
                number: number,
                name: name,
                expiry: date,
                cvv: '***',
            }
        });
        
        // identify credit card brand
        if (Number.isInteger(index)) {
            $('.jp-card').addClass('jp-card-' + slugify(cards[index].cardType) + ' jp-card-identified');
        }
    });

    // Persist window scroll position
    if ('{{ url()->previous() }}' === '{{ url()->previous() }}' 
        && '{{ url()->previous() }}' === '{{ config('app.url') }}' + '/account/payment'
        && ('{{ $errors->count() }}' !== '0' ||  '{{ session('error') }}')) 
    {
        var scroll = new SmoothScroll();
        var anchor = document.querySelector( '#payment-form-container' );
        var options = { speed: 5000, easing: 'cubic' };
        scroll.animateScroll( anchor, options );
    }
</script>