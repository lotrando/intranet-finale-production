@extends('layouts.app')

@section('main')
  <div class="page">
    <div class="container-fluid py-2 pt-3">
      @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
          {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
      @endif
      <div class="card card-md shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div class="text-muted">
              {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>
            <form method="POST" action="{{ route('verification.send') }}">
              @csrf
              <button class="btn btn-info" type="submit">
                {{ __('Resend Verification Email') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endsection
