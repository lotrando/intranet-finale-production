<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('Oznámení') }}</title>
  <link type="image/png" href="{{ asset('img/icons/info-circle.png') }}" rel="shortcut icon">
  <link href="{{ asset('https://use.fontawesome.com/releases/v5.11.2/css/all.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fixedHeader.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/tabler.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/tabler-flags.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/tabler-payments.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/tabler-vendors.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
  <style>
    body {
      min-height: 100vh;
      color: #666;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    @yield('header')

    @yield('navigation')

    @yield('main')

    @yield('modals')

  </div>

  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/tabler.js') }}"></script>
  <script src="{{ asset('js/demo.js') }}"></script>
</body>

</html>
