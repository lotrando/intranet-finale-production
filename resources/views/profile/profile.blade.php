@extends('layouts.blank')

@section('favicon')
<link type="image/png" href="./img/user.png" rel="shortcut icon">
@endsection

@section('content')
{{-- Page wrapper --}}
<div class="page-wrapper">

  {{-- Page header --}}
  <div class="page-header d-print-none">
    <div class="container">
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
  {{-- Page wrapper --}}
  <div class="page-wrapper vh-100">
    <!-- Page body -->
    <div class="page-body">
      <div class="container">
        <div class="card">
          <div class="row g-0">
            <div class="col-2 d-none d-md-block border-end">
              <div class="card-body">
                <h4 class="subheader">Profil</h4>
                <div class="list-group list-group-transparent">
                  <a href="./settings.html" class="list-group-item list-group-item-action d-flex align-items-center active">Osobní údaje</a>
                  <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Oblíbené</a>
                </div>
                <h4 class="subheader mt-4">Heslo</h4>
                <div class="list-group list-group-transparent">
                  <a href="#" class="list-group-item list-group-item-action">Změna hesla</a>
                </div>
              </div>
            </div>
            <div class="col d-flex flex-column">
              <div class="card-body">
                <h2 class="mb-4">Osobní údaje</h2>
                <h3 class="card-title">Fotografie</h3>
                <div class="row align-items-center">
                  <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(../foto/61625.jpg)"></span>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="btn">
                      Změnit fotografii
                    </a>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="btn btn-danger">
                      Ostranit fotografii
                    </a>
                  </div>
                </div>
                <h3 class="card-title mt-4">Tiul, Příjmení, Jméno</h3>
                <div class="row g-3">
                  <div class="col-md">
                    <div class="form-label">Príjmení</div>
                    <input type="text" class="form-control" value="Tabler">
                  </div>
                  <div class="col-md">
                    <div class="form-label">Business ID</div>
                    <input type="text" class="form-control" value="560afc32">
                  </div>
                  <div class="col-md">
                    <div class="form-label">Location</div>
                    <input type="text" class="form-control" value="Peimei, China">
                  </div>
                </div>
              </div>
              <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                  <a href="#" class="btn">
                    Cancel
                  </a>
                  <a href="#" class="btn btn-primary">
                    Submit
                  </a>
                </div>
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
