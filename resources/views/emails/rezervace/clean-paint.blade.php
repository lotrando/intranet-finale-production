@component('mail::message')
  # Plánování úklidu

  V Rezervačním systému byla schválená nová rezervace na malovaní která končí {{ date('d. m. Y', strtotime($data['end'])) }}.
  Naplánujte prosím úklid.


  <strong>Uživatel:</strong> {{ $data['user'] }}<br>
  <strong>Email:</strong> {{ $data['email'] }}<br>
  <strong>Oddělení:</strong> {{ $data['department'] }}<br>
  <strong>Místnosti:</strong> {{ $data['rooms'] }}<br>
  <strong>Od:</strong> {{ date('d. m. Y', strtotime($data['start'])) }}<br>
  <strong>Do:</strong> {{ date('d. m. Y', strtotime($data['end'])) }}<br>
@endcomponent
