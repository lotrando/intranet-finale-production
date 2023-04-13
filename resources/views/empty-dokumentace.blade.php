@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/zmeny-dokumentu.png') }}" rel="shortcut icon">
@endsection

@section('content')
  <div class="container-fluid p-3">
    <div class="row">
      <div class="col-6">
        <form autocomplete="off">
          <div class="input-icon">
            <span class="input-icon-addon">
              <svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
              </svg>
            </span>
            <input class="form-control" id="search" type="text" style="width:100%" placeholder="{{ __('v dokumentech ...') }}">
          </div>
        </form>
      </div>
      <div class="col-6">
        <form autocomplete="off">
          <div class="input-icon">
            <span class="input-icon-addon">
              <svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
              </svg>
            </span>
            <input class="form-control" id="search-employee" type="text" style="width:100%" placeholder="{{ __('v zaměstnancích ...') }}">
          </div>
        </form>
      </div>
    </div>

    <div class="row align-items-center">
      {{-- Searched events --}}
      <div>
        <div class="display mt-2 mb-2" id="display"></div>
      </div>

      {{-- Page pre-title --}}
      <div class="col mt-3">
        <div class="page-pretitle text-primary">
          {{ __($pretitle) ?? '' }}
        </div>
        <h2 class="page-title text-primary">
          {{ __($title) ?? '' }}
        </h2>
      </div>
      {{-- End Page pre-title --}}

      {{-- Page buttons --}}
      <div class="ms-auto d-print-none col-auto">
        <div class="btn-list">
          <div class="d-flex justify-content-end">
            {{-- Buttons --}}
          </div>
        </div>
      </div>
      {{-- End Page buttons --}}

    </div>
  </div>
  </div>

  {{-- Page body --}}
  </div>

  <!-- Page -->
  <div class="row mx-2">
    <div class="col-12">
      <div class="accordion-item bg-white shadow-sm">
        <div class="accordion-body">
          <div class="list-group list-group-flush list-group-hoverable pt-1">
            <div class="list-group-item">
              <div class="row d-flex justify-content-center">
                <div class="text-muted text-truncate pb-1">Nebyly nalezeny žádné změny v dokumentaci</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page End -->
    </div>
    <!-- Page Wrapper End -->
  </div>
@endsection
