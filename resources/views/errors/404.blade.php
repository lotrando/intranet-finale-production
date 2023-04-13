@extends('layouts.blank')

@section('content')
<div class="container-tight h-100 d-flex align-items-center">
  <div class="empty">
    <div class="empty-header">404</div>
    <p class="empty-title text-red">{{ __('Oops… You just found an error page') }}</p>
    <p class="empty-subtitle text-muted">
      {{ __('We are sorry,') }}
    </p>
    <p class="empty-subtitle text-muted">
      {{ __('but the file or page not exists') }}
    </p>
    <a class="btn" href="#"><svg class="icon text-red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <circle cx="12" cy="12" r="4"></circle>
        <circle cx="12" cy="12" r="9"></circle>
        <line x1="15" y1="15" x2="18.35" y2="18.35"></line>
        <line x1="9" y1="15" x2="5.65" y2="18.35"></line>
        <line x1="5.65" y1="5.65" x2="9" y2="9"></line>
        <line x1="18.35" y1="5.65" x2="15" y2="9"></line>
      </svg>
      {{ __('Odeslat helpdesk požadavek') }}</a>
    <div class="empty-action">
      <a class="btn btn-primary" href="{{ url()->previous() }}">
        <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
             stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <line x1="5" y1="12" x2="19" y2="12" />
          <line x1="5" y1="12" x2="11" y2="18" />
          <line x1="5" y1="12" x2="11" y2="6" />
        </svg>
        {{ __('Na předešlou stránku') }}
      </a>
    </div>
  </div>
</div>
@endsection
