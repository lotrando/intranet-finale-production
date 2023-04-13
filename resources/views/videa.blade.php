@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="{{ asset('img/videa.png') }}" rel="shortcut icon">
@endsection

@section('content')
  <div class="container-fluid p-3">
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
        <div class="display mt-2 mb-2" id="display"></div>
      </div>

      {{-- Page pre-title --}}
      <div class="col mt-3">
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
              @if (Auth::user()->role == 'admin')
                <button class="btn btn-lime d-inline-block me-2" id="openCreateModal" data-bs-toggle="tooltip" data-bs-placement="left"
                  data-bs-original-title="{{ __('Vytvoří nový') }}">
                  <svg class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                    <path d="M8 4l0 16"></path>
                    <path d="M16 4l0 16"></path>
                    <path d="M4 8l4 0"></path>
                    <path d="M4 16l4 0"></path>
                    <path d="M4 12l16 0"></path>
                    <path d="M16 8l4 0"></path>
                    <path d="M16 16l4 0"></path>
                  </svg>
                  <span class="d-xs-none d-sm-inline d-md-inline d-lg-inline">{{ __('Nové video') }}</span>
                </button>
              @endif
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
      <div class="row row-cards mx-1">
        @foreach ($videos as $video)
          <div class="col-12 col-lg-4">
            <div class="card shadow-sm" style="height: 100%">
              <div class="card-header bg-blue-lt text-left">
                <div class="d-flex justify-item-center align-items-center">
                  <div class="avatar bg-blue-lt col-auto">
                    <svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                      <path d="M8 4l0 16"></path>
                      <path d="M16 4l0 16"></path>
                      <path d="M4 8l4 0"></path>
                      <path d="M4 16l4 0"></path>
                      <path d="M4 12l16 0"></path>
                      <path d="M16 8l4 0"></path>
                      <path d="M16 16l4 0"></path>
                    </svg>
                  </div>
                  <div>
                    <h2 class="ms-2 col-auto mb-0">{{ $video->name }}</h2>
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <video poster="{{ asset($video->image) }}" width="100%" controls>
                  <source src="{{ asset($video->video) }}" type="video/mp4">
                  Váš prohlížeč nepodporuje přehrávání videí
                </video>
              </div>
              @if ($video->content)
                <div class="card-footer">
                  <span class="text-muted">{{ $video->content }}</span>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-blue-lt">
          <h5 class="modal-title"></h5>
          <span class="avatar avatar-transparent bg-blue-lt">
            <svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
              <path d="M8 4l0 16"></path>
              <path d="M16 4l0 16"></path>
              <path d="M4 8l4 0"></path>
              <path d="M4 16l4 0"></path>
              <path d="M4 12l16 0"></path>
              <path d="M16 8l4 0"></path>
              <path d="M16 16l4 0"></path>
            </svg>
          </span>
        </div>
        <form id="inputForm" action="{{ route('video.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-2">
                <label class="form-label">{{ __('Name') }}</label>
                <input class="form-control" id="name" name="name" type="text" placeholder="{{ __('Název videa') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-2">
                <label class="form-label">{{ __('Náhled') }}</label>
                <input class="form-control" id="image" name="image" type="file" placeholder="{{ __('Náhled videa (screenshot z videa)') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12 mb-2">
                <label class="form-label">{{ __('Video') }}</label>
                <input class="form-control" id="video" name="video" type="file" placeholder="{{ __('Video soubor') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-4 mb-2">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="status" name="status">
                  <option value="Zobrazeno">Zobrazeno</option>
                  <option value="Nezobrazeno">Nezobrazeno</option>
                </select>
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label class="form-label">{{ __('Umístění') }}</label>
                <select class="form-select" id="category" name="category" type="text">
                  <option value="edukace">Edukativní</option>
                  <option value="lekis">Lekis</option>
                  <option value="bozp">BOZP a PO</option>
                </select>
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label class="form-label">{{ __('Založil / upravil') }}</label>
                <input class="form-control" id="user_name" name="user_name" type="text" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-12">
                <div class="form-group">
                  <label class="form-label">{{ __('Popisek k videu') }}</label>
                  <textarea class="form-control" id="content" name="content"></textarea>
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
                {{ __('Upravit') }}
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
  <script>
    // Form Modal Functions
    $(document).on('click', '.edit', function() {
      id = $(this).attr('id');
      content
      $.ajax({
        url: "/video/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#modal-header', '#modal-icon').removeClass()
          $('#inputForm')[0].reset()
          $('#attachment, #action_button').removeClass('d-none')
          $('#formModal').modal('show')
          $('#modal-icon').html(html.data.type.svg_icon).addClass("bg-" + html.data.type.type_color + "-lt")
          $('#modal-header').addClass("modal-header bg-" + html.data.type.type_color + "-lt")
          $('.modal-title').text("{{ __('Edit') }} oznámení - " + html.data.title)
          $('#action_button').text("{{ __('Edit') }} oznámení")
          $('#action').val("Edit")
          $('#title').val(html.data.title)
          $('#content').summernote('code', html.data.content)
          $('#type_id').val(html.data.type_id)
          $('#importance').val(html.data.importance)
          $('#status').val(html.data.status)
          $('#hidden_id').val(html.data.id)
          $('#user_id').val(html.data.user_id)
          $('#user_name').val(html.data.user.name)
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset();
      $("#action_button").removeClass('d-none')
      $('#formModal').modal('show')
      $('#action_button, .modal-title').text("{{ __('Vytvořit nové video') }}")
      $('#action').val("Add")
      $('#status').val('Zobrazeno')
      $('#user_id').val('{{ auth()->user()->id ?? null }}')
      $('#user_name').val('{{ auth()->user()->name ?? 'Guest' }}')
    })

    $('#inputForm').on('submit', function(event) {
      event.preventDefault();
      if ($('#action').val() === 'Add') {
        $.ajax({
          url: "{{ route('video.store') }}",
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
          url: "{{ route('video.store') }}",
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

    // Delete video and delete confirm modal
    $(document).on('click', '.delete', function() {
      id = $(this).attr('id')
      $('#ok_button').text("{{ __('Delete') }}")
      $('#confirmModal').modal('show')
      $('#ok_button').click(function() {
        $.ajax({
          url: "/video/destroy/" + id,
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
