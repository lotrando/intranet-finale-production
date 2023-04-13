@extends('layouts.app')

@section('main')
  <div class="page page-center">
    <div class="container-tight py-4">
      <form class="card card-md" action="{{ route('password.update') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
          <div class="mb-4 text-center">
            <a class="navbar-brand navbar-brand-autodark" href="#"><img src="{{ asset('static/logo-khn.png') }}" alt="Tabler logo" height="80"></a>
          </div>
          <div class="alert alert-info text-justify shadow-sm" role="alert">
            <h4 class="alert-title">{{ __('Reset password') }}</h4>
            <div class="text-muted">
              {{ __('Enter your new password and confirm it.') }}
            </div>
          </div>
          <div class="mb-6">
            @if ($errors->any())
              <div class="alert alert-danger text-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Email address') }}</label>
            <input class="form-control" name="email" type="email" value="{{ request()->email }}" placeholder="{{ __('Email address') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('New password') }}</label>
            <div class="input-group input-group-flat">
              <input class="form-control" id="password" name="password" type="password" value="{{ old('password') }}" placeholder="{{ __('Password') }}" autocomplete="off">
              <span class="input-group-text">
                <a class="link-secondary cursor-pointer" data-bs-toggle="tooltip" title="Show passwords" onclick="showPasswords()">
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
            <label class="form-label">{{ __('Confirm new password') }}</label>
            <div class="input-group input-group-flat">
              <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
                placeholder="{{ __('Password confirmation') }}" autocomplete="off">
              <span class="input-group-text">
              </span>
            </div>
          </div>
          <input name="token" type="hidden" value="{{ request()->token }}">
          <div class="form-footer">
            <button class="btn btn-primary w-100 text-uppercase" type="submit">{{ __('Reset password') }}</button>
          </div>
        </div>
        <div class="hr-text">{{ __('or') }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <a class="btn btn-white w-100 hover-shadow" href="{{ route('login') }}">
                {{ __('Sign in') }}
              </a>
            </div>
            <div class="col">
              <a class="btn btn-white w-100 hover-shadow" href="{{ route('register') }}">
                {{ __('Sign up') }}
              </a>
            </div>
          </div>
        </div>
      </form>
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
@endsection
