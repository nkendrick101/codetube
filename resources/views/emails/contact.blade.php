@component('mail::message')
  # Hello!

  {{ $body }}

  Cheers,<br>
  {{ $name }}<br>
  [{{ $email }}]({{ 'mailto:' . $email }})
@endcomponent
