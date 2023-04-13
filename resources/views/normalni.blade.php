@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="./img/home.png" rel="shortcut icon">
@endsection

@section('content')
  {{-- Page wrapper --}}
  <div class="page-wrapper">

    {{-- Page header --}}
    <div class="page-header d-print-none">
      <div class="container-fluid mt-2">
        <div class="row">
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
                <input class="form-control" id="search" type="text" style="width:100%" placeholder="{{ __('v dokumentech ...') }}">
              </div>
            </form>
          </div>
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
                <input class="form-control" id="search-employee" type="text" style="width:100%" placeholder="{{ __('v zaměstnancích ...') }}">
              </div>
            </form>
          </div>
        </div>

        <div class="row align-items-center">

          {{-- Searched events --}}
          <div>
            <div class="display mt-2 mb-3" id="display"></div>
          </div>

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

          <!-- Page title actions buttons -->
          <div class="ms-auto d-print-none col-auto">
            <div class="btn-list">
              <div class="d-flex justify-content-end">

                @auth
                  <button class="btn btn-lime d-inline-block me-2" id="openCreateModal" data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-original-title="{{ __('Vytvoří nové oznámení') }}">
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
                    <span class="d-xs-none d-sm-inline d-md-inline d-lg-inline">{{ __('Nové oznámení') }}</span>
                  </button>
                @endauth
              </div>
            </div>
          </div>
          <!-- Page Title Buttons End -->
        </div>

      </div>
    </div>
  </div>

  {{-- Page body --}}
  <div class="page-body">
    <div class="container-fluid">

      <div class="row g-2 m-1">
        <div class="col-12 col-lg-12">
          @foreach ($notifications as $notification)
            <div class="card mb-2 shadow-sm">
              <div class="bg-{{ $notification->importance }}-lt text-left">
                <div class="card-body p-2">
                  <div class="d-flex align-items-top justify-content-start">
                    <div class="avatar bg-transparent">
                      <span
                        class="avatar bg-{{ $notification->importance ?? 'muted' }}-lt pt-1"><strong>{{ Carbon\Carbon::parse($notification->created_at)->format('d|m') }}<br>{{ Carbon\Carbon::parse($notification->created_at)->format('Y') }}</strong></span>
                    </div>
                    <div class="avatar mx-1 bg-transparent">
                      <a href="{{ route($notification->type->type_route) }}">
                        <span class="avatar bg-{{ $notification->type->type_color ?? 'muted' }}-lt">
                          {!! $notification->type->svg_icon !!}
                        </span>
                      </a>
                    </div>
                    <div class="text-{{ $notification->type->type_color ?? 'muted' }} px-3">
                      <h2>{{ $notification->title }}</h2>
                      <p class="d-block description text-muted text-truncate">
                        Typ: <a class="text-{{ $notification->type->type_color }}"
                          href="{{ route($notification->type->type_route) }}">{{ $notification->type->type_name }}</a>
                        - vložil: {{ $notification->user->name }}
                        ve {{ Carbon\Carbon::parse($notification->created_at)->format('H:i') }}
                      </p>
                      <div class="text-muted mb-1">
                        {!! $notification->content !!}
                      </div>
                    </div>
                  </div>
                  @auth
                    @if (Auth::user()->id == $notification->user_id or Auth::user()->role == 'admin')
                      <div class="d-flex align-items-top justify-content-end col-auto">
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
                          <li class="dropdown-item edit" id="{{ $notification->id }}">
                            <svg class="icon dropdown-item-icon-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                              fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                              <path d="M16 5l3 3" />
                            </svg>
                            {{ __('Upravit oznámení') }}
                          </li>
                          <li class="dropdown-item delete" id="{{ $notification->id }}" disabled>
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
                            {{ __('Odstranit oznámení') }}
                          </li>
                        </ul>
                      </div>
                    @endif
                  @endauth
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    {{-- End Page body --}}
  </div>
  <!-- Wrapper End -->
@endsection

@section('modals')
  {{-- Main Form Modal --}}
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-full-width mx-3" role="document">
      <div class="modal-content shadow-lg">
        <div id="modal-header">
          <h5 class="modal-title"></h5>
          <div class="avatar avatar-transparent" id="modal-icon"></div>
        </div>
        <form id="inputForm" action="{{ route('notifications.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-2">
                <label class="form-label">{{ __('Title') }}</label>
                <input class="form-control" id="title" name="title" type="text" placeholder="{{ __('Název oznámení') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-3 mb-2">
                <label class="form-label">{{ __('Typ oznámení') }}</label>
                <select class="form-select" id="type_id" name="type_id">
                  @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label class="form-label">{{ __('Důležitost') }}</label>
                <select class="form-select" id="importance" name="importance">
                  <option value="red">Vysoká</option>
                  <option value="blue">Střední</option>
                  <option value="white">Normální</option>
                </select>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="status" name="status">
                  <option value="Nezobrazeno">Nezobrazeno</option>
                  <option value="Zobrazeno">Zobrazeno</option>
                </select>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label class="form-label">{{ __('Založil / upravil') }}</label>
                <input class="form-control" id="user_name" name="user_name" type="text" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12">
                <div class="form-group">
                  <label class="form-label">{{ __('Content') }}</label>
                  <textarea class="summernote form-control" id="content" name="content"></textarea>
                </div>
              </div>
            </div>
          </div>
          <input id="action" name="action" type="hidden" />
          <input id="hidden_id" name="hidden_id" type="hidden" />
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
                Upravit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Notification Delete Modal --}}
  <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
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
@endsection

@section('scripts')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.summernote').summernote({
        placeholder: 'Text oznámení',
        tabsize: 2,
        height: 350
      })
    });
  </script>
  <script>
    $(document).ready(function() {

      function fill(Value) {
        $('#search').val(Value);
        $('#display').hide();
      }

    });

    $(document).ready(function() {
      $("#search").keyup(function() {
        var name = $('#search').val();
        if (name === "") {
          $("#display").html("");
        } else {
          $.ajax({
            type: "GET",
            url: "{{ route('dokument.search') }}",
            data: {
              search: name
            },
            success: function(html) {
              $("#display").html(html).show();
            }
          });
        }
      });
      $("#search-employee").keyup(function() {
        var name = $('#search-employee').val();
        if (name === "") {
          $("#display").html("");
        } else {
          $.ajax({
            type: "GET",
            url: "{{ route('employees.search') }}",
            data: {
              search: name
            },
            success: function(html) {
              $("#display").html(html).show();
            }
          });
        }
        content
      });
    });
  </script>

  <script>
    // Form Modal Functions
    $(document).on('click', '.edit', function() {
      id = $(this).attr('id');
      content
      $.ajax({
        url: "/notifications/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#inputForm')[0].reset();
          $('#attachment, #action_button').removeClass('d-none');
          $('#formModal').modal('show');
          $('#modal-header', '#modal-icon').removeClass()
          $('#modal-icon').html('').addClass("bg-" + html.data.type + "-lt");
          $('#modal-header').addClass("modal-header bg-" + html.data.type.type_color + "-lt");
          $('.modal-title').text("{{ __('Edit') }} oznámení - " + html.data.title)
          $('#action_button').text("{{ __('Edit') }} oznámení")
          $('#action').val("Edit");
          $('#title').val(html.data.title);
          $('#content').summernote('code', html.data.content)
          $('#type_id').val(html.data.type_id);
          $('#importance').val(html.data.importance);
          $('#status').val(html.data.status);
          $('#hidden_id').val(html.data.id);
          $('#user_id').val(html.data.user_id);
          $('#user_name').val(html.data.user.name);
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset();
      $("#action_button").removeClass('d-none')
      $('#formModal').modal('show')
      $('#content').summernote('code', '')
      $('#modal-icon').html('{!! $typ[0]['svg_icon'] !!}').addClass('bg-{{ $typ[0]['type_color'] }}-lt')
      $('#modal-header').addClass("modal-header bg-{{ $typ[0]['type_color'] }}-lt")
      $('#action_button, .modal-title').text("{{ __('Create new') }}")
      $('#action').val("Add")
      $('#status').val('Nezobrazeno')
      $('#type_id').val(7)
      $('#importance').val('white')
      $('#user_id').val('{{ auth()->user()->id ?? null }}')
      $('#user_name').val('{{ auth()->user()->name ?? 'Guest' }}')
    })

    $('#inputForm').on('submit', function(event) {
      event.preventDefault();
      if ($('#action').val() === 'Add') {
        $.ajax({
          url: "{{ route('notifications.store') }}",
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
          url: "{{ route('notification.update') }}",
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
          url: "/notifications/destroy/" + id,
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
