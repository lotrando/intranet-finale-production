@php
  $i = $documents->count();
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
          @foreach ($porady as $category)
            <div class="col-3">
              <a class="btn bg-{{ $category->color }}-lt hover-shadow-sm w-100" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="{{ __('' . $category->category_name . '') }}"
                href="/{{ $category->category_file }}/{{ $category->folder_name . '/' . $category->id }}">
                <span class="d-inline d-sm-inline d-md-inline d-lg-inline d-xl-inline pe-0">{!! $category->svg_icon !!}</span>
                <span class="d-none d-md-inline d-lg-inline d-xl-inline pe-0">{{ $category->category_name }}</span>
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
                <div class="card my-2 bg-white shadow-sm">
                  <div id="test-{{ $document->id }}">
                    <div class="card-body p-0">
                      <div class="list-group list-group-flush list-group-hoverable py-0">
                        <div class="list-group-item border-0 p-0">
                          <div class="row align-items-center m-1">
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
                                <p class="show d-inline text-primary text-decoration-none cursor-pointer" id="{{ $document->id }}" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-original-title="Více informací o dokumentu {{ $document->description }}"
                                  style="margin-bottom: 0;">
                                  {{ $i-- }}. {{ $document->name }}
                                </p>
                              </span>
                              <div class="d-block description text-muted text-truncate">
                                {{ $document->description }} - vloženo {{ Carbon\Carbon::parse($document->created_at)->diffForHumans() }}</span>
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
                                    {{ __('Upravit zápis z porady') }}
                                  </li>
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
                                    {{ __('Odstranit zápis z porady') }}
                                  </li>
                                </ul>
                              </div>
                            @endauth
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{-- Documents end --}}

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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
            <div class="row mb-2">
              <div class="col-12">
                <label class="form-label">{{ __('Name') }} <small class="text-azure">usnadní vyhledávání</small></label>
                <input class="form-control" id="name" name="name" type="text" placeholder="{{ __('Jméno dokumentu') }}">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-12">
                <label class="form-label">{{ __('Popis') }} <small class="text-azure">usnadní vyhledávání</small></label>
                <input class="form-control" id="description" name="description" type="text" placeholder="{{ __('Popis dokumentu') }}">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-4 col-lg-8">
                <label class="form-label">{{ __('Oblast působnosti addonu') }} <small class="text-azure">usnadní vyhledávání</small></label>
                <input class="form-control" id="tags" name="tags" type="text" placeholder="{{ __('Zkratky oddělené čárkou (INT-ODD,...)') }}">
              </div>
              <div class="col-4 col-lg-4">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="status" name="status">
                  <option value="Schváleno">Schváleno</option>
                  <option value="Rozpracováno">Rozpracováno</option>
                </select>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-12 col-lg-8">
                <label class="form-label">{{ __('Soubor') }}</label>
                <input class="form-control" id="file" name="file" type="file" placeholder="{{ __('Soubor standardu ve formátu PDF') }}">
              </div>
              <div class="col-12 col-lg-4">
                <label class="form-label">{{ __('Založil / upravil') }}</label>
                <input class="form-control" id="user_name" name="user_name" type="text" readonly>
              </div>
            </div>
          </div>
          <input id="unique_code" name="unique_code" type="hidden">
          <input id="position" name="position" type="hidden">
          <input id="revision" name="revision" type="hidden">
          <input id="category_id" name="category_id" type="hidden">
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
                {{ __('Edit') }}
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
            {{ __('Do you really want to remove porada event?') }}<br>{{ __('This operation cannot be undone') }}
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
@endsection

@section('scripts')
  <script src="{{ asset('js/pdfobject.js') }}"></script>
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
          $('#action_button, #pdf-preview-show').removeClass('d-none');
          $('#formModal').modal('show');
          $('#modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt');
          $('#modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt");
          $('#action_button, .modal-title').text("{{ __('Edit') }}")
          $('#action').val("Edit");
          $('#category_id').val(html.data.category_id);
          $('#folder_name').val(html.data.category.folder_name);
          $('#category_file').val(html.data.category.category_file);
          $('#name').val(html.data.name);
          $('#tags').val(html.data.tags);
          $('#unique_code').val(html.data.unique_code);
          $('#position').change(function() {
            $('#unique_code').val('{{ __('OSE') }}{{ $categorie->id }}#' + $('#position').val())
          })
          $('#description').val(html.data.description);
          $('#position').val(html.data.position);
          $('#status').val(html.data.status);
          $('#revision').val(html.data.revision);
          $('#user_id').val('{{ auth()->user()->id ?? null }}');
          $('#user_name').val(html.data.user.name);
          $('#hidden_id').val(html.data.id);
          $('#hidden_file').val(html.data.file);
          PDFObject.embed("../../soubory/" + html.data.file + "#toolbar=0", "#pdf-preview", {
            height: "30rem"
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
          $('.modal-title, #pdf-preview-show').val('')
          $('#pdf-preview-show').removeClass('d-none')
          $('#showModal').modal('show')
          $('#show-modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt')
          $('#show-modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt")
          $('.modal-title').text(html.data.name + ' ' + html.data.description)
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
                height: "45rem"
              })
          }
          if (file_type !== '.pdf') {
            $('#pdf-preview-show').html('Náhled souboru typu *' + file_type + ' nenelze zobrazit. Klikněte na stáhnout soubor.')
          }
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset()
      $("#attachment, #action_button").removeClass('d-none')
      $('#pdf-preview-show').addClass('d-none')
      $('#unique_code').prop('readonly', true)
      $('#category_id').val('{{ $categorie->id }}')
      $('#formModal').modal('show')
      $('#modal-icon').html('{!! $categorie->svg_icon !!}').addClass('bg-{{ $categorie->color }}-lt')
      $('#modal-header').addClass("modal-header bg-{{ $categorie->color }}-lt")
      $('#action_button, .modal-title').text("{{ __('Create new') }} zápis z porady")
      $('#action').val("Add")
      $('#position').change(function() {
        $('#unique_code').val('{{ $categorie->folder_name }}#' + $('#position').val())
      })
      $('#position').val('{{ $lastpos + 1 }}')
      $('#folder_name').val("{{ $categorie->folder_name }}")
      $('#revision').val('1')
      $('#status').val('Schváleno')
      $('#user_id').val('{{ auth()->user()->id ?? null }}')
      $('#user_name').val('{{ auth()->user()->name ?? 'Guest' }}')
      $('#unique_code').val('{{ $categorie->folder_name }}#{{ $lastpos + 1 }}')
      $('#category_file').val('{{ $categorie->category_file }}')
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
  </script>
@endsection
