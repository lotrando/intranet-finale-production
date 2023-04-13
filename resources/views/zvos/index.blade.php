@extends('layouts.blank')

@section('favicon')
  <link type="image/png" href="./img/zvos.png" rel="shortcut icon">
@endsection

@section('searchbar')
  <div class="my-md-0 flex-grow-1 flex-md-grow-0 order-md-last order-first my-2">
    <form autocomplete="off">
      <div class="input-icon">
        <span class="input-icon-addon">
          <svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
            <path d="M21 21l-6 -6"></path>
          </svg>
        </span>
        <input class="form-control" id="search" type="text" size="15"
          placeholder="{{ __('Hledat dokument ...') }}">
      </div>
    </form>
  </div>
@endsection

@section('content')
  {{-- Page wrapper --}}
  <div class="page-wrapper">

    {{-- Page header --}}
    <div class="page-header d-print-none">
      <div class="container-fluid">
        <div class="row align-items-center">

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

          {{-- Page buttons --}}
          <div class="ms-auto d-print-none col-auto">
            <div class="btn-list">
              <div class="d-flex justify-content-end">
                {{-- Buttons --}}
              </div>
            </div>
          </div>
          {{-- End Page buttons --}}

        </div>
      </div>
    </div>

    {{-- Page body --}}
    <div class="page-body">
      <div class="container-fluid">
        {{-- Searched events --}}
        <div>
          <div class="display mt-2 mb-3" id="display"></div>
        </div>

        <div class="row g-2">
          <div class="col-12 col-lg-12">

          </div>
        </div>
      </div>
      {{-- End Page body --}}
    </div>
    <!-- Wrapper End -->

    {{-- Show Modal --}}
    <div class="modal fade" id="showModal" role="dialog" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-full-width" role="document">
        <div class="modal-content shadow-lg">
          <div id="show-modal-header">
            <h5 class="modal-title"></h5>
            <div class="avatar avatar-transparent" id="show-modal-icon"></div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-7">

                <div class="row">
                  <div class="col-2 mb-3 mt-3">
                    <label class="form-label">{{ __('Position') }}</label>
                    <input class="form-control" id="show-position" type="text" readonly>
                  </div>
                  <div class="col-7 mb-3 mt-3">
                    <label class="form-label">{{ __('Name') }} dokumentu</label>
                    <input class="form-control" id="show-name" type="text" readonly>
                  </div>
                  <div class="col-3 mb-3 mt-3">
                    <label class="form-label">{{ __('Revision') }}</label>
                    <input class="form-control" id="show-revision" type="text" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Popis dokumentu') }} </label>
                    <input class="form-control" id="show-description" type="text" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4 mb-3">
                    <label class="form-label">{{ __('Datum revize') }}</label>
                    <input class="form-control" id="show-revision_date" type="date" readonly>
                  </div>
                  <div class="col-4 mb-3">
                    <label class="form-label">{{ __('Datum další revize') }}</label>
                    <input class="form-control" id="show-next_revision_date" type="date" readonly>
                  </div>
                  <div class="col-4 mb-3">
                    <label class="form-label">{{ __('Platnost dokumentu od') }}</label>
                    <input class="form-control" id="show-efficiency" type="date" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4 mb-3">
                    <label class="form-label">{{ __('Zpracoval/a') }}</label>
                    <input class="form-control" id="show-processed" type="text" readonly>
                  </div>
                  <div class="col-4 mb-3">
                    <label class="form-label">{{ __('Schválil/a') }}</label>
                    <input class="form-control" id="show-authorize" type="text" readonly>
                  </div>
                  <div class="col-4 mb-3">
                    <label class="form-label">{{ __('Kontrolu provedl/a') }}</label>
                    <input class="form-control" id="show-examine" type="text" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Oblast působnosti dokumentu') }}</label>
                    <input class="form-control" id="show-tags" type="text" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Soubor') }}</label>
                    <input class="form-control" id="show-file" type="text" readonly>
                  </div>
                  <div class="col-6 mb-3">
                    <label class="form-label">{{ __('Status') }}</label>
                    <input class="form-control" id="show-status" readonly>
                  </div>
                  <div class="col-6 mb-3">
                    <label class="form-label">{{ __('Založil / upravil') }}</label>
                    <input class="form-control" id="show-user_name" name="user_name" type="text" readonly>
                  </div>
                </div>
              </div>

              <div class="col-5 p-1">
                <div id="pdf-preview-show"></div>
                <input id="category_id" name="category_id" type="hidden">
                <input id="action" name="action" type="hidden" />
                <input id="hidden_id" name="hidden_id" type="hidden" />
                <input id="user_id" name="user_id" type="hidden" />
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <div class="align-content-end flex">
              <a class="btn btn-red ms-auto hover-shadow" id="download-btn" type="button" href="">
                <svg class="icon icon-inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 20h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5"></path>
                  <path d="M13 16h-7a2 2 0 0 0 -2 2"></path>
                  <path d="M15 19l3 3l3 -3"></path>
                  <path d="M18 22v-9"></path>
                </svg>
                {{ __('Download file') }}</a>
            </div>
            <button class="btn btn-muted hover-shadow" data-bs-dismiss="modal" type="button">
              <svg class="icon icon-inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="16" height="16" rx="2">
                </rect>
                <path d="M10 10l4 4m0 -4l-4 4"></path>
              </svg>
              {{ __('Close') }}
            </button>
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
      });
    </script>
    <script>
      $(document).on('click', '.show', function() {
        id = $(this).attr('id');
        $('#unique_code').prop('readonly', true);
        $('#form_result_modal, #form_result_window').html('');
        $.ajax({
          url: "/documents/" + id,
          dataType: "json",
          success: function(html) {
            $('.modal-title').val('')
            $('#pdf-preview-show, #pdf-preview, #pdf-preview-addon-show').removeClass('d-none')
            $('#showModal').modal('show')
            $('#show-modal-icon').html('').addClass('bg-lime-lt')
            $('#show-modal-header').addClass("modal-header bg-lime-lt")
            $('.modal-title').text(html.data.description)
            $('#category_id').val(html.data.category_id)
            $('#show-folder_name').val(html.data.category.folder_name)
            $('#show-name').val(html.data.name)
            $('#show-processed').val(html.data.processed)
            $('#show-authorize').val(html.data.authorize)
            $('#show-examine').val(html.data.examine)
            $('#show-efficiency').val(html.data.efficiency)
            $('#show-revision').val(html.data.revision)
            $('#show-revision_date').val(html.data.revision_date)
            $('#show-next_revision_date').val(html.data.next_revision_date)
            $('#show-tags').val(html.data.tags)
            $('#show-description').val(html.data.description)
            $('#show-position').val(html.data.position)
            $('#show-file').val(html.data.file)
            $('#show-status').val(html.data.status)
            $('#show-user_id').val('{{ auth()->user()->id ?? null }}')
            $('#show-user_name').val(html.data.user.name)
            $('#attachment, #action_button').addClass('d-none')
            $('#show-hidden_id').val(html.data.id)
            $('#download-btn').attr("href", "/soubory/standard/" + html.data.id + "")
            PDFObject.embed("../../soubory/" + html.data.file + "#toolbar=0", "#pdf-preview-show", {
              height: "33rem"
            })
          }
        })
      });
    </script>
  @endsection
