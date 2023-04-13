@extends('layouts.blank')

@section('content')
  <div class="container-fluid">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-{{ $categorie->color }}-lt text-left">
          <div class="d-flex justify-item-center align-items-center">
            <div class="avatar bg-{{ $categorie->color }}-lt col-auto">
              <svg class="icon text-{{ $categorie->color }}" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                <circle cx="18" cy="18" r="4"></circle>
                <path d="M15 3v4"></path>
                <path d="M7 3v4"></path>
                <path d="M3 11h16"></path>
                <path d="M18 16.496v1.504l1 1"></path>
              </svg>
            </div>
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
                  <th>Sestra 1</th>
                  <th>Sestra 2</th>
                  <th>Instumentářka</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($daylist as $day)
                  <tr>
                    <td class="py-1">{{ \Carbon\Carbon::parse($day->date)->format('d. m.') }}</td>
                    <td class="py-1">{{ $day->os_a }}</td>
                    <td class="py-1">{{ $day->os_b }}</td>
                    <td class="py-1">{{ $day->os_c }}</td>
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
