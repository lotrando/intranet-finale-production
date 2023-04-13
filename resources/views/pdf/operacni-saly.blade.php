@extends('layouts.blank')

@section('content')
  <div class="container-fluid">
    <div id="printarea" class="col-12">
      <div class="card">
        <div class="card-header bg-{{ $categorie->color }}-lt">
          <div id="print" class="d-print-none btn btn-icon avatar bg-{{ $categorie->color }}-lt col-auto p-2">
            <svg class="icon text-{{ $categorie->color }}" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
              <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
              <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
            </svg>
          </div>
          <div class="">
            <div>
              <h2 class="ms-2 col-auto mb-0">{{ $categorie->category_name }} na období od {{ $from }} do {{ $to }}</h2>
            </div>
          </div>
        </div>
        <div class="card-body p-1">
          <div class="table-responsive">
            <table class="table-vcenter card-table table">
              <thead>
                <tr>
                  <th></th>
                  <th>Lékař</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($daylist as $day)
                  <tr>
                    <td class="py-1">{{ \Carbon\Carbon::parse($day->date)->format('d. m.') }}</td>
                    <td class="py-1">{{ $day->jip }} {{ $day->jip_mobile }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/printThis.js') }}"></script>
  <script>
    $('#print').on('click', function() {
      $("#printarea").printThis();
    })
  </script>
@endsection
