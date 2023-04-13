@extends('layouts.blank', [$favicon => 'favicon'])

@section('content')
  <div class="page-wrapper">
    <!-- Page body -->
    <div class="page-body">
      <div class="container-fluid">
        <div class="col-12 d-flex align-items-top justify-content-center">
          <iframe class="vh-100 col-12 overflow-auto" src="{{ url('http://akordapp/SISAkord/Login.aspx?ReturnUrl=%2fSISAkord%2f') }}" title="Obědy"></iframe>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('') }}"></script>
@endsection
