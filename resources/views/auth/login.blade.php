@extends('layouts.app')

@section('favicon')
<link type="image/png" href="{{ asset('img/login.png') }}" rel="shortcut icon">
@endsection

@section('main')
<div class="page page-center">
  <div class="container-tight py-2">
    <form class="card card-md shadow-sm" action="{{ route('login') }}" method="POST" autocomplete="off">
      @csrf
      <div class="card-body">
        <div class="mb-4 text-center">
          <a class="navbar-brand navbar-brand-autodark" href="#"><img src="{{ asset('static/logo-khn.png') }}" alt="Tabler logo" height="60"></a>
        </div>
        {{-- <h1 class="text-center">{{ __('Sign in') }}</h1> --}}
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
          <label class="form-label">
            {{ __('Password') }}
          </label>
          <div class="input-group input-group-flat">
            <input class="form-control" id="password" name="password" type="password" value="{{ old('password') }}" placeholder="{{ __('User password') }}" autocomplete="off">
            <span class="input-group-text">
              <a class="link-secondary cursor-pointer" data-bs-toggle="tooltip" title="{{ __('Click to show password') }}" onclick="showPassword()">
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
        <div class="my-2">
          <label class="form-check">
            <input class="form-check-input" name="remember" type="checkbox" />
            <span class="form-check-label">{{ __('Remember me on this device') }}</span>
          </label>
        </div>
        <div class="form-footer">
          <button class="btn btn-blue w-100 text-uppercase hover-shadow mb-2" type="submit">{{ __('Sign in') }}</button>
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
          <a class="btn btn-white w-100 hover-shadow" href="{{ route('register') }}">
            {{ __('Sign up') }}
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  function showPassword() {
      var element = document.getElementById("password");
      if (element.type === "password") {
        element.type = "text";
      } else {
        element.type = "password";
      }
    };
</script>
@endsection
