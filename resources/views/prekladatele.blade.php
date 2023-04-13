@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/prekladatele.png') }}" rel="shortcut icon">
@endsection

@section('content')
  <!-- Page wraper -->
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
    <!-- End Page header -->

    <!-- Page body -->
    <div class="page-body">
      <div class="container-fluid">
        <div class="row justify-content-center g-3">

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-gb shadow"></span>
                  </li>
                  <li>
                    Angličtina
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Miškej Marek</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 602 526 877</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-gb shadow"></span>
                  </li>
                  <li>
                    Angličtina
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Blažík Martin</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 602 572 711</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-de shadow"></span>
                  </li>
                  <li>
                    Němčina
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Sýkora Dušan</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 724 228 682</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-pl shadow"></span>
                  </li>
                  <li>
                    Polština
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Brzeżański Henryk</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 602 584 406</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-pl shadow"></span>
                  </li>
                  <li>
                    Polština
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Najder Roman</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 602 459 741</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-fr shadow"></span>
                  </li>
                  <li>
                    Francouština
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Holomek Karel</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 724 513 902</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-ru shadow"></span>
                  </li>
                  <li>
                    Ruština
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Kryvoruchko Stanislav</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 777 909 546</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body p-4 text-center">
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-lg flag-country-ua shadow"></span>
                  </li>
                  <li>
                    Ukrajinština
                  </li>
                  <h2 class="fw-bold my-1">MUDr. Kryvoruchko Stanislav</h2>
                  <div class="mt-3 text-center">
                    <a class="btn bg-azure-lt w-100" href="#">+420 777 909 546</a>
                  </div>
              </div>
            </div>
          </div>

          {{-- <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card card-sm hover-shadow-sm">
              <div class="card-body text-center">
                <div class="avatar avatar-lg shadow">
                  <img class="rounded-2 mb-3 shadow-sm" src="{{ asset('foto/63416.jpg') }}" alt="MUDr. Sýkora Dušan">
                </div>
                <h3 class="fw-bold mt-3">MUDr. Sýkora Dušan</h3>
                <ul class="list-unstyled lh-lg">
                  <li>
                    <span class="flag flag-md flag-country-gb"></span>
                  </li>
                  <li>
                    Angličtina
                  </li>
                  <div class="mt-2 text-center">
                    <a class="btn bg-azure-lt w-100 p-2" href="#">Kontaktovat překladatele</a>
                  </div>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
    </div>

  </div>
  {{-- End page wrapper --}}
@endsection
