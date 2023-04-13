@component('mail::message')
  # Nová rezervace malování

  Do rezervačního systému byla vložena nová rezervace na malovaní.

  <strong>Uživatel:</strong> {{ $data['user'] }}<br>
  <strong>Email:</strong> {{ $data['email'] }}<br>
  <strong>Oddělení:</strong> {{ $data['department'] }}<br>
  <strong>Místnosti:</strong> {{ $data['rooms'] }}<br>
  <strong>Zvláštní požadvky:</strong> {{ $data['specials'] }}<br>
  <strong>Od:</strong> {{ date('d. m. Y', strtotime($data['start'])) }}<br>
  <strong>Do:</strong> {{ date('d. m. Y', strtotime($data['end'])) }}<br>

  @component('mail::button', ['url' => URL::to('paints/')])
    Zobrazit seznam rezervací
  @endcomponent
@endcomponent
