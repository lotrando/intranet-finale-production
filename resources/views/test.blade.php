@extends('layouts.blank')

@section('favicon')
<link type="image/png" href="{{ asset('img/test.png') }}" rel="shortcut icon">
@endsection

@section('content')
<div class="page-wrapper">

  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-fluid">
      <div class="row align-items-center">
        <!-- Page pre-title -->
        <div class="col">
          <div class="page-pretitle text-primary">
            {{ __($pretitle) ?? '' }}
          </div>
          <h2 class="page-title text-primary">
            {{ __($title) ?? '' }}
          </h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-5">

          <div class="col-2 col-sm-2 col-md-2 col-xl-1 col-xxl-1 py-3">
            <a href="#" class="btn btn-tabler w-100">
              <!-- Download SVG icon from http://tabler-icons.io/i/brand-tabler -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M8 9l3 3l-3 3"></path>
                <line x1="13" y1="15" x2="16" y2="15"></line>
                <rect x="4" y="4" width="16" height="16" rx="4"></rect>
              </svg>
              Tabler
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
<!-- Wrapper End -->
@endsection

@section('scripts')
<script src="{{ asset('') }}"></script>
@endsection
