@component('mail::message')
  # Změna rezervace malování

  V rezervačním systému byla upravena rezervace na malovaní.

  <strong>Uživatel:</strong> {{ $data['user'] }}<br>
  <strong>Email:</strong> {{ $data['email'] }}<br>

  Původní rezervace

  <strong>Oddělení:</strong> {{ $data['olddepartment'] }}<br>
  <strong>Místnosti:</strong> {{ $data['oldrooms'] }}<br>
  <strong>Od:</strong> {{ date('d. m. Y', strtotime($data['oldstart'])) }}<br>
  <strong>Do:</strong> {{ date('d. m. Y', strtotime($data['oldend'])) }}<br>

  Aktualizovaná rezervace:

  <strong>Oddělení:</strong> {{ $data['department'] }}<br>
  <strong>Místnosti:</strong> {{ $data['rooms'] }}<br>
  <strong>Od:</strong> {{ date('d. m. Y', strtotime($data['start'])) }}<br>
  <strong>Do:</strong> {{ date('d. m. Y', strtotime($data['end'])) }}<br>

  @component('mail::button', ['url' => URL::to('paints/' . $data['id'] . '/edit')])
    Zobrazit rezervaci
  @endcomponent
  @component('mail::button', ['url' => URL::to('paints/')])
    Zobrazit seznam rezervací
  @endcomponent
@endcomponent
