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

          <!-- Page title actions buttons -->
          <div class="ms-auto d-print-none col-auto">
            <div class="btn-list">
              <div class="d-flex justify-content-end">
                <a class="btn btn-lime d-inline-block me-2" id="openPrintModal" data-bs-toggle="tooltip" data-bs-placement="left"
                  data-bs-original-title="{{ __('Vytisknout') }}">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                  </svg>
                  <span class="d-xs-none d-sm-inline d-md-inline d-lg-inline">{{ __('Vytisknout služby') }}</span>
                </a>
              </div>
            </div>
          </div>
          <!-- Page Title Buttons End -->

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
          <div class="col-12 col-xl-4 mt-1">
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
                          <div class="col-12 col-lg-4">
                            <div class="text-blue"> {{ $day->jip }}</div>
                            <div class="text-azure">{{ $day->jip_mobile }}</div>
                          </div>
                          <div class="col-12 col-lg-5">
                            <select class="form-select edit" name="jip[{{ $day->id }}]" data-id="{{ $day->id }}">
                              <option value="">Změnit lékaře</option>
                              @foreach ($doctorsJip as $doctor)
                                <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ substr($doctor->first_name, 0, 1) }}."
                                  @if (old('jip[' . $day->id . ']') == $doctor->title_preffix . ' ' . $doctor->last_name . ' ' . substr($doctor->first_name, 0, 1) . '.') selected @endif data-mobile="{{ $doctor->mobile }}">
                                  {{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ substr($doctor->first_name, 0, 1) }}.
                                </option>
                              @endforeach
                            </select>
                          </div>
                        @else
                          <div class="d-flex-column align-items-center justify-content-center col-3">
                            <div class="text-truncate fw-bold">
                              {{ $day->jip }}
                            </div>
                            <div class="text-azure text-start">
                              {{ $day->jip_mobile }}
                            </div>
                          </div>
                          <div class="d-flex-column align-items-center justify-content-start col-4">
                            <div class="text-truncate fw-bold">
                              {{ $day->jip }}
                            </div>
                            <div class="text-azure text-start">
                              {{ $day->jip_mobile }}
                            </div>
                          </div>
                        @endauth
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-4 mt-1">
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
                    <h2 class="ms-2 col-auto mb-0">{{ $categorie->category_name }} - Předešlý měsíc</h2>
                  </div>
                </div>
              </div>
              <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                <div class="divide-y">
                  @foreach ($daylistPrev as $day)
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
                          <div class="col-12 col-lg-4">
                            <div class="text-blue"> {{ $day->jip }}</div>
                            <div class="text-azure">{{ $day->jip_mobile }}</div>
                          </div>
                          <div class="col-12 col-lg-5">
                            <select class="form-select edit" name="jip[{{ $day->id }}]" data-id="{{ $day->id }}">
                              <option value="">Změnit lékaře</option>
                              @foreach ($doctorsJip as $doctor)
                                <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ substr($doctor->first_name, 0, 1) }}."
                                  @if (old('jip[' . $day->id . ']') == $doctor->title_preffix . ' ' . $doctor->last_name . ' ' . substr($doctor->first_name, 0, 1) . '.') selected @endif data-mobile="{{ $doctor->mobile }}">
                                  {{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ substr($doctor->first_name, 0, 1) }}.
                                </option>
                              @endforeach
                            </select>
                          </div>
                        @else
                          <div class="d-flex-column align-items-center justify-content-center col-3">
                            <div class="text-truncate fw-bold">
                              {{ $day->jip }}
                            </div>
                            <div class="text-azure text-start">
                              {{ $day->jip_mobile }}
                            </div>
                          </div>
                          <div class="d-flex-column align-items-center justify-content-start col-4">
                            <div class="text-truncate fw-bold">
                              {{ $day->jip }}
                            </div>
                            <div class="text-azure text-start">
                              {{ $day->jip_mobile }}
                            </div>
                          </div>
                        @endauth
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-4 mt-1">
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
                          <div class="col-12 col-lg-4">
                            <div class="text-blue"> {{ $day->jip }}</div>
                            <div class="text-azure">{{ $day->jip_mobile }}</div>
                          </div>
                          <div class="col-12 col-lg-5">
                            <select class="form-select edit" name="jip[{{ $day->id }}]" data-id="{{ $day->id }}">
                              <option value="">Změnit lékaře</option>
                              @foreach ($doctorsJip as $doctor)
                                <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ substr($doctor->first_name, 0, 1) }}."
                                  @if (old('jip[' . $day->id . ']') == $doctor->title_preffix . ' ' . $doctor->last_name . ' ' . substr($doctor->first_name, 0, 1) . '.') selected @endif data-mobile="{{ $doctor->mobile }}">
                                  {{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ substr($doctor->first_name, 0, 1) }}.
                                </option>
                              @endforeach
                            </select>
                          </div>
                        @else
                          <div class="d-flex-column align-items-center justify-content-center col-3">
                            <div class="text-truncate fw-bold">
                              {{ $day->jip }}
                            </div>
                            <div class="text-azure text-start">
                              {{ $day->jip_mobile }}
                            </div>
                          </div>
                          <div class="d-flex-column align-items-center justify-content-start col-4">
                            <div class="text-truncate fw-bold">
                              {{ $day->jip }}
                            </div>
                            <div class="text-azure text-start">
                              {{ $day->jip_mobile }}
                            </div>
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

  @section('modals')
    {{-- Document Show Modal --}}
    <div class="modal fade" id="printModal" role="dialog" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg">
          {{-- <div class="modal-header bg-{{ $categorie->color }}-lt">
            <div class="modal-title">{{ $categorie->category_name }} na období od {{ $from }} do {{ $to }}</div>
            <div class="avatar avatar-transparent bg-{{ $categorie->color }}-lt">
              <svg class="icon text-{{ $categorie->color }}" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
              </svg>
            </div>
          </div> --}}
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div id="printarea">
                  <div class="card" style="height: 45rem">
                    <div class="card-header bg-muted-lt">
                      <div>
                        <h2 class="ms-2 col-auto mb-0">{{ $categorie->category_name }} na období od {{ $from }} do {{ $to }}
                        </h2>
                      </div>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow p-1">
                      <div class="table-responsive">
                        <table class="table-vcenter card-table table">
                          <thead>
                            <tr>
                              <th>Datum</th>
                              <th>Služba</th>
                              <th>Mobil</th>
                              <th>Změna</th>
                              <th>Příslužba</th>
                              <th>Mobil</th>
                              <th>Změna</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($daylist as $day)
                              <tr>
                                <td class="py-0">{{ \Carbon\Carbon::parse($day->date)->format('d. m.') }}</td>
                                <td class="py-0">{{ $day->jip }}</td>
                                <td class="py-0">{{ $day->jip_mobile }}</td>
                                <td class="py-0"></td>
                                <td class="py-0">{{ $day->jip }}</td>
                                <td class="py-0">{{ $day->jip_mobile }}</td>
                                <td class="py-0"></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
              <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                <path d="M10 10l4 4m0 -4l-4 4"></path>
              </svg>
              {{ __('Close') }}
            </button>
            <a class="btn btn-red ms-auto hover-shadow" id="print" type="button">
              <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
              </svg>
              {{ __('Vytisknout') }}</a>
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

      $('#openPrintModal').click(function() {
        $('#printModal').modal('show')
      })

      $('.edit').on('change', function() {
        var value = $(this).val();
        var mobile = $(this).find(":selected").data('mobile');
        var id = $(this).data('id');
        $.ajax({
          type: 'POST',
          headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/sluzby/jip/update/" + id,
          data: {
            jip_mobile: mobile,
            jip: value,
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
