@php
  $i = 1;
@endphp

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
          @foreach ($docs as $category)
            <div class="col-1">
              <a class="btn bg-{{ $category->color }}-lt hover-shadow-sm w-100" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="{{ __('' . $category->category_name . '') }}"
                href="/{{ $category->category_file }}/{{ $category->folder_name . '/' . $category->id }}">
                <span class="d-inline d-sm-inline d-md-none d-lg-inline d-xl-inline pe-0">{!! $category->svg_icon !!}</span>
                <span class="d-none d-md-inline d-lg-inline d-xl-inline pe-0">{{ $category->category_name }}</span>
                {{-- <span class="text-small">
                  {{ $category->documents->count() }}
                </span> --}}
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
          {{-- Page buttons --}}
          <div class="ms-auto d-print-none col-auto">
            <div class="btn-list">

              @auth
                <button class="btn btn-lime d-inline-block me-2" id="openCreateModal" data-bs-toggle="tooltip" data-bs-placement="left"
                  data-bs-original-title="{{ __('Vytvoří nový ' . $categorie->category_type . '') }}">
                  <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                    </path>
                    <rect x="9" y="3" width="6" height="4" rx="2">
                    </rect>
                    <path d="M10 14h4"></path>
                    <path d="M12 12v4"></path>
                  </svg>
                  <span class="d-xs-none d-sm-inline d-md-inline d-lg-inline">{{ __('Nový') }}</span>
                </button>
              @endauth

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
          <div class="col-12">

            {{-- Documents --}}
            <div>
              @foreach ($documents as $document)
                <div class="accordion-item bg-white shadow-sm">
                  <div id="test-{{ $document->id }}">
                    <div class="accordion-body">
                      <div class="list-group list-group-flush list-group-hoverable py-2">
                        <div class="list-group-item border-0 p-0">
                          <div class="row align-items-center g-3 mx-1">
                            <div class="avatar bg-{{ $document->category->color }}-lt col-auto">
                              <div class="text-uppercase">
                                {!! $document->category->svg_icon !!}
                              </div>
                            </div>
                            <div class="col-auto">
                              <a href="{{ route('soubory.' . $document->category->category_type . '.download', $document->id) }}" target="_blank">
                                <span class="avatar bg-{{ $document->category->color }}-lt" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-original-title="Stáhnout soubor .{{ substr($document->file, strpos($document->file, '.') + 1) }}">
                                  @if (substr($document->file, strpos($document->file, '.') + 1) == 'pdf')
                                    <img src="{{ asset('img/files/pdf.png') }}" alt="PDF" height="32px">
                                  @elseif(substr($document->file, strpos($document->file, '.') + 1) == 'xlsx')
                                    <img src="{{ asset('img/files/xlsx.png') }}" alt="XLSX" height="32px">
                                  @elseif(substr($document->file, strpos($document->file, '.') + 1) == 'docx')
                                    <img src="{{ asset('img/files/docx.png') }}" alt="DOCX" height="32px">
                                  @elseif(substr($document->file, strpos($document->file, '.') + 1) == 'pptx')
                                    <img src="{{ asset('img/files/pptx.png') }}" alt="PPTX" height="32px">
                                  @endif
                                </span>
                              </a>
                            </div>
                            <div class="col text-truncate" id="{{ $document->id }}">
                              <span>
                                <p class="@if (substr($document->file, strpos($document->file, '.') + 1) == 'pdf') show text-primary cursor-pointer @else text-azure text-decoration-none @endif mb-0 block"
                                  id="{{ $document->id }}">
                                  @if ($categorie->id != 3)
                                    {{ $i++ . '.' }}
                                  @endif
                                  <span data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="
                                    @if (substr($document->file, strpos($document->file, '.') + 1) == 'pdf') Náhled souboru .pdf @else Náhled souboru typu MS Office není možný @endif"
                                    style="margin-bottom: 0;">{{ $document->name }}</span>
                                  @if ($document->addons->count() > 0)
                                    <span class="description text-blue text-truncate"> - celkem příloh ({{ $document->addons->count() }})</span>
                                  @endif
                                </p>
                              </span>
                              <div class="d-block description text-muted text-truncate">
                                <span class="text-{{ $document->category->color }}">{{ ucfirst($document->category->button) }}
                                  {{ $document->category->category_type }}</span> - {{ $document->description }}
                              </div>
                            </div>
                            @auth
                              <div class="col-auto">
                                <span class="btn btn-icon hover-shadow cursor-pointer" data-bs-toggle="dropdown">
                                  <svg class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <line x1="4" y1="6" x2="20" y2="6"></line>
                                    <line x1="4" y1="12" x2="20" y2="12"></line>
                                    <line x1="4" y1="18" x2="20" y2="18"></line>
                                  </svg>
                                </span>
                                <ul class="dropdown-menu">
                                  <li class="dropdown-item edit" id="{{ $document->id }}">
                                    <svg class="icon dropdown-item-icon-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                      <path d="M16 5l3 3" />
                                    </svg>
                                    {{ __('Upravit dokument') }}
                                  </li>
                                  <li class="dropdown-item addon" id="{{ $document->id }}">
                                    <svg class="icon dropdown-item-icon-addon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                      </path>
                                      <path d="M12 11l0 6"></path>
                                      <path d="M9 14l6 0"></path>
                                    </svg>
                                    {{ __('Vložit přílohu') }}
                                  </li>
                                  @if ($document->addons->isEmpty())
                                    <li class="dropdown-item delete" id="{{ $document->id }}'" disabled>
                                      <svg class="icon dropdown-item-icon-delete" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                        </path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                        </path>
                                        <path d="M10 12l4 4m0 -4l-4 4"></path>
                                      </svg>
                                      {{ __('Odstranit dokument') }}
                                    </li>
                                  @endif
                                </ul>
                              </div>
                            @endauth
                          </div>
                        </div>
                        <div class="list-group-item py-1 px-1">
                          <div class="row d-flex justify-content-between">
                            <div class="col-auto">
                              <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="15" cy="15" r="3">
                                </circle>
                                <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                                <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73">
                                </path>
                                <line x1="6" y1="9" x2="18" y2="9"></line>
                                <line x1="6" y1="12" x2="9" y2="12"></line>
                                <line x1="6" y1="15" x2="8" y2="15"></line>
                              </svg>
                              <span class="text-muted description">Revize:
                                {{ $document->revision }}</span>
                              @if (Carbon\Carbon::parse($document->created_at)->addDays(1) >= Carbon\Carbon::today())
                                <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">Nový!</span>
                              @endif
                              @if ($document->status == 'Rozpracováno')
                                <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">Rozpracováno</span>
                              @else
                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Schváleno</span>
                              @endif
                              <span class="text-muted description">{{ Carbon\Carbon::parse($document->updated_at)->diffForHumans() }}</span>
                              @if ($document->onscreen != 0)
                                <span class="badge badge-sm bg-orange-lt text-uppercase ms-auto">Zobrazeno také v dokumentaci -
                                  {{ App\Models\Category::whereId($document->onscreen)->pluck('category_name')->first() }}</span>
                              @endif
                              @if (Carbon\Carbon::parse($document->updated_at)->addDays(7) >= Carbon\Carbon::now())
                                <span class="badge badge-sm bg-lime-lt text-uppercase ms-auto">Aktualizováno
                                  !</span>
                              @endif
                            </div>
                            <div class="d-xs-none d-sm-none d-lg-inline col-auto">
                              @auth
                                <div class="d-xs-none d-sm-none d-lg-inline col-auto">
                                  <span class="text-muted description">
                                    <svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                      </path>
                                      <rect x="9" y="3" width="6" height="4" rx="2">
                                      </rect>
                                      <path d="M9 12v-1h6v1"></path>
                                      <path d="M12 11v6"></path>
                                      <path d="M11 17h2"></path>
                                    </svg>
                                    Zpracoval: {{ $document->processed }}
                                  </span>
                                  <span class="text-muted description">
                                    <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5"></path>
                                      <circle cx="16.5" cy="17.5" r="2.5"></circle>
                                      <line x1="18.5" y1="19.5" x2="21" y2="22"></line>
                                    </svg>
                                    Přezkoumal: {{ $document->examine }}
                                  </span>
                                  <span class="text-muted description">
                                    <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path>
                                      <circle cx="6" cy="14" r="3"></circle>
                                      <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path>
                                    </svg>
                                    Autorizoval: {{ $document->authorize }}
                                  </span>
                                </div>
                              @endauth
                            </div>
                          </div>
                        </div>
                      </div>
                      @if (!$document->addons->isEmpty())
                        <div class="hr-text m-0 mb-2">{{ __('přílohy') }}</div>
                      @endif
                      @foreach ($document->addons as $add)
                        <div class="row align-items-center g-3 mx-1 mb-1">
                          <div class="avatar bg-{{ $document->category->color }}-lt col-auto">
                            <div class="text-uppercase">
                              <svg class="icon icon-tabler icon-tabler-plus text-{{ $document->category->color }}" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="/soubory/{{ $document->category->category_type }}/priloha/{{ $add->id }}">
                              <span class="avatar bg-{{ $document->category->color }}-lt" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Stáhnout soubor .{{ substr($add->file, strpos($add->file, '.') + 1) }}">
                                @if (substr($add->file, strpos($add->file, '.') + 1) == 'pdf')
                                  <img src="{{ asset('img/files/pdf.png') }}" alt="PDF" height="32px">
                                @elseif(substr($add->file, strpos($add->file, '.') + 1) == 'xlsx')
                                  <img src="{{ asset('img/files/xlsx.png') }}" alt="XLSX" height="32px">
                                @elseif(substr($add->file, strpos($add->file, '.') + 1) == 'docx')
                                  <img src="{{ asset('img/files/docx.png') }}" alt="DOCX" height="32px">
                                @elseif(substr($add->file, strpos($add->file, '.') + 1) == 'pptx')
                                  <img src="{{ asset('img/files/pptx.png') }}" alt="PPTX" height="32px">
                                @endif
                              </span>
                            </a>
                          </div>
                          <div class="col text-truncate" id="{{ $add->id }}">
                            <span>
                              <p class="@if (substr($add->file, strpos($add->file, '.') + 1) == 'pdf') show text-primary cursor-pointer @else d-inline text-muted text-decoration-none @endif"
                                id="{{ $add->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                @if (substr($add->file, strpos($add->file, '.') + 1) == 'pdf') data-bs-original-title="Více informací o dokumentu {{ $add->description }}" style="margin-bottom: 0;" @endif>
                                {{ $add->description }}
                              </p>
                            </span>
                            <div class="d-block description text-muted text-truncate">
                              {{ $add->document->name }} - Příloha č.{{ $add->position }}
                              <svg class="icon icon-tabler icon-tabler-certificate-2 text-yellow" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="15" r="3"></circle>
                                <path d="M10 7h4"></path>
                                <path d="M10 18v4l2 -1l2 1v-4"></path>
                                <path d="M10 19h-2a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-2">
                                </path>
                              </svg>
                              <span class="text-muted description">Revize:
                                {{ $add->revision }}</span>
                            </div>
                          </div>
                          <div class="col-auto">
                            @if (Carbon\Carbon::parse($add->created_at)->addDay() >= Carbon\Carbon::today())
                              <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">Nový
                                !</span>
                            @endif
                            @auth
                              @if ($add->status == 'Rozpracováno')
                                <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">Rozpracováno</span>
                              @else
                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Schváleno</span>
                              @endif
                              @if ($add->onscreen != 0)
                                <span class="badge badge-sm bg-orange-lt text-uppercase ms-auto">Zobrazeno také v dokumentaci -
                                  {{ App\Models\Category::whereId($add->onscreen)->pluck('category_name')->first() }}</span>
                              @endif
                            @endauth
                            @if (Carbon\Carbon::parse($add->updated_at)->addDays(15) >= Carbon\Carbon::now())
                              <span class="badge badge-sm bg-lime-lt text-uppercase ms-auto">Aktualizováno
                                !</span>
                            @endif
                            <span class="text-muted description">{{ Carbon\Carbon::parse($add->updated_at)->diffForHumans() }}</span>
                          </div>
                          @auth
                            <div class="col-auto">
                              <span class="btn btn-icon hover-shadow cursor-pointer" data-bs-toggle="dropdown">
                                <svg class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                  </path>
                                  <line x1="4" y1="6" x2="20" y2="6"></line>
                                  <line x1="4" y1="12" x2="20" y2="12"></line>
                                  <line x1="4" y1="18" x2="20" y2="18"></line>
                                </svg>
                              </span>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item add-edit" id="{{ $add->id }}">
                                  <svg class="icon dropdown-item-icon-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                  </svg>
                                  {{ __('Upravit přílohu') }}
                                </li>
                                <li class="dropdown-item add-delete" id="{{ $add->id }}">
                                  <svg class="icon icon dropdown-item-icon-delete" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <path d="M4 7h16"></path>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                    </path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                    </path>
                                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                                  </svg>
                                  {{ __('Odstranit přílohu') }}
                                </li>
                              </ul>
                            </div>
                          @endauth
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{-- Documents end --}}

            {{-- Standards --}}
            @if ($standards->isNotEmpty())
              <div class="hr-text text-blue m-2 p-3">Standardy</div>
            @endif
            <div>
              @foreach ($standards as $standard)
                <div class="accordion-item bg-white shadow-sm">
                  <div id="test-{{ $document->id }}">
                    <div class="accordion-body">
                      <div class="list-group list-group-flush list-group-hoverable py-2">
                        <div class="list-group-item border-0 p-0">
                          <div class="row align-items-center g-3 mx-1">
                            <div class="avatar bg-{{ $standard->category->color }}-lt col-auto" data-bs-toggle="tooltip" data-bs-placement="top"
                              data-bs-original-title="{{ $standard->category->category_name }} standardy">
                              <a href="/{{ $standard->category->category_file }}/{{ $standard->category->folder_name }}/{{ $standard->category->id }}">
                                <div class="text-uppercase">
                                  {!! $standard->category->svg_icon !!}
                                </div>
                              </a>
                            </div>
                            <div class="col-auto">
                              <a href="{{ route('soubory.standard.download', $standard->id) }}" target="_blank">
                                <span class="avatar bg-{{ $standard->category->color }}-lt" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-original-title="Stáhnout soubor .{{ substr($standard->file, strpos($standard->file, '.') + 1) }}">
                                  @if (substr($standard->file, strpos($standard->file, '.') + 1) == 'pdf')
                                    <img src="{{ asset('img/files/pdf.png') }}" alt="PDF" height="32px">
                                  @elseif(substr($standard->file, strpos($standard->file, '.') + 1) == 'xlsx')
                                    <img src="{{ asset('img/files/xlsx.png') }}" alt="XLSX" height="32px">
                                  @elseif(substr($standard->file, strpos($standard->file, '.') + 1) == 'docx')
                                    <img src="{{ asset('img/files/docx.png') }}" alt="DOCX" height="32px">
                                  @elseif(substr($standard->file, strpos($standard->file, '.') + 1) == 'pptx')
                                    <img src="{{ asset('img/files/pptx.png') }}" alt="PPTX" height="32px">
                                  @endif
                                </span>
                              </a>
                            </div>
                            <div class="col text-truncate" id="{{ $standard->id }}">
                              <span>
                                <p class="@if (substr($standard->file, strpos($standard->file, '.') + 1) == 'pdf') show text-primary cursor-pointer @else d-inline text-muted text-decoration-none @endif"
                                  id="{{ $standard->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                  @if (substr($standard->file, strpos($standard->file, '.') + 1) == 'pdf') data-bs-original-title="Více informací o dokumentu {{ $standard->description }}" style="margin-bottom: 0;" @endif>
                                  {{ $standard->name }} - {{ Str::ucfirst($standard->category->button) }} {{ $standard->category->category_type }}
                                </p>
                              </span>
                              <div class="d-block description text-muted text-truncate">{{ $standard->description }}</div>
                            </div>
                          </div>
                        </div>
                        <div class="list-group-item py-1 px-1">
                          <div class="row d-flex justify-content-between">
                            <div class="col-auto">
                              <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="15" cy="15" r="3">
                                </circle>
                                <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                                <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73">
                                </path>
                                <line x1="6" y1="9" x2="18" y2="9"></line>
                                <line x1="6" y1="12" x2="9" y2="12"></line>
                                <line x1="6" y1="15" x2="8" y2="15"></line>
                              </svg>
                              <span class="text-muted description">Revize:
                                {{ $standard->revision }}</span>
                              @if (Carbon\Carbon::parse($standard->created_at)->addDays(1) >= Carbon\Carbon::today())
                                <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">Nový!</span>
                              @endif
                              @if ($standard->status == 'Rozpracováno')
                                <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">Rozpracováno</span>
                              @else
                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Schváleno</span>
                              @endif
                              <span class="text-muted description">{{ Carbon\Carbon::parse($standard->updated_at)->diffForHumans() }}</span>
                              @if (Carbon\Carbon::parse($standard->updated_at)->addDays(7) >= Carbon\Carbon::now())
                                <span class="badge badge-sm bg-lime-lt text-uppercase ms-auto">Aktualizováno
                                  !</span>
                              @endif
                            </div>
                            <div class="d-xs-none d-sm-none d-lg-inline col-auto">
                              @auth
                                <div class="d-xs-none d-sm-none d-lg-inline col-auto">
                                  <span class="text-muted description">
                                    <svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                      </path>
                                      <rect x="9" y="3" width="6" height="4" rx="2">
                                      </rect>
                                      <path d="M9 12v-1h6v1"></path>
                                      <path d="M12 11v6"></path>
                                      <path d="M11 17h2"></path>
                                    </svg>
                                    Zpracoval: {{ $standard->processed }}
                                  </span>
                                  <span class="text-muted description">
                                    <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5"></path>
                                      <circle cx="16.5" cy="17.5" r="2.5"></circle>
                                      <line x1="18.5" y1="19.5" x2="21" y2="22"></line>
                                    </svg>
                                    Přezkoumal: {{ $standard->examine }}
                                  </span>
                                  <span class="text-muted description">
                                    <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path>
                                      <circle cx="6" cy="14" r="3"></circle>
                                      <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path>
                                    </svg>
                                    Autorizoval: {{ $standard->authorize }}
                                  </span>
                                </div>
                              @endauth
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{-- Standards end --}}

            {{-- Addons --}}
            @if ($addons->isNotEmpty())
              <span class="hr-text text-blue m-2 p-3">Přílohy standadů</span>
            @endif
            <div>
              @foreach ($addons as $addon)
                <div class="accordion-item bg-white shadow-sm">
                  <div id="test-{{ $addon->id }}">
                    <div class="accordion-body">
                      <div class="list-group list-group-flush list-group-hoverable py-2">
                        <div class="list-group-item border-0 p-0">
                          <div class="row align-items-center g-3 mx-1">
                            <div class="avatar bg-{{ $addon->category->color }}-lt col-auto" data-bs-toggle="tooltip" data-bs-placement="top"
                              data-bs-original-title="{{ $addon->category->category_name }} {{ $addon->category->category_file }}">
                              <a href="/{{ $addon->category->category_file }}/{{ $addon->category->folder_name }}/{{ $addon->category->id }}">
                                <div class="text-uppercase">
                                  {!! $addon->category->svg_icon !!}
                                </div>
                              </a>
                            </div>
                            <div class="col-auto">
                              <a href="{{ route('soubory.' . $addon->category->category_type . '.addon.download', $addon->id) }}" target="_blank">
                                <span class="avatar bg-{{ $addon->category->color }}-lt" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-original-title="Stáhnout soubor">
                                    <img src="{{ asset('img/files/pdf.png') }}" alt="PDF" height="32px">
                                  @if(substr($addon->file, strpos($addon->file, '.') + 1) == 'xlsx')
                                    <img src="{{ asset('img/files/xlsx.png') }}" alt="XLSX" height="32px">
                                  @elseif(substr($addon->file, strpos($addon->file, '.') + 1) == 'docx')
                                    <img src="{{ asset('img/files/docx.png') }}" alt="DOCX" height="32px">
                                  @elseif(substr($addon->file, strpos($addon->file, '.') + 1) == 'pptx')
                                    <img src="{{ asset('img/files/pptx.png') }}" alt="PPTX" height="32px">
                                  @endif
                                </span>
                              </a>
                            </div>
                            <div class="col text-truncate" id="{{ $addon->id }}">
                              <span>
                                <p class="@if (substr($addon->file, strpos($addon->file, '.') + 1) == 'pdf') show-addon text-primary cursor-pointer @else d-inline text-muted text-decoration-none @endif"
                                  id="{{ $addon->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                  @if (substr($addon->file, strpos($addon->file, '.') + 1) == 'pdf') data-bs-original-title="Více informací o dokumentu {{ $addon->description }}" style="margin-bottom: 0;" @endif>
                                  {{ $addon->description }}
                                </p>
                              </span>
                              <div class="d-block description text-muted text-truncate">{{ $addon->document->name }} -
                                Příloha č.{{ $addon->position }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="list-group-item py-1 px-1">
                          <div class="row d-flex justify-content-between">
                            <div class="col-auto">
                              <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="15" cy="15" r="3">
                                </circle>
                                <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                                <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73">
                                </path>
                                <line x1="6" y1="9" x2="18" y2="9"></line>
                                <line x1="6" y1="12" x2="9" y2="12"></line>
                                <line x1="6" y1="15" x2="8" y2="15"></line>
                              </svg>
                              <span class="text-muted description">Revize:
                                {{ $addon->revision }}</span>
                              @if (Carbon\Carbon::parse($addon->created_at)->addDays(1) >= Carbon\Carbon::today())
                                <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">Nový!</span>
                              @endif
                              @if ($addon->status == 'Rozpracováno')
                                <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">Rozpracováno</span>
                              @else
                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Schváleno</span>
                              @endif
                              <span class="text-muted description">{{ Carbon\Carbon::parse($addon->updated_at)->diffForHumans() }}</span>
                              @if (Carbon\Carbon::parse($addon->updated_at)->addDays(7) >= Carbon\Carbon::now())
                                <span class="badge badge-sm bg-lime-lt text-uppercase ms-auto">Aktualizováno
                                  !</span>
                              @endif
                            </div>
                            <div class="d-xs-none d-sm-none d-lg-inline col-auto">
                              @auth
                                <div class="d-xs-none d-sm-none d-lg-inline col-auto">
                                  <span class="text-muted description">
                                    <svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                      </path>
                                      <rect x="9" y="3" width="6" height="4" rx="2">
                                      </rect>
                                      <path d="M9 12v-1h6v1"></path>
                                      <path d="M12 11v6"></path>
                                      <path d="M11 17h2"></path>
                                    </svg>
                                    Zpracoval: {{ $addon->processed }}
                                  </span>
                                  <span class="text-muted description">
                                    <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5"></path>
                                      <circle cx="16.5" cy="17.5" r="2.5"></circle>
                                      <line x1="18.5" y1="19.5" x2="21" y2="22"></line>
                                    </svg>
                                    Přezkoumal: {{ $addon->examine }}
                                  </span>
                                  <span class="text-muted description">
                                    <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                      <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path>
                                      <circle cx="6" cy="14" r="3"></circle>
                                      <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path>
                                    </svg>
                                    Autorizoval: {{ $addon->authorize }}
                                  </span>
                                </div>
                              @endauth
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{-- Addons end --}}

            {{-- Printed document --}}
            @if ($warehouse->isNotEmpty())
              <div class="hr-text text-blue m-2 p-3">Předtištěné dokumenty</div>
            @endif
            <div>
              @foreach ($warehouse as $item)
                <div class="accordion-item bg-white shadow-sm">
                  <div id="test-{{ $item->id }}">
                    <div class="accordion-body">
                      <div class="list-group list-group-flush list-group-hoverable py-2">
                        <div class="list-group-item border-0 p-0">
                          <div class="row align-items-center g-3 mx-1">
                            <div class="avatar bg-muted-lt col-auto" data-bs-toggle="tooltip" data-bs-placement="top"
                              data-bs-original-title="Skladová položka">
                              <div class="text-uppercase">
                                <svg class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"></path>
                                  <path d="M12 12l8 -4.5"></path>
                                  <path d="M8.2 9.8l7.6 -4.6"></path>
                                  <path d="M12 12v9"></path>
                                  <path d="M12 12l-8 -4.5"></path>
                                </svg>
                              </div>
                            </div>
                            <div class="col-auto">
                              <span class="avatar bg-muted-lt">
                                <img src="{{ asset('img/files/sklad.png') }}" alt="Skladová položka" height="32px">
                              </span>
                            </div>
                            <div class="col text-truncate">
                              <span>
                                <p class="show d-inline text-primary text-decoration-none" style="margin-bottom: 0;">
                                  MediaPrint vzor č.{{ $item->revision }} - {{ $item->description }}</p>
                              </span>
                              <div class="d-block description text-muted text-truncate">Tento dokument je předtišten a je k
                                dispozici u paní Chrysostomidu email: <a href="mailto:chrysostomidu@khn.cz">chrysostomidu@khn.cz</a> klapka: <span class="text-azure fw-bold">315</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{-- Printed document end --}}

          </div>
        </div>
      </div>
    </div>
    {{-- Page body End --}}
  </div>
@endsection

@section('modals')
  {{-- Main Form Modal --}}
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-full-width mx-1" role="document">
      <div class="modal-content shadow-lg">
        <div id="modal-header">
          <h5 class="modal-title"></h5>
          <div class="avatar avatar-transparent" id="modal-icon"></div>
        </div>
        <form id="inputForm" action="{{ route('documents.create') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <div class="row">
              <input class="form-control" id="category_id" name="category_id" type="hidden">
              <div class="col-2 col-lg-1 mb-2">
                <label class="form-label">{{ __('Position') }} č:</label>
                <input class="form-control" id="position" name="position" type="text">
              </div>
              <div class="col-10 col-lg-5 mb-2">
                <label class="form-label">{{ __('Name') }} <small class="text-azure">usnadní vyhledávání</small></label>
                <input class="form-control" id="name" name="name" type="text" placeholder="{{ __('Název dokumentu') }}">
              </div>
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Revision') }}</label>
                <input class="form-control" id="revision" name="revision" type="text" placeholder="{{ __('Číslo nebo MM/YYYY') }}">
              </div>
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Datum revize') }}</label>
                <input class="form-control" id="revision_date" name="revision_date" type="date" placeholder="{{ __('Revision Date') }}">
              </div>
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Datum další revize') }}</label>
                <input class="form-control" id="next_revision_date" name="next_revision_date" type="date" placeholder="{{ __('Next revision Date') }}">
              </div>
              <div class="col-9 col-lg-10 mb-2">
                <label class="form-label">{{ __('Popis') }} <small class="text-azure">usnadní vyhledávání</small></label>
                <input class="form-control" id="description" name="description" type="text" placeholder="{{ __('Popis dokumentu') }}">
              </div>
              <div class="col-3 col-lg-2 mb-2">
                <label class="form-label">{{ __('Unikátní kód') }}</label>
                <input class="form-control" id="unique_code" name="unique_code" type="text" placeholder="{{ __('Značka #') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-2 mb-2">
                <label class="form-label">{{ __('Vytvořil/a') }}</label>
                <select class="form-select" id="processed" name="processed">
                  <option value="Neuvedeno">Neuvedeno</option>
                  <option value="Kolektiv fyzioterapeutů">Kolektiv fyzioterapeutů</option>
                  <option value="Rada kvality">Rada kvality</option>
                  @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ $doctor->first_name }}">
                      {{ $doctor->last_name }} {{ $doctor->first_name }}, {{ $doctor->title_preffix }}</option>
                  @endforeach
                  <hr>
                </select>
              </div>
              <div class="col-12 col-lg-2 mb-2">
                <label class="form-label">{{ __('Schválil/a') }}</label>
                <select class="form-select" id="authorize" name="authorize">
                  <option value="Neuvedeno">Neuvedeno</option>
                  <option value="Kolektiv fyzioterapeutů">Kolektiv fyzioterapeutů</option>
                  <option value="Rada kvality">Rada kvality</option>
                  @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ $doctor->first_name }}">
                      {{ $doctor->last_name }} {{ $doctor->first_name }}, {{ $doctor->title_preffix }}</option>
                  @endforeach
                  <hr>
                </select>
              </div>
              <div class="col-12 col-lg-2 mb-2">
                <label class="form-label">{{ __('Přezkoumal/a') }}</label>
                <select class="form-select" id="examine" name="examine">
                  <option value="Neuvedeno">Neuvedeno</option>
                  <option value="Kolektiv fyzioterapeutů">Kolektiv fyzioterapeutů</option>
                  <option value="Rada kvality">Rada kvality</option>
                  @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ $doctor->first_name }}">
                      {{ $doctor->last_name }} {{ $doctor->first_name }}, {{ $doctor->title_preffix }}</option>
                  @endforeach
                  <hr>
                </select>
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label class="form-label">{{ __('Oblast působnosti addonu') }} <small class="text-azure">usnadní
                    vyhledávání</small></label>
                <input class="form-control" id="tags" name="tags" type="text" placeholder="{{ __('Zkratky oddělené čárkou (INT-ODD,...)') }}">
              </div>
              <div class="col-12 col-lg-2 mb-2">
                <label class="form-label">{{ __('Platnost od') }}</label>
                <input class="form-control" id="efficiency" name="efficiency" type="date" placeholder="{{ __('Datum platnosti') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-7 mb-2">
                <label class="form-label">{{ __('Soubor') }}</label>
                <input class="form-control" id="file" name="file" type="file" placeholder="{{ __('Soubor standardu ve formátu PDF') }}">
              </div>
              <div class="col-2 col-lg-2 mb-2">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="status" name="status">
                  <option value="Schváleno">Schváleno</option>
                  <option value="Rozpracováno">Rozpracováno</option>
                </select>
              </div>
              <div class="col-2 col-lg-1 mb-2">
                <label class="form-label">{{ __('Infomail') }}</label>
                <select class="form-select" id="infomail" name="infomail">
                  <option value="ne">Ne</option>
                  <option value="ano">Ano</option>
                </select>
              </div>
              {{-- <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Zobrazit v dokumentaci') }}</label>
                <select class="form-select" id="onscreen" name="onscreen">
                  <option value=""></option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
                </select>
              </div> --}}
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Založil / upravil') }}</label>
                <input class="form-control" id="user_name" name="user_name" type="text" readonly>
              </div>
            </div>
            <div class="mt-2">
              <div id="pdf-preview"></div>
            </div>
          </div>
          <input id="action" name="action" type="hidden" />
          <input id="hidden_id" name="hidden_id" type="hidden" />
          <input id="hidden_file" name="hidden_file" type="hidden" />
          <input id="folder_name" name="folder_name" type="hidden" />
          <input id="category_file" name="category_file" type="hidden" />
          <input id="user_id" name="user_id" type="hidden" />

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
            <div class="align-content-end flex">
              <button class="btn btn-primary ms-auto hover-shadow" id="action_button" name="action_button" type="submit">
                <svg class="icon icon-tabler icon-tabler-book-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5"></path>
                  <path d="M11 16h-5a2 2 0 0 0 -2 2"></path>
                  <path d="M15 16l3 -3l3 3"></path>
                  <path d="M18 13v9"></path>
                </svg>
                Upravit {{ $category->category_type }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Addon Form Modal --}}
  <div class="modal fade" id="addFormModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-full-width mx-3" role="document">
      <div class="modal-content shadow-lg">
        <div id="add-modal-header">
          <h5 class="modal-title"></h5>
          <div class="avatar avatar-transparent" id="add-modal-icon"></div>
        </div>
        <form id="addInputForm" action="{{ route('addons.create') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="add_form_result_modal"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-2 col-lg-1 mb-2">
                <label class="form-label">{{ __('Číslo přílohy') }}</label>
                <input class="form-control" id="add_position" name="add_position" type="text">
              </div>
              <div class="col-9 col-lg-9 mb-2">
                <label class="form-label">{{ __('Název přílohy') }} <small class="text-azure">usnadní
                    vyhledávání</small></label>
                <input class="form-control" id="add_description" name="add_description" type="text"
                  placeholder="{{ __('Konkrétní popis přílohy') }}">
              </div>
              <div class="col-1 col-lg-2 mb-2">
                <label class="form-label">{{ __('Revision') }}</label>
                <input class="form-control" id="add_revision" name="add_revision" type="text" placeholder="{{ __('Číslo nebo datum') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6 mb-2">
                <label class="form-label">{{ __('Soubor') }}</label>
                <input class="form-control" id="add_file" name="add_file" type="file" placeholder="{{ __('Příloha dokumentu ve formátu PDF') }}">
              </div>
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Zobrazit v dokumentaci') }}</label>
                <select class="form-select" id="add_onscreen" name="add_onscreen">
                  <option value="">Nezobrazovat v dokumentaci</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="add_status" name="add_status">
                  <option value="Schváleno">Schváleno</option>
                  <option value="Rozpracováno">Rozpracováno</option>
                </select>
              </div>
              <div class="col-4 col-lg-2 mb-2">
                <label class="form-label">{{ __('Založil/upravil') }}</label>
                <input class="form-control" id="add_user_name" name="add_user_name" type="text" readonly>
              </div>
            </div>
            <div class="mb-2 mt-2">
              <div id="pdf-preview-add"></div>
            </div>
          </div>
          <input id="add_action" name="add_action" type="hidden" />
          <input id="add_hidden_id" name="add_hidden_id" type="hidden" />
          <input id="add_hidden_file" name="add_hidden_file" type="hidden" />
          <input id="add_folder_name" name="add_folder_name" type="hidden" />
          <input id="add_id" name="add_id" type="hidden">
          <input id="add_category_id" name="add_category_id" type="hidden">
          <input id="add_category_file" name="add_category_file" type="hidden" />
          <input id="add_user_id" name="add_user_id" type="hidden" />

          <div class="modal-footer">
            <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
              <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="16" height="16" rx="2">
                </rect>
                <path d="M10 10l4 4m0 -4l-4 4"></path>
              </svg>
              {{ __('Close') }}
            </button>
            <div class="align-content-end flex">
              <button class="btn btn-primary ms-auto hover-shadow" id="add_action_button" name="add_action_button" type="submit">
                <svg class="icon icon-tabler icon-tabler-book-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5"></path>
                  <path d="M11 16h-5a2 2 0 0 0 -2 2"></path>
                  <path d="M15 16l3 -3l3 3"></path>
                  <path d="M18 13v9"></path>
                </svg>
                Upravit dokument
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Document Show Modal --}}
  <div class="modal fade" id="showModal" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content shadow-lg">
        <div id="show-modal-header">
          <h5 class="modal-title"></h5>
          <div class="avatar avatar-transparent" id="show-modal-icon"></div>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div id="pdf-preview-show"></div>
              <input id="category_id" name="category_id" type="hidden">
              <input id="action" name="action" type="hidden" />
              <input id="hidden_id" name="hidden_id" type="hidden" />
              <input id="user_id" name="user_id" type="hidden" />
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
          <a class="btn btn-red ms-auto hover-shadow" id="download-btn" type="button" href="">
            <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 20h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5"></path>
              <path d="M13 16h-7a2 2 0 0 0 -2 2"></path>
              <path d="M15 19l3 3l3 -3"></path>
              <path d="M18 22v-9"></path>
            </svg>
            {{ __('Download file') }}</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Addon Show Modal --}}
  <div class="modal fade" id="addShowModal" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content shadow-lg">
        <div id="add-show-modal-header">
          <h5 class="modal-title"></h5>
          <div class="avatar avatar-transparent" id="add-show-modal-icon"></div>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div id="pdf-preview-addon-show"></div>
              <input id="category_id" name="category_id" type="hidden">
              <input id="action" name="action" type="hidden" />
              <input id="hidden_id" name="hidden_id" type="hidden" />
              <input id="user_id" name="user_id" type="hidden" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
            <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <rect x="4" y="4" width="16" height="16" rx="2">
              </rect>
              <path d="M10 10l4 4m0 -4l-4 4"></path>
            </svg>
            {{ __('Close') }}
          </button>
          <a class="btn btn-red ms-auto hover-shadow" id="add-download-btn" type="button" href="">
            <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 20h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5"></path>
              <path d="M13 16h-7a2 2 0 0 0 -2 2"></path>
              <path d="M15 19l3 3l3 -3"></path>
              <path d="M18 22v-9"></path>
            </svg>
            {{ __('Download file') }}</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Document Delete Modal --}}
  <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
        <div class="modal-status bg-danger"></div>
        <div class="modal-body py-4 text-center">
          <svg class="icon text-danger icon-lg mb-3" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>{{ __('Are you sure?') }}</h3>
          <div class="text-muted mb-3">
            {{ __('Do you really want to remove event?') }}<br>{{ __('This operation cannot be undone') }}
          </div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button class="btn btn-muted w-100 hover-shadow" data-bs-dismiss="modal">
                  {{ __('Cancel') }}
                </button>
              </div>
              <div class="col">
                <button class="btn btn-danger w-100 hover-shadow" id="ok_button"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Addon Delete Modal --}}
  <div class="modal fade" id="addConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
        <div class="modal-status bg-danger"></div>
        <div class="modal-body py-4 text-center">
          <svg class="icon text-danger icon-lg mb-3" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>{{ __('Are you sure?') }}</h3>
          <div class="text-muted mb-3">
            {{ __('Do you really want to remove addon event?') }}<br>{{ __('This operation cannot be undone') }}
          </div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button class="btn btn-muted w-100 hover-shadow" data-bs-dismiss="modal">
                  {{ __('Cancel') }}
                </button>
              </div>
              <div class="col">
                <button class="btn btn-danger w-100 hover-shadow" id="add_ok_button"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pdfobject.js') }}"></script>
  {{-- <script src="{{ asset('js/ViewerJS') }}"></script> --}}
  <script>
    $(document).ready(function() {
      function fill(Value) {
        $('#search').val(Value);
        $('#display').hide();
      }
    });
  </script>

  <script>
    // Form Modal Functions
    $(document).on('click', '.edit', function() {
      id = $(this).attr('id');
      $('#unique_code').prop('readonly', true);
      $('#form_result_modal, #form_result_window').html('');
      $.ajax({
        url: "/documents/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#inputForm')[0].reset();
          $('.modal-title').val('');
          $('#action_button, #pdf-preview-show, #pdf-preview, #pdf-preview-addon-show').removeClass('d-none');
          $('#formModal').modal('show');
          $('#modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt');
          $('#modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt");
          $('#action_button, .modal-title').text("{{ __('Edit') }} dokument")
          $('#action').val("Edit");
          $('#category_id').val(html.data.category_id);
          $('#folder_name').val(html.data.category.folder_name);
          $('#category_file').val(html.data.category.category_file);
          $('#name').val(html.data.name);
          $('#processed').val(html.data.processed);
          $('#authorize').val(html.data.authorize);
          $('#examine').val(html.data.examine);
          $('#efficiency').val(html.data.efficiency);
          $('#revision').val(html.data.revision);
          $('#revision_date').val(html.data.revision_date);
          $('#next_revision_date').val(moment($('#revision_date').val()).add(1, 'Y').format('YYYY-MM-DD'));
          $('#tags').val(html.data.tags);
          $('#unique_code').val(html.data.unique_code);
          $('#position').change(function() {
            $('#unique_code').val('{{ __('OSE') }}{{ $categorie->id }}#' + $('#position').val())
          })
          $('#description').val(html.data.description);
          $('#position').val(html.data.position);
          $('#attachment').val(html.data.attachment);
          $('#status').val(html.data.status);
          $('#onscreen').val(html.data.onscreen);
          $('#user_id').val('{{ auth()->user()->id ?? null }}');
          $('#user_name').val(html.data.user.name);
          $('#hidden_id').val(html.data.id);
          $('#hidden_file').val(html.data.file);
          $('#revision_date').change(function() {
            var revisionDate = moment($(this).val()).format('YYYY-MM-DD')
            var nextRevisionDate = moment(revisionDate).add(1, 'Y').format('YYYY-MM-DD')
            var efficiencyDate = moment(revisionDate).year(2014).format('YYYY-MM-DD')
            $('#efficiency').val(efficiencyDate)
            $('#next_revision_date').val(nextRevisionDate)
          })
          PDFObject.embed("../../soubory/" + html.data.file + "#toolbar=0", "#pdf-preview", {
            height: "30rem"
          })
        }
      })
    });

    $(document).on('click', '.add-edit', function() {
      id = $(this).attr('id');
      $('#add_form_result_modal, #form_result_window').html('');
      $.ajax({
        url: "/documents/addons/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#addInputForm')[0].reset();
          $('.modal-title').val('');
          $('#add_action_button, #add-pdf-preview').removeClass('d-none');
          $('#addFormModal').modal('show');
          $('#add-modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt');
          $('#add-modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt");
          $('#add_action_button, .modal-title').text("{{ __('Upravit přílohu') }}")
          $('#add_action').val("Edit");
          $('#add_category_id').val(html.data.category_id);
          $('#add_folder_name').val(html.data.category.folder_name);
          $('#add_category_file').val(html.data.category.category_file);
          $('#add_revision').val(html.data.revision);
          $('#add_description').val(html.data.description);
          $('#add_position').val(html.data.position);
          $('#add_status').val(html.data.status);
          $('#add_onscreen').val(html.data.onscreen);
          $('#add_user_id').val('{{ auth()->user()->id ?? null }}');
          $('#add_id').val(html.data.document_id);
          $('#add_user_name').val(html.data.user.name);
          $('#add_hidden_id').val(html.data.id);
          $('#add_hidden_file').val(html.data.file);
          PDFObject.embed("../../soubory/" + html.data.file + "#toolbar=0",
            "#pdf-preview-add", {
              height: "36rem"
            })
        }
      })
    });

    $(document).on('click', '.show', function() {
      id = $(this).attr('id');
      $('#form_result_modal, #form_result_window').html('');
      $.ajax({
        url: "/documents/" + id,
        dataType: "json",
        success: function(html) {
          $('#inputForm')[0].reset()
          $('.modal-title, #pdf-preview-show, #pdf-preview').val('')
          $('#pdf-preview-show, #pdf-preview, #pdf-preview-addon-show').removeClass('d-none')
          $('#showModal').modal('show')
          $('#show-modal-icon').html('{!! $categorie->svg_icon !!}').addClass(
            'bg-{{ $categorie->color }}-lt')
          $('#show-modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt")
          $('.modal-title').text(html.data.name + ' - ' + html.data.description)
          $('#category_id').val(html.data.category_id)
          $('#show-folder_name').val(html.data.category.folder_name)
          $('#show-name').val(html.data.name)
          $('#show-hidden_id').val(html.data.id)
          $('#download-btn').attr("href", "/soubory/" + html.data.category.category_type + "/" + html.data.id + "")
          val = html.data.file;
          file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
          if (file_type === '.pdf') {
            PDFObject.embed("../../soubory/" + html.data.file + "#toolbar=0",
              "#pdf-preview-show", {
                height: "41rem"
              })
          }
          if (file_type !== '.pdf') {
            $('#pdf-preview-show').html('Náhled souboru typu *' + file_type + ' nenelze zobrazit. Klikněte na stáhnout soubor.')
          }
          // if (file_type !== '.pdf') {
          //   var file_path = "../../soubory/" + html.data.file
          //   $("#pdf-preview-show").officeToHtml({
          //     url: file_path
          //   })
          // }
        }
      })
    });

    $(document).on('click', '.show-addon', function() {
      id = $(this).attr('id');
      $.ajax({
        url: "/documents/addons/" + id,
        dataType: "json",
        success: function(html) {
          $('#addInputForm')[0].reset()
          $('.modal-title').val('')
          $('#addShowModal').modal('show')
          $('#add-show-modal-icon').html('{!! $categorie->svg_icon !!}').addClass(
            'bg-{{ $categorie->color }}-lt')
          $('#add-show-modal-header').addClass(
            "modal-header bg-{{ $categorie->color }}-lt")
          $('.modal-title').html("Příloha - " + html.data.description)
          $('#add-show-description').val(html.data.description)
          $('#add-show-hidden_id').val(html.data.id)
          $('#add-download-btn').attr("href", "/soubory/{{ $categorie->category_type }}/priloha/" + html.data.id)
          val = html.data.file;
          file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
          if (file_type === '.pdf') {
            PDFObject.embed("../../soubory/" + html.data.file + "#toolbar=0",
              "#pdf-preview-addon-show", {
                height: "41rem"
              })
          }
          if (file_type !== '.pdf') {
            $('#pdf-preview-addon-show').html('Náhled souboru typu *' + file_type + ' nenelze zobrazit. Klikněte na stáhnout soubor.')
          }
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset()
      $("#attachment, #action_button").removeClass('d-none')
      $('#pdf-preview-show, #pdf-preview').addClass('d-none')
      $('#unique_code').prop('readonly', true)
      $('#category_id').val('{{ $categorie->id }}')
      $('#formModal').modal('show')
      $('#modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt')
      $('#modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt")
      $('#action_button, .modal-title').text("{{ __('Create new') }} {{ $categorie->button }} {{ $categorie->category_type }}")
      $('#action').val("Add")
      $('#position').change(function() {
        $('#unique_code').val('{{ $categorie->folder_name }}#' + $('#position').val())
      })
      $('#position').val('{{ $lastpos + 1 }}')
      $('#folder_name').val("{{ $categorie->folder_name }}")
      $('#status').val('Schváleno')
      $('#user_id').val('{{ auth()->user()->id ?? null }}')
      $('#user_name').val('{{ auth()->user()->name ?? 'Guest' }}')
      $('#unique_code').val('{{ $categorie->folder_name }}#{{ $lastpos + 1 }}')
      $('#revision').val('{{ $lastpos - $lastpos + 1 }}')
      $('#category_file').val('{{ $categorie->category_file }}')
      $('#processed').val('Neuvedeno')
      $('#authorize').val('Neuvedeno')
      $('#examine').val('Neuvedeno')
      $('#revision_date').change(function() {
        var revisionDate = moment($(this).val()).format('YYYY-MM-DD')
        var nextRevisionDate = moment(revisionDate).add(1, 'Y').format('YYYY-MM-DD')
        $('#efficiency').val($('#revision_date').val())
        $('#next_revision_date').val(nextRevisionDate)
      })
    })

    $('#inputForm').on('submit', function(event) {
      event.preventDefault(event);
      if ($('#action').val() === 'Add') {
        $.ajax({
          url: "{{ route('documents.store') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function(data) {
            var html = '';
            if (data.errors) {
              html = '<div class="alert alert-danger text-danger shadow-sm"><ul> ';
              for (var count = 0; count < data.errors.length; count++) {
                html += '<li>' + data.errors[count] + '</li>';
              }
              html +=
                '</ul><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
              $('#form_result_modal').html(html);
            }
            if (data.success) {
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' +
                data.success +
                '</li></ul></div>';
              $('#formModal').modal('hide')
              $('#inputForm')[0].reset();
              location.reload()
              $('#form_result_window').html(html);
            }
          }
        })
      }

      if ($('#action').val() === "Edit") {
        event.preventDefault();
        $.ajax({
          url: "{{ route('documents.update') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function(data) {
            var html = '';
            if (data.errors) {
              html = '<div class="alert alert-danger text-danger shadow-sm"><ul>';
              for (var count = 0; count < data.errors.length; count++) {
                html += '<li>' + data.errors[count] + '</li>';
              }
              html += '</ul></div>';
              $('#form_result_modal').html(html);
            }
            if (data.success) {
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' +
                data.success + '</li></ul></div>';
              $('#form_result_window').html(html);
              location.reload();
              $('#formModal').modal('hide');
            }
          }
        });
      }
    })

    $('.addon').click(function() {
      addonId = $(this).attr('id')
      $('#addInputForm')[0].reset();
      $("#add_action_button").removeClass('d-none')
      $('#add-pdf-preview-show, #add-pdf-preview').addClass('d-none')
      $('#add_category_id').val('{{ $categorie->id }}')
      $('#addFormModal').modal('show')
      $('#add-modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt')
      $('#add-modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt")
      $('#add_action_button, .modal-title').text("{{ __('Create new addon') }}")
      $('#add_action').val("Add")
      $('#add_position').val('')
      $('#add_folder_name').val("{{ $categorie->folder_name }}")
      $('#add_status').val('Schváleno')
      $('#add_user_id').val('{{ auth()->user()->id ?? null }}')
      $('#add_user_name').val('{{ auth()->user()->name ?? 'Guest' }}')
      $('#add_revision').val('')
      $('#add_id').val(addonId ?? null)
      $('#add_category_file').val('{{ $categorie->category_file }}')
    })

    $('#addInputForm').on('submit', function(event) {
      event.preventDefault();
      if ($('#add_action').val() === 'Add') {
        $.ajax({
          url: "{{ route('addons.store') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function(data) {
            var html = '';
            if (data.errors) {
              html = '<div class="alert alert-danger text-danger shadow-sm"><ul> ';
              for (var count = 0; count < data.errors.length; count++) {
                html += '<li>' + data.errors[count] + '</li>';
              }
              html +=
                '</ul><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
              $('#add_form_result_modal').html(html);
            }
            if (data.success) {
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' +
                data.success +
                '</li></ul></div>';
              $('#addFormModal').modal('hide')
              $('#addInputForm')[0].reset();
              location.reload()
              $('#add_form_result_window').html(html);
            }
          }
        })
      }

      if ($('#add_action').val() === "Edit") {
        event.preventDefault();
        $.ajax({
          url: "{{ route('addons.update') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function(data) {
            var html = '';
            if (data.errors) {
              html = '<div class="alert alert-danger text-danger shadow-sm"><ul>';
              for (var count = 0; count < data.errors.length; count++) {
                html += '<li>' + data.errors[count] + '</li>';
              }
              html += '</ul></div>';
              $('#add_form_result_modal').html(html);
            }
            if (data.success) {
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' +
                data.success + '</li></ul></div>';
              $('#add_form_result_window').html(html);
              location.reload();
              $('#addFormModal').modal('hide');
            }
          }
        });
      }
    })

    // Delete document and delete confirm modal
    $(document).on('click', '.delete', function() {
      id = $(this).attr('id')
      $('#ok_button').text("{{ __('Delete') }}")
      $('#confirmModal').modal('show')
      $('#ok_button').click(function() {
        $.ajax({
          url: "/documents/destroy/" + id,
          beforeSend: function() {
            $('#ok_button').text("{{ __('Deleting ...') }}")
          },
          success: function(data) {
            setTimeout(function() {
              $('#confirmModal').modal('hide');
              $('#ok_button').text("{{ __('Delete') }}")
              location.reload();
            }, 1000);
          }
        })
      })
    })

    // Delete addon and delete confirm modal
    $(document).on('click', '.add-delete', function() {
      id = $(this).attr('id')
      $('#add_ok_button').text("{{ __('Delete') }}")
      $('#addConfirmModal').modal('show')
      $('#add_ok_button').click(function() {
        $.ajax({
          url: "/documents/addons/destroy/" + id,
          beforeSend: function() {
            $('#add_ok_button').text("{{ __('Deleting ...') }}")
          },
          success: function(data) {
            setTimeout(function() {
              $('#addConfirmModal').modal('hide');
              $('#add_ok_button').text("{{ __('Delete') }}")
              location.reload();
            }, 1000);
          }
        })
      })
    })
  </script>
@endsection
