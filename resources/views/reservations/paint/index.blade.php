@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/paint.png') }}" rel="shortcut icon">
@endsection

@section('buttons')
  <div class="btn-list">
    <button class="btn btn-success d-none d-sm-inline-block" id="openCreateModal" data-bs-toggle="tooltip"
      data-bs-placement="bottom" data-bs-original-title="{{ __('Create new paint reservation') }}">
      <svg class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
        <path d="M16 3l0 4"></path>
        <path d="M8 3l0 4"></path>
        <path d="M4 11l16 0"></path>
        <path d="M8 15h2v2h-2z"></path>
      </svg>
      {{ __('Nová rezervace') }}
    </button>
  </div>
@endsection

@section('content')
  <div class="container-fluid">

    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-fluid">
        <div class="row align-items-center mt-2">
          <!-- Page pre-title -->
          <div class="col">
            <div class="page-pretitle text-primary">
              {{ __('Rezervace') }}
            </div>
            <h2 class="page-title text-primary">
              {{ __('Malování') }}
            </h2>
          </div>
        </div>
        <div class="row align-items-center mt-2">
          <div class="col">
            <span id="form_result_window"></span>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card mb-2 shadow-sm">
          <div class="card-body p-2">
            <table class="table-bordered table-hover dataTable w-100 table">
              <thead>
                <tr class="bg-azure-lt table bg-opacity-50 text-center text-white">
                  <th>{{ __('Department') }}</th>
                  <th>{{ __('Odpovědná osoba') }}</th>
                  <th>{{ __('Od') }}</th>
                  <th>{{ __('do') }}</th>
                  <th>{{ __('Místnosti') }}</th>
                  {{-- <th>{{ __('Zvláštní požadavky') }}</th> --}}
                  <th>{{ __('Vytvořeno') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th class="text-center"><i class="fas fa-bars"></i></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modals')
  {{-- Main Form Modal --}}
  <div class="modal modal-blur fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        <div id="modal-header">
          <h5 class="modal-title"></h5>
          <i id="modal-icon"></i>
        </div>
        <form id="inputForm" action="{{ route('paints.create') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6 mb-sm-1">
                <label class="form-label">{{ __('Department') }}</label>
                <select class="form-select" id="department_id" name="department_id">
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>
                      {{ $department->department_code }} -
                      {{ $department->department_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-6 col-lg-3 mb-sm-1">
                <label class="form-label">{{ __('Od') }}</label>
                <input class="form-control" id="date_start" name="date_start" type="date"
                  value="{{ date('Y-m-d') ?? old('date_start') }}" placeholder="{{ __('Od') }}"
                  onkeydown="return false">
              </div>
              <div class="col-6 col-lg-3 mb-sm-1">
                <label class="form-label">{{ __('Do') }}</label>
                <input class="form-control" id="date_end" name="date_end" type="date"
                  value="{{ old('date_end') ?? '' }}" placeholder="{{ __('Do') }}" onkeydown="return false">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-sm-1">
                <label class="form-label">{{ __('Místnosti') }} <small class="text-azure">( Vypište čísla jednotlivých
                    místností, které chcete vymalovat. V případe malování celého
                    oddělení zadejte "celé oddělení" )</small></label>
                <input class="form-control" id="rooms" name="rooms" type="text" value="{{ old('rooms') }}"
                  placeholder="{{ __('Místnosti') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-sm-1">
                <label class="form-label">{{ __('Zvláštní požadavky') }} <small class="text-azure">( Vypište v případě
                    malování speciálních věcí jako jsou zárubně, žebřiny, apod.
                    )</small></label>
                <input class="form-control" id="specials" name="specials" type="text"
                  value="{{ old('special') }}" placeholder="{{ __('Zvláštní požadavky') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-sm-1">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="status" name="status">
                  <option value="Vloženo">Vloženo</option>
                  <option value="Schváleno">Schváleno</option>
                </select>
              </div>
            </div>
          </div>
          <input id="action" name="action" type="hidden" />
          <input id="hidden_id" name="hidden_id" type="hidden" />
          <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}" />
          <div class="modal-footer">
            <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
              {{ __('Close') }}
            </button>
            <button class="btn btn-primary ms-auto hover-shadow" id="action_button" name="action_button"
              type="submit"></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Delete Event Modal --}}
  <div class="modal modal-blur fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
        <div class="modal-status bg-danger"></div>
        <div class="modal-body py-4 text-center">
          <svg class="icon text-danger icon-lg mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>{{ __('Are you sure?') }}</h3>
          <div class="text-muted">
            {{ __('Do you really want to remove reservation?') }}<br>{{ __('This operation cannot be undone') }}
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
  <script>
    // Data Table
    $(document).ready(function() {
      $('.dataTable').DataTable({
        filter: true,
        processing: true,
        processingAnim: false,
        serverSide: true,
        stateSave: true,
        pageSave: true,
        fixedHeader: {
          header: false,
          footer: false
        },
        order: [
          [2, "asc"]
        ],
        lengthMenu: [
          [10, 20, 30, 60, 100, -1],
          [10, 20, 30, 60, 100, "Všechny"]
        ],
        language: {
          "url": "{{ asset('js/cs.json') }}",
          "sProcessing": "<img style='height:100px;' src='../img/processing.gif' />",
          "search": "_INPUT_",
          "searchPlaceholder": "Hledej ..."
        },
        ajax: {
          url: "{{ route('paints.index') }}",
        },
        columnDefs: [{
          type: 'czech',
          targets: [1]
        }],
        columns: [{
            data: 'department.department_name',
            "width": "1%",
          },
          {
            data: 'user.name',
            "width": "1%"
          },
          {
            data: 'date_start',
            "width": "1%",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('D. M. YYYY');
            }
          },
          {
            data: 'date_end',
            "width": "1%",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('D. M. YYYY');
            }
          },
          {
            data: 'rooms',
            "width": "6%"
          },
          {
            data: 'created_at',
            "width": "2%",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('D. M. Y');
            }
          },
          {
            data: 'status',
            "width": "0.5%",
            render: function(data, type, full, meta) {
              if (data == 'Vloženo') {
                return "<span title='{{ __('Vloženo') }}' class='cursor-help mx-3 badge bg-orange p-1 me-1'></span>";
              }
              if (data == 'Schváleno') {
                return "<span title='{{ __('Schváleno') }}' class='cursor-help mx-3 badge bg-green p-1 me-1'></span>";
              }
            }
          },
          {
            data: 'action',
            "width": "0.5%",
            orderable: false,
            searchable: false
          },
        ],
      });
    });

    // Form Modal Functions
    $(document).on('click', '.edit', function() {
      var id = $(this).attr('id');
      $('#form_result_modal, form_result_window').html('');
      $.ajax({
        url: "/paints/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#inputForm')[0].reset();
          $("#modal-header, #modal-icon").removeClass();
          $('#form_result_modal').html('');
          $('#formModal').modal('show');
          $('#modal-icon').addClass('fas fa-paint-roller fa-2x m-2');
          $('#modal-header').addClass("modal-header bg-yellow-lt");
          $('#action_button, .modal-title').text("{{ __('Edit paint reservation') }}");
          $('#action').val("Edit");
          $('#department_code').val(html.data.department.department_code);
          $('#department_id').val(html.data.department_id);
          $('#status').val(html.data.status);
          $('#date_start').val(html.data.date_start);
          $('#date_end').val(html.data.date_end);
          $('#created_at').val(html.data.created_at);
          $('#updated_at').val(html.data.updated_at);
          $('#rooms').val(html.data.rooms);
          $('#specials').val(html.data.specials);
          $('#hidden_id').val(html.data.id);
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset();
      $("#modal-icon, #modal-header").removeClass();
      $('#department_id, #department_code').val('');
      $('#form_result_modal').html('');
      $('#formModal').modal('show');
      $('#modal-icon').addClass('fas fa-paint-roller fa-2x m-2');
      $('#modal-header').addClass("modal-header bg-lime-lt");
      $('#action_button, .modal-title').text("{{ __('New paint reservation') }}");
      $('#action').val("Add");
      $('#status').val('Vloženo');
    })

    $('#inputForm').on('submit', function(event) {
      event.preventDefault();
      if ($('#action').val() == 'Add') {
        $.ajax({
          url: "{{ route('paints.store') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          beforeSend: function() {
            html =
              '<div class="alert alert-info text-info shadow-sm"><ul><li>Ukládám rezervaci a odesílám email, čekejte...</li></ul></div>';
            $('#form_result_modal').html(html);
          },
          success: function(data) {
            var html = '';
            if (data.errors) {
              html = '<div class="alert alert-danger text-danger shadow-sm"><ul>';
              for (var count = 0; count < data.errors.length; count++) {
                html += '<li>' + data.errors[count] + '</li>';
              }
              html +=
                '</ul><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
              $('#form_result_modal').html(html);
            }
            if (data.success) {
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' + data.success +
                '</li></ul></div>';
              $('#formModal').modal('hide')
              $('#inputForm')[0].reset();
              $('.dataTable').DataTable().ajax.reload(null, false);
              $('#form_result_window').html(html);
            }
          }
        })
      }

      if ($('#action').val() == "Edit") {
        event.preventDefault();
        $.ajax({
          url: "{{ route('paint.update') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          beforeSend: function() {
            html =
              '<div class="alert alert-info text-info shadow-sm"><ul><li>Ukládám změny a odesílám email, čekejte...</li></ul></div>';
            $('#form_result_modal').html(html);
          },
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
              $('.dataTable').DataTable().ajax.reload(null, false);
              $('#form_result_window').html(html);
              $('#formModal').modal('hide');
            }
          }
        });
      }
    });

    // Delete Paint
    $(document).on('click', '.delete', function() {
      id = $(this).attr('id');
      $('#ok_button').text("{{ __('Delete') }}");
      $('#confirmModal').modal('show');
    })

    $('#ok_button').click(function() {
      $.ajax({
        url: "paints/destroy/" + id,
        beforeSend: function() {
          $('#ok_button').text("{{ __('Deleting ...') }}");
        },
        success: function(data) {
          setTimeout(function() {
            $('#confirmModal').modal('hide');
            $('#ok_button').text("{{ __('Delete') }}");
            $('.dataTable').DataTable().ajax.reload(null, false);
          }, 1000);
        }
      })
    })
  </script>
@endsection
