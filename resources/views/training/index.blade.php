@extends('layouts.clear')

@section('main')
  @foreach ($data as $item)
    <h2>{{ $item->title }}</h2>
    @if ($item->slide->count())
      <table class="table-bordered table-hover dataTable w-100 table">
        <thead>
          <tr class="bg-azure-lt table bg-opacity-50 text-center text-white">
            <th class="text-center">{{ __('Position') }}</th>
            <th class="col-1 text-center">{{ __('Image') }}</th>
            <th class="col-9">{{ __('Title') }}</th>
            <th class="col-1">{{ __('Created') }}</th>
            <th class="col-1">{{ __('Updated') }}</th>
          </tr>
        </thead>
        @foreach ($item->slide as $slide)
          <tr>
            <td>
              <center>{{ $slide->position }}</center>
            </td>
            <td>
              <center><img class="card p-1" src="trainings/slides/{{ $slide->directory }}/{{ $slide->path }}" alt="{{ $slide->slide_title }}" height="80px"></center>
            </td>
            <td>{{ $slide->slide_title }}</td>
            <td>{{ $slide->created_at->format('d. m. Y') }}</td>
            <td>{{ $slide->updated_at->format('d. m. Y') }}</td>
          </tr>
        @endforeach
      </table>
    @endif
  @endforeach
@endsection

{{-- @section('scripts')
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
          url: "{{ route('employees.index') }}",
        },
        columnDefs: [{
          type: 'czech',
          targets: [3]
        }],
        columns: [{
            data: 'image',
            "width": "1%",
            render: function(data, type, row, full, meta) {
              return "<div class='img-hover-zoom'><center><img src={{ URL::to('/foto') }}/" +
                data + " class='zoom img-thumbnail' /></center></div>";
            },
            orderable: false,
          },
          {
            data: 'personal_number',
            "width": "1%",
            render: function(data, type, row, full, meta) {
              return "<span class='text-center text-" + row.department.color_id + "'><center><strong>" + data + "</strong></center></span>";
            },
          },
          {
            data: 'title_preffix',
            "width": "1%"
          },
          {
            data: 'last_name',
            "width": "3%",
          },
          {
            data: 'first_name',
            "width": "3%"
          },
          {
            data: 'department.center_code',
            "width": "1%"
          },
          {
            data: 'department.department_name',
            "width": "8%"
          },
          {
            data: 'job.job_title',
            "width": "7%"
          },
          {
            data: 'email',
            "width": "3%",
            render: function(data, type, full, meta) {
              if (data == null) {
                return ""
              } else {
                return "<a class='text-center' href='mailto:" + data + "'>" + data + "</a>";
              }
            },
          },
          {
            data: 'phone',
            className: "text-center",
            "width": "1%"
          },
          {
            data: 'mobile',
            "width": "2%"
          },
          {
            data: 'status',
            "width": "0.5%",
            render: function(data, type, full, meta) {
              if (data == 'Neaktivní') {
                return "<span title='{{ __('Inactive') }}' class='cursor-help mx-3 badge bg-red p-1 me-1'></span>";
              }
              if (data == 'Aktivní') {
                return "<span title='{{ __('Active') }}' class='cursor-help mx-3 badge bg-green p-1 me-1'></span>";
              }
              if (data == 'Mateřská') {
                return "<span title='{{ __('Maternal') }}' class='cursor-help mx-3 badge bg-yellow p-1 me-1'></span>";
              }
            }
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
        url: "/employees/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#inputForm')[0].reset();
          $("#modal-header, #modal-icon").removeClass();
          $('#formModal').modal('show');
          $('#modal-icon').addClass('fas fa-user-edit fa-2x m-2');
          $('#modal-header').addClass("modal-header bg-" + html.data.department.color_id + "-lt");
          $('#action_button, .modal-title').text("{{ __('Edit employee') }}");
          $('#action').val("Edit");
          $('#personal_number').val(html.data.personal_number).attr('readonly', true);
          $('#title_preffix').val(html.data.title_preffix);
          $('#last_name').val(html.data.last_name);
          $('#middle_name').val(html.data.middle_name);
          $('#first_name').val(html.data.first_name);
          $('#title_suffix').val(html.data.title_suffix);
          $('#married_name').val(html.data.married_name);
          $('#phone').val(html.data.phone);
          $('#mobile').val(html.data.mobile);
          $('#id_card').val(html.data.id_card);
          $('#department_id').val(html.data.department_id);
          $('#job_id').val(html.data.job_id);
          $('#comment').val(html.data.comment);
          $('#status').val(html.data.status);
          $('#email').val(html.data.email);
          $('#coffee').val(html.data.coffee);
          $('#department_code').val(html.data.department.department_code);
          $('#employment').val(html.data.employment);
          $('#position').val(html.data.position);
          $('#start_date').val(html.data.start_date);
          $('#end_date').val(html.data.end_date);
          $('#created_at').val(html.data.created_at);
          $('#updated_at').val(html.data.updated_at);
          $("#preview_image").attr("src", "{{ URL::to('/') }}/foto/no_image.png");
          $('#store_image').html("<img src={{ URL::to('/') }}/foto/" + html.data.image + " height='193px' class='bg-" + html.data.department.color_id +
            "-lt z-depth-1 img-thumbnail-big'></a>");
          $('#store_image').append("<input type='hidden' id='hidden_image' name='hidden_image' value='" + html.data.image + "' />");
          $('#hidden_id').val(html.data.id);
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset();
      $("#modal-icon, #modal-header").removeClass();
      $('#formModal').modal('show');
      $('#modal-icon').addClass('fas fa-user-plus fa-2x m-2');
      $('#modal-header').addClass("modal-header bg-muted-lt");
      $('#action_button, .modal-title').text("{{ __('Create new employee') }}");
      $('#action').val("Add");
      $('#personal_number').attr('readonly', false)
      $('#department_id, #job_id, #department_code').val('');
      $('#id_card').val('Nový nástup');
      $('#status').val('Neaktivní');
      $('#employment').val('HPP');
      $('#position').val(999);
      $('#coffee').val('N');
      $("#preview_image").attr("src", "{{ URL::to('/') }}/foto/no_image.png");
      $('#store_image').html("<img src={{ URL::to('/') }}/foto/no_image.png height='193px' class='bg-muted-lt z-depth-1 img-thumbnail-big'></a>");
      $('#store_image').append("<input type='hidden' id='hidden_image' name='hidden_image' value='' />");
    })

    $('#exportTable').click(function() {
      $('#exportForm')[0].reset();
      $("#modal-export-icon, #modal-export-header").removeClass();
      $('#exportModal').modal('show');
      $('#modal-export-icon').addClass('fas fa-file-export fa-2x m-2');
      $('#modal-export-header').addClass("modal-header bg-purple-lt");
      $('#export_button, .modal-title').text("{{ __('Export employees to file') }}");
      $('#action').val("Export");
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
      }
      if ($('#action').val() == "Export") {
        event.preventDefault();
        $.ajax({
          url: "{{ route('employees.export') }}",
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
              $('#form_result_window').html(html);
              $('#exportModal').modal('hide');
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

    $('.export-option').mousedown(function(e) {
      e.preventDefault();
      $(this).prop('selected', !$(this).prop('selected'));
      return false;
    });
  </script>
@endsection --}}
