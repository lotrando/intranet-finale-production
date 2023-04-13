<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $pretitle ?? 'Intranet' }} | {{ $title ?? 'KHN a.s.' }} </title>
  @yield('favicon')
  <link href="{{ asset('https://use.fontawesome.com/releases/v5.11.2/css/all.css') }}" rel="stylesheet">
  <link href="{{ asset('libs/plyr/dist/plyr.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fixedHeader.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/tabler.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/tabler-flags.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/tabler-payments.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/tabler-vendors.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/officeToHtml.css') }}" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto Condensed';
      min-height: 100vh;
      color: #777777;
      background-color: rgba(238, 238, 255, 0.562);
    }

    tr {
      font-size: 0.84rem;
    }
  </style>
</head>

<body>
  <!-- Header Start -->
  @include('layouts.partials.header')
  <!-- Header End -->

  <!-- Navigation Start -->
  @include('layouts.partials.navigation')
  <!-- Navigation End -->

  <section>

    @yield('content')

  </section>

  @yield('modals')

  @include('layouts.partials.footer')
  @include('layouts.partials.logout')
  @include('sweetalert::alert')
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('libs/plyr/dist/plyr.min.js') }}"></script>
  <script src="{{ asset('js/tabler.min.js') }}"></script>
  <script src="{{ asset('js/demo.min.js') }}"></script>
  <script src="{{ asset('js/moment-with-locales.js') }}"></script>
  <script src="{{ asset('js/m3u-player.js') }}" defer></script>
  <script>
    $(document).ready(function() {
      function fill(Value) {
        $('#search').val(Value);
        $('#display').hide();
      }
      $("#search").keyup(function() {
        var name = $('#search').val();
        if (name === "") {
          $("#display").html("");
        } else {
          $.ajax({
            type: "GET",
            url: "{{ route('dokument.search') }}",
            data: {
              search: name
            },
            success: function(html) {
              $("#display").html(html).show();
            }
          });
        }
      })
      $("#search-employee").keyup(function() {
        var name = $('#search-employee').val();
        if (name === "") {
          $("#display").html("");
        } else {
          $.ajax({
            type: "GET",
            url: "{{ route('employees.search') }}",
            data: {
              search: name
            },
            success: function(html) {
              $("#display").html(html).show();
            }
          });
        }
        content
      })
    })
  </script>
  @include('sweetalert::alert')
  @include('layouts.partials.scripts')
  @yield('scripts')
</body>

</html>
