@extends('layouts.datatable')

@section('main')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card mb-2 mt-2 shadow-sm">
          <div class="card-header align-items-center justify-content-between bg-muted-lt d-flex">
            <h1 class="text-muted mb-0"><i class="fas fa-printer fa-fill-drip mx-1"></i> {{ __('Evidences of KHN') }}</h1>
            <div>
              <button class="btn btn-lime p-2" id="openCreateModal" title="Nový">
                <i class="fas fa-printer fa-fill-drip fa-1x m-1"></i>{{ __('New') }}
              </button>
            </div>
          </div>
          <div class="card-body p-2">
            <div class="row">
              <div class="col-12">
                <span class="" id="form_result_window"></span>
              </div>
            </div>
            <table class="table-bordered table-hover dataTable w-100 table">
              <thead>
                <tr class="bg-purple-lt table bg-opacity-50 text-center text-white">
                  <th>{{ __('Type') }}</th>
                  <th>{{ __('Department') }}</th>
                  <th>{{ __('Pieces') }}</th>
                  <th>{{ __('Expedition') }}</th>
                  <th>{{ __('User') }}</th>
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
  <div class="modal modal-blur fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-top" role="document">
      <div class="modal-content shadow-lg">
        <div id="modal-header">
          <h5 class="modal-title"></h5>
          <i id="modal-icon"></i>
          {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button> --}}
        </div>
        <form id="inputForm" action="{{ route('employees.create') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-4">
                <label class="form-label">{{ __('Type') }}</label>
                <select class="form-select" id="evidence_type" name="evidence_type">
                  <option value=""></option>
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>{{ $department->center_code }} -
                      {{ $department->department_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-4">
                <label class="form-label">{{ __('Department') }}</label>
                <select class="form-select" id="department_id" name="department_id">
                  <option value=""></option>
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>{{ $department->center_code }} -
                      {{ $department->department_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-2">
                <label class="form-label">{{ __('Start date') }}</label>
                <input class="form-control" id="start_date" name="start_date" type="date" placeholder="{{ __('Start date') }}">
              </div>
              <input id="action" name="action" type="hidden" />
              <input id="hidden_id" name="hidden_id" type="hidden" />
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
              {{ __('Close') }}
            </button>
            <button class="btn btn-primary ms-auto hover-shadow" id="action_button" name="action_button" type="submit"></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Delete Employee Modal --}}
  <div class="modal modal-blur fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
        <div class="modal-status bg-danger"></div>
        <div class="modal-body py-4 text-center">
          <svg class="icon text-danger icon-lg mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>{{ __('Are you sure?') }}</h3>
          <div class="text-muted">{{ __('Do you really want to remove employee?') }}<br>{{ __('This operation cannot be undone') }}
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
        processing: true,
        processingAnim: false,
        serverSide: true,
        stateSave: true,
        pageSave: true,
        fixedHeader: {
          header: true,
          footer: false
        },
        order: [
          [3, "asc"]
        ],
        "lengthMenu": [
          [10, 20, 30, 60, 100, -1],
          [10, 20, 30, 60, 100, "Všechny"]
        ],
        language: {
          "url": "{{ asset('js/cs.json') }}",
          "sProcessing": "<img style='height:100px;' src='img/processing.gif' />",
          "search": "_INPUT_",
          "searchPlaceholder": "Hledej ..."
        },
        ajax: {
          url: "{{ route('evidences.index') }}",
        },
        columnDefs: [{
          type: 'czech',
          targets: [2]
        }],
        columns: [{
            data: 'evidence_type',
            "width": "1%"
          },
          {
            data: 'department_id',
            "width": "3%"
          },
          {
            data: 'pieces',
            "width": "3%",
          },
          {
            data: 'user_id',
            "width": "3%"
          },
          {
            data: 'start_date',
            "width": "1%",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('DD. MM. YYYY');
            }
          },
          {
            data: 'action',
            "width": "1%",
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
        url: "/evidences/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $("#modal-header, #modal-icon").removeClass();
          $('#formModal').modal('show');
          $('#modal-icon').addClass('fas fa-fill-drip fa-2x m-2');
          $('#action_button, .modal-title').text("{{ __('Edit evidence') }}");
          $('#action').val("Edit");
          $('#department_id').val(html.data.department_id);
          $('#start_date').val(html.data.start_date);
          $('#created_at').val(html.data.created_at);
          $('#updated_at').val(html.data.updated_at);
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset();
      $("#modal-icon, #modal-header").removeClass();
      $('#formModal').modal('show');
      $('#modal-icon').addClass('fas fa-user-plus fa-2x m-2');
      $('#modal-header').addClass("modal-header bg-muted-lt");
      $('#action_button, .modal-title').text("{{ __('Create new evidence') }}");
      $('#action').val("Add");
    })

    $('#inputForm').on('submit', function(event) {
      event.preventDefault();
      if ($('#action').val() == 'Add') {
        $.ajax({
          url: "{{ route('employees.store') }}",
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
              html += '</ul><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
              $('#form_result_modal').html(html);
            }
            if (data.success) {
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' + data.success +
                '</li></ul><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
              $('#inputForm')[0].reset();
              $("#preview_image").attr("src", "{{ URL::to('/') }}/foto/no_image.png");
              $('.dataTable').DataTable().ajax.reload(null, false);
              $('#form_result_modal').html(html);
            }
          }
        })
      }

      if ($('#action').val() == "Edit") {
        event.preventDefault();
        $.ajax({
          url: "{{ route('employees.update') }}",
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
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' + data.success + '</li></ul></div>';
              $('.dataTable').DataTable().ajax.reload(null, false);
              $('#form_result_window').html(html);
              $('#formModal').modal('hide');
            }
          }
        });
      };

    });

    // Preview Image
    $(document).ready(() => {
      $("#image").change(function() {
        const file = this.files[0];
        if (file) {
          let reader = new FileReader();
          reader.onload = function(event) {
            $("#preview_image").attr("src", event.target.result);
          };
          reader.readAsDataURL(file);
        }
      });
    })

    // Delete Employee
    $(document).on('click', '.delete', function() {
      employee_id = $(this).attr('id');
      $('#ok_button').text("{{ __('Delete') }}");
      $('#confirmModal').modal('show');
    })

    $('#ok_button').click(function() {
      $.ajax({
        url: "employees/destroy/" + employee_id,
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

    // Remove Employee Foto
    $(document).on('click', '.remove', function() {
      employee_id = $(this).attr('id');
      $('#remove_button').text("{{ __('Remove') }}");
      $('#photoModal').modal('show');
    })

    $('#remove_button').click(function() {
      $.ajax({
        url: "employees/destroy-photo/" + employee_id,
        beforeSend: function() {
          $('#remove_button').text("{{ __('Removing ...') }}");
        },
        success: function(data) {
          setTimeout(function() {
            $('#photoModal').modal('hide');
            $('#remove_button').text("{{ __('Remove') }}");
            $('.dataTable').DataTable().ajax.reload(null, false);
          }, 1000);
        }
      })
    })
  </script>
@endsection
