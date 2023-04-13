@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/' . $categorie->category_icon) ?? ' ' }}" rel="shortcut icon">
@endsection

@section('content')
  <div class="page-wrapper">
    {{-- Page header --}}
    <div class="page-header d-print-none">
      <div class="container-fluid">
        {{-- category buttons --}}
        <div class="row g-1 d-flex justify-content-center">
          @foreach ($rozpisy as $category)
            <div class="col-1">
              <a class="btn bg-{{ $category->color }}-lt hover-shadow-sm w-100" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="{{ __('' . $category->category_name . '') }}"
                href="/{{ $category->category_file }}/{{ $category->folder_name . '/' . $category->id }}">
                <span class="d-inline d-sm-inline d-md-none d-lg-inline d-xl-inline">{!! $category->svg_icon !!}</span>
                <span class="d-none d-md-inline d-lg-inline d-xl-inline pe-1">{{ $category->category_name }}</span>
              </a>
            </div>
          @endforeach
        </div>
        {{-- Searchers --}}
        <div class="row g-1 mt-2">
          {{-- Document search --}}
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
                <input class="form-control" id="search" type="text" placeholder="{{ __('v dokumentech ...') }}">
              </div>
            </form>
          </div>

          {{-- Employees search --}}
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
                <input class="form-control" id="search-employee" type="text" placeholder="{{ __('v zaměstnancích ...') }}">
              </div>
            </form>
          </div>

          {{-- Searched events --}}
          <div>
            <div class="display mt-2 mb-1" id="display"></div>
          </div>

        </div>
        {{-- Title --}}
        <div class="row align-items-center mx-1 mt-1">
          <div class="col">
            {{-- Page Pretitle --}}
            <div class="page-pretitle text-primary">
              {{ __($pretitle) ?? '' }}
            </div>
            {{-- Page Title --}}
            <h2 class="page-title text-primary">
              {{ __(ucfirst($categorie->category_name)) ?? '' }}
            </h2>
          </div>
        </div>

      </div>
      {{-- Title End --}}
    </div>
    {{-- Container End --}}
  </div>
  {{-- Page header End --}}

  {{-- Page body --}}
  <div class="page-body">
    <div class="container-fluid">
      <div class="row p-2">
        <div class="col-12 col-xl-6 mt-1">
          <div class="card">
            <div class="card-header bg-{{ $categorie->color }}-lt text-left">
              <div class="d-flex justify-item-center align-items-center">
                <div class="avatar bg-{{ $categorie->color }}-lt col-auto">
                  <svg class="icon text-{{ $categorie->color }}" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
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
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
              <div class="divide-y">
                @foreach ($daylist as $day)
                  <div>
                    <div class="row d-flex align-items-center justify-content-between">
                      <div class="col-auto">
                        @if (date('N', strtotime($day->date)) >= 6)
                          <span class="avatar bg-pink-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                        @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                          <span class="avatar bg-lime-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                        @else
                          <span class="avatar bg-blue-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                        @endif
                      </div>
                      @if (date('N', strtotime($day->date)) >= 6)
                        <div class="d-flex align-items-center justify-content-start col-1">
                          <span>
                            <div class="text-pink">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                          </span>
                        </div>
                      @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                        <div class="d-flex align-items-center justify-content-start col-1">
                          <span>
                            <div class="text-lime">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                          </span>
                        </div>
                      @else
                        <div class="d-flex align-items-center justify-content-start col-1">
                          <span>
                            <div class="text-azure">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                          </span>
                        </div>
                      @endif
                      @auth
                        <div class="col-12 col-lg-3">
                          <select class="form-select edit-a" name="os_a[{{ $day->id }}]" data-id="{{ $day->id }}">
                            <option value="">Změnit lékaře</option>
                            @foreach ($os_sestry as $doctor)
                              <option value="{{ $doctor->last_name . ' ' . $doctor->first_name }}" @if ($day->os_a == $doctor->last_name . ' ' . $doctor->first_name) selected @endif
                                data-mobile="{{ $doctor->mobile }}">
                                {{ $doctor->last_name }} {{ $doctor->first_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-lg-3">
                          <select class="form-select edit-b" name="os_b[{{ $day->id }}]" data-id="{{ $day->id }}">
                            <option value="">Změnit lékaře</option>
                            @foreach ($os_sestry as $doctor)
                              <option value="{{ $doctor->last_name . ' ' . $doctor->first_name }}" @if ($day->os_b == $doctor->last_name . ' ' . $doctor->first_name) selected @endif
                                data-mobile="{{ $doctor->mobile }}">
                                {{ $doctor->last_name }} {{ $doctor->first_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-lg-3">
                          <select class="form-select edit-c" name="os_c[{{ $day->id }}]" data-id="{{ $day->id }}">
                            <option value="">Změnit lékaře</option>
                            @foreach ($os_sestry as $doctor)
                              <option value="{{ $doctor->last_name . ' ' . $doctor->first_name }}" @if ($day->os_c == $doctor->last_name . ' ' . $doctor->first_name) selected @endif
                                data-mobile="{{ $doctor->mobile }}">
                                {{ $doctor->last_name }} {{ $doctor->first_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      @else
                        <div class="col-2 d-flex align-items-center justify-content-start">
                          <div class="text-truncate fw-bold">{{ $day->os_a }}</div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-start">
                          <div class="text-truncate fw-bold">{{ $day->os_b }}</div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-start">
                          <div class="text-truncate fw-bold">{{ $day->os_c }}</div>
                        </div>
                      @endauth
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-6 mt-1">
          <div class="card">
            <div class="card-header bg-{{ $categorie->color }}-lt text-left">
              <div class="d-flex justify-item-center align-items-center">
                <div class="avatar bg-{{ $categorie->color }}-lt col-auto">
                  <svg class="icon text-{{ $categorie->color }}" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                  <h2 class="ms-2 col-auto mb-0">{{ $categorie->category_name }} - Následující měsíc</h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="divide-y">
                @foreach ($daylistNext as $day)
                  <div>
                    <div class="row d-flex align-items-center justify-content-between">
                      <div class="col-auto">
                        @if (date('N', strtotime($day->date)) >= 6)
                          <span class="avatar bg-pink-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                        @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                          <span class="avatar bg-lime-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                        @else
                          <span class="avatar bg-blue-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                        @endif
                      </div>
                      @if (date('N', strtotime($day->date)) >= 6)
                        <div class="d-flex align-items-center justify-content-start col-1">
                          <span>
                            <div class="text-pink">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                          </span>
                        </div>
                      @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                        <div class="d-flex align-items-center justify-content-start col-1">
                          <span>
                            <div class="text-lime">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                          </span>
                        </div>
                      @else
                        <div class="d-flex align-items-center justify-content-start col-1">
                          <span>
                            <div class="text-azure">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                          </span>
                        </div>
                      @endif
                      @auth
                        <div class="col-12 col-lg-3">
                          <select class="form-select edit-a" name="os_a[{{ $day->id }}]" data-id="{{ $day->id }}">
                            <option value="">Změnit lékaře</option>
                            @foreach ($os_sestry as $doctor)
                              <option value="{{ $doctor->last_name . ' ' . $doctor->first_name }}" @if ($day->os_a == $doctor->last_name . ' ' . $doctor->first_name) selected @endif
                                data-mobile="{{ $doctor->mobile }}">
                                {{ $doctor->last_name }} {{ $doctor->first_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-lg-3">
                          <select class="form-select edit-b" name="os_b[{{ $day->id }}]" data-id="{{ $day->id }}">
                            <option value="">Změnit lékaře</option>
                            @foreach ($os_sestry as $doctor)
                              <option value="{{ $doctor->last_name . ' ' . $doctor->first_name }}" @if ($day->os_b == $doctor->last_name . ' ' . $doctor->first_name) selected @endif
                                data-mobile="{{ $doctor->mobile }}">
                                {{ $doctor->last_name }} {{ $doctor->first_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-lg-3">
                          <select class="form-select edit-c" name="os_c[{{ $day->id }}]" data-id="{{ $day->id }}">
                            <option value="">Změnit lékaře</option>
                            @foreach ($os_sestry as $doctor)
                              <option value="{{ $doctor->last_name . ' ' . $doctor->first_name }}" @if ($day->os_c == $doctor->last_name . ' ' . $doctor->first_name) selected @endif
                                data-mobile="{{ $doctor->mobile }}">
                                {{ $doctor->last_name }} {{ $doctor->first_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      @else
                        <div class="col-2 d-flex align-items-center justify-content-start">
                          <div class="text-truncate fw-bold">{{ $day->os_a }}</div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-start">
                          <div class="text-truncate fw-bold">{{ $day->os_b }}</div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-start">
                          <div class="text-truncate fw-bold">{{ $day->os_c }}</div>
                        </div>
                      @endauth
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- Page End -->
      </div>
      <!-- Page Wrapper End -->
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $('.edit-a').on('change', function() {
      var value = $(this).val();
      var id = $(this).data('id');
      $.ajax({
        type: 'POST',
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/sluzby/operacni-saly/update/" + id,
        data: {
          os_a: value,
          id: id
        },
        dataType: "json",
        success: function(data) {
          console.log('success')
          location.reload()
        }
      });
    });

    $('.edit-b').on('change', function() {
      var value = $(this).val();
      var id = $(this).data('id');
      $.ajax({
        type: 'POST',
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/sluzby/operacni-saly/update/" + id,
        data: {
          os_b: value,
          id: id
        },
        dataType: "json",
        success: function(data) {
          console.log('success')
          location.reload()
        }
      });
    });

    $('.edit-c').on('change', function() {
      var value = $(this).val();
      var id = $(this).data('id');
      $.ajax({
        type: 'POST',
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/sluzby/operacni-saly/update/" + id,
        data: {
          os_c: value,
          id: id
        },
        dataType: "json",
        success: function(data) {
          console.log('success')
          location.reload()
        }
      });
    });
  </script>
@endsection
