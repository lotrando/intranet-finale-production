@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/zamestnanci.png') }}" rel="shortcut icon">
@endsection

@section('content')
  <div class="page-wrapper">
    <!-- Page header -->
    <div class="container-fluid">
      @auth
        <div class="row align-items-center">
          <div class="ms-auto d-print-none col-auto">
            <div class="btn-list">
              <button class="btn btn-purple py-0" id="exportTable" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="{{ __('Export') }}"><i
                  class="fas fa-file-export fa-1x m-1"></i>Export</button>
              <a class="btn btn-green" id="exportPhoneList" data-bs-toggle="tooltip" data-bs-placement="bottom"
                data-bs-original-title="{{ __('Export phone list') }}" href="{{ route('employees.phonelist') }}" title="Telefoní seznam"><i
                  class="fas fa-address-book fa-1x m-1"></i>{{ __('Phonelist') }}</a>
              <a class="btn btn-blue" id="exportList" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="{{ __('Export list') }}"
                href="{{ route('employees.list') }}" title="Kompletní seznam"><i class="fas fa-book fa-1x m-1"></i>{{ __('List') }}</a>
              <button class="btn btn-lime" id="openCreateModal" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="{{ __('Nový') }}"><i
                  class="fas fa-user-plus fa-1x m-1"></i>{{ __('New') }}</button>
            </div>
          </div>
        </div>
      @endauth
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-fluid">
        <div class="card bg-white shadow-xl">
          <div class="card-header bg-lime-lt text-left">
            <div class="d-flex justify-item-around align-items-center">
              <div class="avatar bg-lime-lt col-auto">
                <svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                  <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                  <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                  <path d="M20.2 20.2l1.8 1.8"></path>
                </svg>
              </div>
              <div>
                <h2 class="ms-2 col-auto mb-0">{{ __($title) ?? '' }}</h2>
              </div>
            </div>
          </div>
          <div class="card-body p-2">
            <div class="row">
              <div class="col-12">
                <span id="form_result_window"></span>
              </div>
            </div>
            <table class="table-bordered table-hover dataTable w-100 table">
              <thead>
                <tr class="bg-azure-lt table bg-opacity-50 text-center text-white">
                  <th class="text-center">{{ __('Image') }}</th>
                  @auth
                    <th class="text-center">{{ __('Number') }}</th>
                  @endauth
                  <th>{{ __('Titles') }}</th>
                  <th>{{ __('Last name') }}</th>
                  <th>{{ __('First name') }}</th>
                  <th>{{ __('Department') }}</th>
                  <th>{{ __('Job title') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Mobile') }}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Status') }}</th>
                  @auth
                    <th>{{ __('ID Karta') }}</th>
                    <th>{{ __('Kávomat') }}</th>
                    <th>{{ __('Start date') }}</th>
                    <th class="text-center"><i class="fas fa-bars"></i></th>
                  @endauth
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Wrapper End -->
  @endsection

  @section('modals')
    {{-- Main Form Modal --}}
    <div class="modal modal-blur fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog modal-xl modal-dialog-center" role="document">
        <div class="modal-content shadow-lg">
          <div id="modal-header">
            <h5 class="modal-title"></h5>
            <i id="modal-icon"></i>
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
                <div class="col-1">
                  <label class="form-label">{{ __('Personal number') }}</label>
                  <input class="form-control" id="personal_number" name="personal_number" type="text" placeholder="{{ __('číslo') }}">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Titles preffix') }}</label>
                  <select class="form-select" id="title_preffix" name="title_preffix">
                    <option value=""></option>
                    <option value="Bc.">Bc.</option>
                    <option value="Bc. PhDr.">Bc. PhDr.</option>
                    <option value="MUDr.">MUDr.</option>
                    <option value="Ing.">Ing.</option>
                    <option value="PharmDr.">PharmDr.</option>
                    <option value="Mgr.">Mgr.</option>
                    <option value="MUDr. Ing.">MUDr. Ing.</option>
                    <option value="Ing. Mgr.">Ing. Mgr.</option>
                  </select>
                </div>
                <div class="col-3">
                  <label class="form-label">{{ __('Last name') }}</label>
                  <input class="form-control" id="last_name" name="last_name" type="text" placeholder="{{ __('Last name') }}">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('First name') }}</label>
                  <input class="form-control" id="first_name" name="first_name" type="text" placeholder="{{ __('First name') }}">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Titles suffix') }}</label>
                  <select class="form-select" id="title_suffix" name="title_suffix">
                    <option value=""></option>
                    <option value="DiS.">DiS.</option>
                    <option value="MBA">MBA</option>
                    <option value="LL.M.">LL.M.</option>
                    <option value="MBA, LL.M.">MBA, LL.M.</option>
                  </select>
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Employment') }}</label>
                  <select class="form-select" id="employment" name="employment">
                    <option value="HPP">HPP</option>
                    <option value="DPČ">DPČ</option>
                    <option value="DPP">DPP</option>
                    <option value="EVP">EVP</option>
                    <option value="ČSO">ČSO</option>
                  </select>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-2">
                  <label class="form-label">{{ __('Middle name') }}</label>
                  <input class="form-control" id="middle_name" name="middle_name" type="text" placeholder="{{ __('Middle name') }}">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Married name') }}</label>
                  <input class="form-control" id="married_name" name="married_name" type="text" placeholder="{{ __('Married name') }}">
                </div>
                <div class="col-1">
                  <label class="form-label">{{ __('Bussines phone') }}</label>
                  <input class="form-control" id="phone" name="phone" type="text" placeholder="{{ __('Phone') }}">
                </div>
                <div class="col">
                  <label class="form-label">{{ __('Position') }}</label>
                  <input class="form-control" id="position" name="position" type="text" placeholder="999">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Company cell phone') }}</label>
                  <input class="form-control" id="mobile" name="mobile" type="text" placeholder="{{ __('Mobil') }}">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('ID Card') }}</label>
                  <select class="form-select" id="id_card" name="id_card">
                    <option value="Nový nástup">Nový nástup</option>
                    <option value="Vytvořit kartu">Vytvořit kartu</option>
                    <option value="Vytvořit nálepku">Vytvořit nálepku</option>
                    <option value="Předat nálepku">Předat nálepku</option>
                    <option value="Aktual. nálepku">Aktual. nálepku</option>
                    <option value="Ok">Vydáno</option>
                    <option value="Vrácena">Vrácena</option>
                  </select>
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Status') }}</label>
                  <select class="form-select" id="status" name="status">
                    <option value="Neaktivní">Neaktivní</option>
                    <option value="Aktivní">Aktivní</option>
                    <option value="Mateřská">Mateřská</option>
                  </select>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-2">
                  <label class="form-label">{{ __('Email') }}</label>
                  <input class="form-control" id="email" name="email" type="text" placeholder="{{ __('Email') }}">
                </div>
                <div class="col-1">
                  <label class="form-label">{{ __('Coffee') }}</label>
                  <select class="form-select" id="coffee" name="coffee">
                    <option value="Ne">Ne</option>
                    <option value="Ano">Ano</option>
                  </select>
                </div>
                <div class="col-4">
                  <label class="form-label">{{ __('Department') }}</label>
                  <select class="form-select" id="department_id" name="department_id">
                    <option value=""></option>
                    @foreach ($departments as $department)
                      <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>
                        {{ $department->center_code }} -
                        {{ $department->department_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-1">
                  <label class="form-label">{{ __('Center') }}</label>
                  <input class="form-control" id="department_code" name="department_code" type="text" placeholder="{{ __('N/A') }}" readonly>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">{{ __('Job') }}</label>
                    <select class="form-select" id="job_id" name="job_id">
                      <option value=""></option>
                      @foreach ($jobs as $job)
                        <option value="{{ $job->id }}" @if (old('job_id') == $job->id) selected @endif>{{ $job->job_title }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-2">
                  <label class="form-label">{{ __('Current photo') }}</label>
                  <div class="d-flex justify-content-start align-items-start">
                    <span id="store_image"></span>
                  </div>
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Preview new photo') }}</label>
                  <div class="d-flex justify-content-start align-items-center">
                    <img class="z-depth-1 img-thumbnail-big" id="preview_image" height='193px'></img>
                  </div>
                </div>
                <div class="col-8">
                  <label class="form-label">{{ __('Description') }}</label>
                  <textarea class="form-control" id="comment" name="comment" type="text" placeholder="{{ __('Description') }}" rows="7"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label class="form-label">{{ __('Select file with new photo') }}</label>
                    <input class="form-control" id="image" name="image" type="file">
                  </div>
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Start date') }}</label>
                  <input class="form-control" id="start_date" name="start_date" type="date" placeholder="{{ __('Start date') }}"
                    onkeydown="return false">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('End date') }}</label>
                  <input class="form-control" id="end_date" name="end_date" type="date" placeholder="{{ __('End date') }}" onkeydown="return false">
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Created at') }}</label>
                  <input class="form-control" id="created_at" name="created_at" type="date" placeholder="{{ __('Created at') }}"
                    onkeydown="return false" readonly>
                </div>
                <div class="col-2">
                  <label class="form-label">{{ __('Updated at') }}</label>
                  <input class="form-control" id="updated_at" name="updated_at" type="date" placeholder="{{ __('Updated at') }}"
                    onkeydown="return false" readonly>
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
    <div class="modal modal-blur fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true"
      tabindex="-1">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg">
          <div class="modal-status bg-danger"></div>
          <div class="modal-body py-4 text-center">
            <svg class="icon text-danger icon-lg mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 9v2m0 4v.01" />
              <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
            </svg>
            <h3>{{ __('Are you sure?') }}</h3>
            <div class="text-muted">
              {{ __('Do you really want to remove employee?') }}<br>{{ __('This operation cannot be undone') }}
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

    {{-- Delete Employee Photo --}}
    <div class="modal modal-blur fade" id="photoModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg">
          <div class="modal-status bg-warning"></div>
          <div class="modal-body py-4 text-center">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <svg class="icon icon-tabler icon-tabler-photo-off text-warning icon-lg mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="3" y1="3" x2="21" y2="21"></line>
              <line x1="15" y1="8" x2="15.01" y2="8"></line>
              <path d="M19.121 19.122a3 3 0 0 1 -2.121 .878h-10a3 3 0 0 1 -3 -3v-10c0 -.833 .34 -1.587 .888 -2.131m3.112 -.869h9a3 3 0 0 1 3 3v9">
              </path>
              <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l5 5"></path>
              <path d="M16.32 12.34c.577 -.059 1.162 .162 1.68 .66l2 2"></path>
            </svg>
            <h3>{{ __('Are you sure?') }}</h3>
            <div class="text-muted">
              {{ __('Do you really want to remove photo?') }}<br>{{ __('This operation cannot be undone') }}
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
                  <button class="btn btn-warning w-100 hover-shadow" id="remove_button"></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Export Employees --}}
    <div class="modal modal-blur fade" id="exportModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true"
      tabindex="-1">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg">
          <div id="modal-export-header">
            <h5 class="modal-title"></h5>
            <i id="modal-export-icon"></i>
          </div>
          <form id="exportForm" action="{{ route('employees.export') }}">
            @csrf
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col-12">
                  <label class="form-label">{{ __('Export columns') }}</label>
                  <select class="form-select" id="column" name="column[]" multiple size=24>
                    @foreach ($columns as $column)
                      <option class="export-option" value="{{ $column }}" @if (old('column') == $column) selected @endif selected>
                        {{ $column }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <label class="form-label">{{ __('Sort by') }}</label>
                  <select class="form-select" id="sort" name="sort">
                    @foreach ($columns as $column)
                      <option value="{{ $column }}" @if (old('sort') == $column) selected @endif>{{ $column }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-4">
                  <label class="form-label">{{ __('Direction') }}</label>
                  <select class="form-select" id="direction" name="direction">
                    <option value="ASC" @if (old('direction') == 'ASC') selected @endif>
                      {{ __('Ascending') }}</option>
                    <option value="DESC" @if (old('direction') == 'DESC')  @endif>
                      {{ __('Descending') }}</option>
                  </select>
                </div>
                <div class="col-4">
                  <label class="form-label">{{ __('Format') }}</label>
                  <select class="form-select" id="format" name="format">
                    <option value="xlsx" @if (old('format') == 'xlsx')  @endif>
                      {{ __('*.xlsx') }}</option>
                    <option value="csv" @if (old('format') == 'csv')  @endif>
                      {{ __('*.csv') }}</option>
                  </select>
                </div>
              </div>
              <input id="action" name="action" type="hidden" />
            </div>
            <div class="modal-footer">
              <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
                {{ __('Close') }}
              </button>
              <button class="btn btn-primary ms-auto hover-shadow" id="export_button" name="export_button" type="submit"></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endsection

  @section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('js/czech-string.js') }}"></script>
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
          header: false,
          footer: false
        },
        order: [
          [3, "desc"]
        ],
        "lengthMenu": [
          [10, 20, 30, 60, 100, -1],
          [10, 20, 30, 60, 100, "Všechny"]
        ],
        language: {
          "url": "{{ asset('js/cs.json') }}",
          "sProcessing": "<img style='height:100px;' src='img/processing.gif' />",
          "search": "_INPUT_",
          "searchPlaceholder": "Hledej zaměstnance..."
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
              return "<div class='avatar avatar-sm'><center><img src={{ URL::to('/foto') }}/" +
                data + " class='zoom avatar' /></center></div>";
            },
            orderable: false,
          },
          @auth {
            data: 'personal_number',
            "width": "1%",
            render: function(data, type, row, full, meta) {
              return "<span class='text-center text-" + row.department.color_id +
                "'><center><strong>" + data + "</strong></center></span>";
            },
          },
        @endauth {
          data: 'title_preffix',
          "width": "auto"
        },
        {
          data: 'last_name',
          "width": "auto",
        },
        {
          data: 'first_name',
          "width": "auto"
        },
        {
          data: 'department.department_name',
          "width": "auto"
        },
        {
          data: 'job.job_title',
          "width": "auto"
        },
        {
          data: 'email',
          "width": "auto",
          render: function(data, type, full, meta) {
            if (data == null) {
              return ""
            } else {
              return "<a class='text-center' href='mailto:" + data + "'>" + data +
                "</a>";
            }
          },
        },
        {
          data: 'mobile',
          "width": "auto"
        },
        {
          data: 'phone',
          className: "text-center",
          "width": "auto"
        },
        {
          data: 'status',
          "width": "0.1%",
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
        @auth {
          data: 'id_card',
          className: "text-center",
          "width": "auto"
        },
        {
          data: 'coffee',
          className: "text-center",
          "width": "auto"
        },
        {
          data: 'start_date',
          "width": "auto",
          render: function(data, type, full, meta) {
            var date = moment(data).locale('cs');
            return date.format('DD. MM. YYYY');
          }
        },
        {
          data: 'action',
          "width": "0.5%",
          orderable: false,
          searchable: false
        },
      @endauth ],
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
            $('#modal-header').addClass("modal-header bg-" + html.data.department.color_id +
              "-lt");
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
            $('#store_image').html("<img src={{ URL::to('/') }}/foto/" + html.data.image +
              " height='193px' class='bg-" + html.data.department.color_id +
              "-lt z-depth-1 img-thumbnail-big'></a>");
            $('#store_image').append(
              "<input type='hidden' id='hidden_image' name='hidden_image' value='" + html
              .data.image + "' />");
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
        $('#store_image').html(
          "<img src={{ URL::to('/') }}/foto/no_image.png height='193px' class='bg-muted-lt z-depth-1 img-thumbnail-big'></a>"
        );
        $('#store_image').append(
          "<input type='hidden' id='hidden_image' name='hidden_image' value='' />");
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
                html +=
                  '</ul><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
                $('#form_result_modal').html(html);
              }
              if (data.success) {
                html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' +
                  data.success +
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
            url: "{{ route('employee.update') }}",
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
                $('.dataTable').DataTable().ajax.reload(null, false);
                $('#form_result_window').html(html);
                $('#formModal').modal('hide');
              }
            }
          });
        }
      });

      // Delete Employee
      $(document).on('click', '.delete', function() {
        employee_id = $(this).attr('id');
        $('#ok_button').text("{{ __('Delete') }}");
        $('#confirmModal').modal('show');
      })

      $('#ok_button').click(function() {
        $.ajax({
          url: "employee/destroy/" + employee_id,
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
          url: "employee/destroy-photo/" + employee_id,
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
  @endsection
