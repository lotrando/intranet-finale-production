@extends('layouts.app')

@section('favicon')
<link type="image/png" href="{{ asset('img/register.png') }}" rel="shortcut icon">
@endsection

@section('main')
<div class="container-fluid">
  <div class="page page-center">
    <div class="container-tight py-2">
      <form class="card card-md shadow-sm" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="mb-1 text-center">
            <a class="navbar-brand navbar-brand-autodark" href="#"><img src="{{ asset('static/logo-khn.png') }}" alt="Tabler logo" height="60"></a>
          </div>
          <div class="mb-6">
            @if ($errors->any())
            <div class="alert alert-danger text-danger shadow">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
          </div>
          <div class="mb-2">
            <label class="form-label">{{ __('Personal number') }}</label>
            <input class="form-control" name="personal_number" type="text" value="{{ old('personal_number') }}" placeholder="{{ __('Personal number') }}">
          </div>
          <div class="mb-2">
            <label class="form-label">{{ __('Name') }}</label>
            <input class="form-control" name="name" type="text" value="{{ old('name') }}" placeholder="{{ __('Name') }}">
          </div>
          <div class="mb-2">
            <label class="form-label">{{ __('Email address') }}</label>
            <input class="form-control" name="email" type="email" value="{{ old('email') }}" placeholder="{{ __('Email address') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Password') }}</label>
            <div class="input-group input-group-flat">
              <input class="form-control" id="password" name="password" type="password" value="{{ old('password') }}" placeholder="{{ __('Password') }}" autocomplete="off">
              <span class="input-group-text">
                <a class="link-secondary cursor-pointer" data-bs-toggle="tooltip" title="{{ __('Click to show passwords') }}" onclick="showPasswords()">
                  <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                  <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                       stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="12" r="2" />
                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                  </svg>
                </a>
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Password confirmation') }}</label>
            <div class="input-group input-group-flat">
              <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
                     placeholder="{{ __('Password confirmation') }}" autocomplete="off">
              <span class="input-group-text">
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-check">
              <input class="form-check-input" id="terms" name="terms" type="checkbox" onClick="check_agree(this.form)" />
              <span class="form-check-label">{{ __('Agree the') }} <a data-bs-toggle="modal" data-bs-target="#modal-terms" href="#">{{ __('terms and policy') }}</a>.</span>
            </label>
          </div>
          <div class="form-footer">
            <button class="btn btn-primary w-100 text-uppercase" id="submitButton" type="submit" value="{{ __('Sign up') }}" disabled>{{ __('Sign up') }}</button>
          </div>
      </form>
      <div class="hr-text">{{ __('or') }}</div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <a class="btn btn-white w-100 hover-shadow" href="{{ route('password.request') }}">
              {{ __('Forgot your password?') }}
            </a>
          </div>
          <div class="col">
            <a class="btn btn-white w-100 hover-shadow" href="{{ route('login') }}">
              {{ __('Sign in') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>



<div class="modal modal-blur fade" id="modal-terms" role="dialog" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Jaké osobní údaje společnost zpracovává ?</h5>
        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Společnost o Vás může shromažďovat údaje, které společnosti sami sdělíte</h3>

        <p class="text-justify">Takovými Osobními údaji jsou zejména údaje, které uvedete ve vyplněném registračním, objednávkovém či jiném formuláři, nebo které Společnosti
          sdělíte prostřednictvím mailu, telefonu, mobilu, faxu či jiného obdobného zařízení. Jedná se především o křestní jméno, příjmení, korespondenční adresu, e-mailovou
          adresu, telefonní číslo, údaje o bankovním účtu, údaje o zvolené platební metodě apod.
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn me-auto float-left" data-bs-dismiss="modal" type="button">{{ __('Close') }}</button>
      </div>
    </div>
  </div>
</div>

<script>
  function showPasswords() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }

      var y = document.getElementById("password_confirmation");
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
</script>
<script>
  function check_agree(form) {
      if (form.terms.checked) {
        form.submitButton.disabled = false;
      } else {
        form.submitButton.disabled = true;;
      }
    }
</script>
@endsection
