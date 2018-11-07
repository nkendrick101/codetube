<script src="{{ asset('js/jquery-card.js') }}"></script>
<script src="{{ asset('js/smooth-scroll.js') }}"></script>
<script>
  // Allow persitent form data on card
  var number = '{{ old('number') }}'.length !== 0 ? '{{ old('number') }}' : '**** **** **** ****';
  var name = '{{ old('name') }}'.length !== 0 ? '{{ old('name') }}' : 'Full name';
  var expiry = '{{ old('expiry') }}'.length !== 0 ? '{{ old('expiry') }}' : '**/**';

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
      expiry: expiry,
      cvv: '***',
    }
  });

  // Display available cards
  var datatable = $('.m_datatable').mDatatable({
    data: {
      type: 'remote',
      pageSize: 4,
      source: {
        read: {
          url: '/cards',
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        }
      },
    },

    layout: {
      theme: 'default', 
      scroll: false,
      footer: false,
      spinner: {
        state: 'brand',
        type: 'loader',
        message: 'Fetching cards...'
      }
    },

    sortable: false,
    filterable: false,
    pagination: false,

    translate: {
      records: {
        noRecords: 'No cards found'
      },
    },

    columns: [{
      field: "id",
      title: "ID",
      width: 90,
      textAlign: 'center',
      template: function (response) {
        return '<a href="#" class="m-link m-link--info"' +
            'onclick="event.preventDefault(); update_card(\'' + response.id + '\');">' + 
            response.id.toUpperCase() + 
          '</a>';
      }
    }, {
      field: "holder",
      title: "Cardholder",
      width: 150,
      responsive: {visible: 'lg'},
    }, {
      field: "last4",
      title: "Card number",
      width: 150,
      template: function (response) {
        return '*** **** **** ' + response.last4;
      }
    }, {
      field: "image",
      title: "Type",
      width: 70,
      responsive: {visible: 'md'},
      template: function (response) {
        return '<img src="' + response.image + '" alt="Card Image" height="25">';
      }
    }, {
      field: "Actions",
      width: 150,
      title: "Actions",
      textAlign: 'center',
      overflow: 'visible',
      template: function (row) {
        var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

        return '\
          <a href="#"\
            class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"\
            title="Edit"\
            onclick="event.preventDefault();\
            update_card(\'' + row.id + '\');"\
            data-skin="light"\
            data-toggle="m-tooltip"\
            data-placement="top"\
            title="Editar"\
          >\
              <i class="la la-edit"></i>\
          </a>\
          <a href="#"\
            class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"\
            title="Remove"\
            onclick="event.preventDefault();\
            delete_card(\'' + row.id + '\');"\
            data-skin="light"\
            data-toggle="m-tooltip"\
            data-placement="top"\
            title="Remover"\
          >\
              <i class="la la-trash"></i>\
          </a>\
                ';
      }
    }] 
  });

  // show payment form
  $('#add-card').click(function(event) {
    event.preventDefault();
    $('#payment-form-container').removeClass('m--hide');
    var scroll = new SmoothScroll();
    var anchor = document.querySelector( '#payment-form-container' );
    var options = { speed: 5000, easing: 'cubic' };
    scroll.animateScroll( anchor, options );
    $('.jp-card').removeClass('jp-card-identified');
    $('#card-number').val('');
    $('.jp-card-number').html('**** **** **** ****');
    $('#name').val('');
    $('.jp-card-name').html('Titular');
    $('#date').val('');
    $('.jp-card-expiry').html('**/**');
    $('#cvv').val('');
    $('.jp-card-cvc').html('***');
  });

  // Persist window scroll position
  if ("{{ url()->previous() }}" === "{{ url()->previous() }}" 
    && "{{ url()->previous() }}" === "{{ config('app.url') }}" + "/account/" + "{{ '@' . $user->channelSlug() }}" + "/payment" 
    && ("{{ $errors->count() }}" !== "0" ||  "{{ session('error') }}")) 
  {
    var scroll = new SmoothScroll();
    var anchor = document.querySelector( '#payment-form-container' );
    var options = { speed: 5000, easing: 'cubic' };
    scroll.animateScroll( anchor, options );
  }

  // show delete modal
  function delete_card (token) {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      showLoaderOnConfirm: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      confirmButtonClass: "btn btn-focus m-btn m-btn--wide",
      cancelButtonClass: "btn btn-secondary m-btn m-btn--wide"
    }).then(function(result) {
      if (result.value) {
        $.ajax({
          url: "{{ config('app.url') }}" + '/card/' + token + '/delete',
          type: 'POST',
          data: {
            '_token': "{{ csrf_token() }}"
          },
          success: function (response) {
            datatable.reload();
            swal(
              'Deleted!',
              'Your card has been deleted.',
              'success'
            );
          }
        });
      }
    });
  }

  // update card
  function update_card (token) {
    var uri = "{{ config('app.url') }}" + '/card/' + token;

    $.ajax({
      url: uri,
      type: 'POST',
      data: {
        '_token': '{{ csrf_token() }}'
      }
    }).done(function(response) {
      $('#token').val(response.token);
      $('.jp-card').addClass('jp-card-' + slugify(response.type) + ' jp-card-identified');
      $('.jp-card-number').html(response.number);
      $('#card-number').val(response.number);
      $('.jp-card-name').html(response.holder);
      $('#name').val(response.holder);
      $('.jp-card-expiry').html(response.date);
      $('#date').val(response.date);
      $('.jp-card-cvc').html(response.cvv);
    });

    $('#add-card').click();
  }
</script>
