@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/bozppo.png') }}" rel="shortcut icon">
@endsection

@section('content')
  {{-- Page wrapper --}}
  <div class="page-wrapper">

    {{-- Page header --}}
    <div class="page-header d-print-none">
      <div class="container-fluid">
        <div class="row align-items-center">

          {{-- Page pre-title --}}
          <div class="col">
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
    <div class="page-body">
      <div class="container-fluid">
        <div class="row row-cards">
          <div class="col-12 col-lg-4">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title">Hasit umí a může každý ( jak hasit )</h3>
                <video poster="{{ asset('videa/jak_hasit.jpg') }}" width="100%" controls>
                  <source src="{{ asset('videa/jak_hasit.mp4') }}" type="video/mp4">
                  Váš prohlížeč nepodporuje přehrávání videí
                </video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Page body --}}

  </div>
  <!-- Wrapper End -->
@endsection
