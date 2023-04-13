<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intranet KHN - {{ __('Training') }}</title>
  <link type="image/png" href="{{ asset('img\icons\info-square-rounded.png') }}" rel="shortcut icon">
  <link href="{{ asset('https://use.fontawesome.com/releases/v5.11.2/css/all.css') }}" rel="stylesheet">
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

    /* Slideshow container */
    .slideshow-container {
      max-width: 750px;
      position: relative;
      margin: auto;
    }

    /* Hide the images by default */
    .mySlides {
      display: none;
      overflow: hidden;
    }

    /* Next & previous buttons */
    .prev {
      cursor: pointer;
      position: absolute;
      top: 50%;
      left: -12%;
      width: auto;
      margin-top: -45px;
      font-weight: bold;
      transition: 0.6s ease;
      border-radius: 5px;
      user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      right: -12%;
      width: auto;
      margin-top: -45px;
      font-weight: bold;
      transition: 0.6s ease;
      border-radius: 5px;
      user-select: none;
    }

    /* Caption text */
    .text {
      color: #f2f2f2;
      font-family: 'Roboto Condensed';
      font-size: 15px;
      padding: 8px 12px;
      position: absolute;
      bottom: 8px;
      width: 100%;
      text-align: center;
    }

    /* Slide numbers text */
    .numbertext {
      color: #f2f2f2;
      font-size: 25px;
      padding: 3px 8px;
      position: absolute;
      font-family: 'Roboto Condensed';
      top: 0;
    }

    /* Dots indicators */
    .dot {
      cursor: none;
      color: white;
      padding-top: 1px;
      height: 22px;
      width: 22px;
      margin: 0 0px;
      background-color: rgba(114, 121, 134, 0.659);
      font-family: 'Roboto Condensed';
      font-size: 14px;
      border-radius: 15%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }

    /* Active Dot */
    .active-dot {
      background-color: #206bc4;
    }
  </style>

</head>

<body>
  <div class="page">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
      <div class="container-fluid">
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-menu" type="button" aria-controls="navbar-menu" aria-expanded="false"
                aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href="{{ url('/train/1') }}">
            <img class="navbar-brand-image" src="{{ asset('img/logo.png') }}" alt="Logo KHN a.s.">
          </a>
        </h1>
      </div>
    </header>
    <div class="page-wrapper">
      <div class="page-body">
        <div class="container-fluid">
          <main>
            @yield('main')
          </main>
        </div>
      </div>
      <footer class="footer footer-transparent d-print-none">
        <div class="container-fluid">
          <div class="row align-items-center flex-row-reverse text-center">
            <div class="col-lg-auto ms-lg-auto">
              <ul class="list-inline list-inline-dots mx-3">
                <li class="list-inline-item"><a class="link-secondary" href="./docs/">Documentation</a></li>
                <li class="list-inline-item"><a class="link-secondary" href="./license.html">License</a></li>
                <li class="list-inline-item"><a class="link-secondary" href="https://github.com/tabler/tabler" target="_blank" rel="noopener">Source code</a></li>
                <li class="list-inline-item">
                  <a class="link-secondary" href="https://github.com/sponsors/codecalm" target="_blank" rel="noopener">
                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                    <svg class="icon text-pink icon-filled icon-inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                    </svg>
                    Sponsor
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-12 col-lg-auto mt-lg-0 mx-3">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  Copyright © 2022 pro Karvinskou hornickou nemocnici a.s. vytvořil
                  <a class="link-secondary" href=".">Klika Miroslav</a>
                </li>
                <li class="list-inline-item">
                  <a class="link-secondary" href="./changelog.html" rel="noopener">
                    v1.0.1
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  {{-- Logout modal --}}
  <div class="modal modal-blur fade" id="logout-modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
        <div class="modal-status bg-warning"></div>
        <div class="modal-body py-4 text-center">
          <svg class="icon text-warning icon-lg mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
               fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>{{ __('Are you sure?') }}</h3>
          <div class="text-muted">
            {{ __('Do you really want to log out?') }}
          </div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button class="btn btn-muted w-100 hover-shadow" data-bs-dismiss="modal">
                  {{ __('Close') }}
                </button>
              </div>
              <div class="col">
                <form @submit.prevent action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-warning w-100 hover-shadow" type="submit">{{ __('Logout') }}</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/tabler.min.js') }}"></script>
  <script src="{{ asset('js/demo.min.js') }}"></script>
</body>

</html>
