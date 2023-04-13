@extends('layouts.adverse')

@section('favicon')
  <link type="image/png" href="/img/udalost.png" rel="shortcut icon" />
@endsection

@section('title', 'Nežádoucí události')

@section('buttons')
  <div class="btn-list">
    <button class="btn btn-success d-none d-sm-inline-block" id="openCreateModal" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-original-title="{{ __('Creates new adverse event') }}">
      <svg class="icon icon-tabler icon-tabler-alert-triangle" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
           stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M12 9v2m0 4v.01"></path>
        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
      </svg>
      {{ __('Nová') }}
    </button>
  </div>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card mb-2 mt-2 shadow-sm">
          <div class="card-header align-items-center justify-content-between bg-muted-lt d-flex">
            <h3 class="text-muted m-0 mb-0 p-0">
              {{ __('Adverse events of KHN') }}
            </h3>
            <div class="ms-auto d-print-none col-auto">
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
                  {{-- <th>{{ __('Department') }}</th> --}}
                  <th>{{ __('Typ') }}</th>
                  <th>{{ __('Místo') }}</th>
                  <th>{{ __('Date') }}</th>
                  <th>{{ __('Time') }}</th>
                  <th>{{ __('Pracovník') }}</th>
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
  <div class="modal modal-blur fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-full-width modal-dialog-centered mx-5" role="document">
      <div class="modal-content shadow-lg">
        <div id="modal-header">
          <h5 class="modal-title"></h5>
          <i id="modal-icon"></i>
        </div>
        <form id="inputForm" action="{{ route('adversevents.create') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span id="form_result_modal"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('Department') }}</label>
                <select class="form-select" id="department_id" name="department_id">
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>
                      {{ $department->department_code }} -
                      {{ $department->department_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('Místo') }}</label>
                <input class="form-control" id="misto" name="misto" type="text" placeholder="{{ __('Místo kde se událost stala') }}">
              </div>
              <div class="col-6 col-lg-2 mb-sm-1">
                <label class="form-label">{{ __('Datum') }}</label>
                <input class="form-control" id="datum_cas" name="datum_cas" type="date" value="{{ date('Y-m-d') ?? old('date') }}" placeholder="{{ __('Dnešní datum') }}"
                       onkeydown="return false">
              </div>
              <div class="col-6 col-lg-2 mb-sm-1">
                <label class="form-label">{{ __('Čas') }}</label>
                <input class="form-control" id="cas" name="cas" type="time" value="{{ date('H:i') ?? old('time') }}" placeholder="{{ __('Aktuální čas') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('Specifikace nežádoucí události') }}</label>
                <select class="form-select" id="spec_druh" name="spec_druh" type="text">
                  <option value="Administrativní problém">Administrativní problém</option>
                  <option value="Klinický výkon">Klinický výkon</option>
                  <option value="Problém se zdravotnickou dokumentací">Problém se zdravotnickou
                    dokumentací</option>
                  <option value="Medikace">Medikace</option>
                  <option value="Nežádoucí účinek léčiva">Nežádoucí účinek léčiva</option>
                  <option value="Transfuze, krevní deriváty">Transfuze, krevní deriváty</option>
                  <option value="Sedace, anestezie">Sedace, anestezie</option>
                  <option value="Neshody mezi předoperační a pooperační diagnózou">Neshody mezi
                    předoperační a pooperační diagnózou</option>
                  <option value="Nevhodné chování">Nevhodné chování</option>
                  <option value="Svévolný odchod pacienta">Svévolný odchod pacienta</option>
                  <option value="Krádež">Krádež</option>
                  <option value="Nehody a neočekávaná zranění">Nehody a neočekávaná zranění</option>
                  <option value="Problém s technikou nebo vybavením">Problém s technikou nebo
                    vybavením</option>
                  <option value="Pád">Pád</option>
                  <option value="Jiný">Jiný</option>
                </select>
              </div>
              <div class="col-8 col-lg-6 mb-sm-1">
                <label class="form-label">{{ __('Jiný druh nežádoucí události') }}</label>
                <input class="form-control" id="jinydoplnek" name="jinydoplnek" type="text"
                       placeholder="{{ __('Vyplňuje se jen v případě jiného druhu nežádoucí události') }}">
              </div>
              <div class="col-4 col-lg-2 mb-sm-1">
                <label class="form-label">{{ __('Chorobopis') }}</label>
                <input class="form-control" id="chorobopis" name="chorobopis" type="text" placeholder="{{ __('Číslo chorobopisu') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-4 col-lg-3 mb-sm-1">
                <label class="form-label">{{ __('Jméno pacienta / účastníka') }}</label>
                <input class="form-control" id="pacient" name="pacient" type="text" placeholder="{{ __('Jméno pacienta') }}">
              </div>
              <div class="col-4 col-lg-2 mb-sm-1">
                <label class="form-label">{{ __('Datum narození pacienta') }}</label>
                <input class="form-control" id="datumnaroz" name="datumnaroz" type="date" placeholder="{{ __('Datum narození pacienta') }}">
              </div>
              <div class="col-4 col-lg-3 mb-sm-1">
                <label class="form-label">{{ __('Jméno pracovníka') }}</label>
                <input class="form-control" id="pracovnik" name="pracovnik" type="text" value="{{ Auth::user()->name ?? '' }}"
                       placeholder="{{ __('Jméno pracovníka který událost zapsal') }}">
              </div>
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('Svědek / Svědci') }}</label>
                <input class="form-control" id="svedek" name="svedek" type="text" placeholder="{{ __('Svědek nebo svědci události') }}">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('K čemu došlo') }}</label>
                <textarea class="form-control" id="udalost" name="udalost" type="text" placeholder="{{ __('Popiš nežádoucí událost') }}" rows="3"></textarea>
              </div>
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('Následující řešení po zjištění ') }}</label>
                <textarea class="form-control" id="reseni" name="reseni" type="text" placeholder="{{ __('Následující řešení po zjištění ') }}" rows="3"></textarea>
              </div>
              <div class="col-12 col-lg-4 mb-sm-1">
                <label class="form-label">{{ __('Navržená preventivní opatření') }}</label>
                <textarea class="form-control" id="opatreni" name="opatreni" type="text" placeholder="{{ __('Navržená preventivní opatření') }}" rows="3"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-9 col-lg-10 mb-sm-1">
                <label class="form-label">{{ __('Informován') }}</label>
                <input class="form-control" id="informovan" name="informovan" type="text" placeholder="{{ __('Kdo byl o události informován') }}">
              </div>
              <div class="col-3 col-lg-2 mb-sm-1">
                <label class="form-label">{{ __('Status') }}</label>
                <select class="form-select" id="status" name="status">
                  <option value="Rozpracováno">Rozpracováno</option>
                  <option value="Odesláno">Odesláno</option>
                  <option value="Dokončeno">Dokončeno</option>
                </select>
              </div>
            </div>
            <div id="pad_panel">
              <div class="row">
                <div class="col-6 col-lg-6 mb-sm-1">
                  <label class="form-label">{{ __('Příčina pádu') }}</label>
                  <select class="form-select" id="pricina" name="pricina" aria-required="true" style="width: 100%;">
                    <option value="" selected="selected">
                    </option>
                    <option value="pád z lůžka s postranicemi">Pád z lůžka s postranicemi
                    </option>
                    <option value="pád z lůžka bez postranic">Pád z lůžka bez postranic
                    </option>
                    <option value="vstávání z lůžka">Vstávání z lůžka</option>
                    <option value="opření o nestabilní oporu">Opření o nestabilní oporu
                    </option>
                    <option value="nestabilita při chůzi">nestabilita při chůzi</option>
                    <option value="zakopnutí, uklouznutí">zakopnutí, uklouznutí</option>
                    <option value="z důvodu medikace">z důvodu medikace</option>
                    <option value="jiný důvod pádu">Jiný důvod pádu</option>
                  </select>
                </div>
                <div class="col-6 col-lg-6 mb-sm-1">
                  <label class="form-label">{{ __('Stav pacienta po pádu') }}</label>
                  <select class="form-select" id="stav_pacienta" name="stav_pacienta" aria-required="true" style="width: 100%;">
                    <option id="stav_pacienta_0" value="" selected="selected"></option>
                    <option id="stav_pacienta_1" value="orientovaný/á">orientovaný/á</option>
                    <option id="stav_pacienta_2" value="zmatený/á">zmatený/á</option>
                    <option id="stav_pacienta_3" value="bezvědomí">bezvědomí</option>
                  </select>
                </div>
                <div class="col-6 col-lg-6 mb-sm-1">
                  <label class="form-label">{{ __('Lokalizace zranění po pádu') }}</label>
                  <select class="form-select" id="lokalizace" name="lokalizace" aria-required="true" style="width: 100%;">
                    <option id="lokalizace_0" value="" selected="selected"></option>
                    <option id="lokalizace_1" value="hlava">Hlava</option>
                    <option id="lokalizace_2" value="hrudník">Hrudník</option>
                    <option id="lokalizace_3" value="horní končetiny">Horní končetina</option>
                    <option id="lokalizace_4" value="ruka">Ruka</option>
                    <option id="lokalizace_5" value="břicho">Břicho</option>
                    <option id="lokalizace_6" value="záda">Záda</option>
                    <option id="lokalizace_7" value="pánev">Pánev</option>
                    <option id="lokalizace_8" value="dolní končetiny">Dolní končetina
                    </option>
                    <option id="lokalizace-9" value="noha">Noha</option>
                  </select>
                </div>
                <div class="col-6 col-lg-6 mb-sm-1">
                  <label class="form-label">{{ __('Příznaky po pádu') }}</label>
                  <select class="form-select" id="druh_zraneni" name="druh_zraneni" aria-required="true" style="width: 100%;">
                    <option id="druh_zraneni_0" value="" selected="selected"></option>
                    <option id="druh_zraneni_1" value="Bezvědomí (lehké zranění)">Bezvědomí (lehké zranění)</option>
                    <option id="druh_zraneni_2" value="Komoce mozku (těžké zranění)">Komoce mozku (těžké zranění)</option>
                    <option id="druh_zraneni_3" value="Zlomenina (těžké zranění)">Zlomenina (těžké zranění)</option>
                    <option id="druh_zraneni_4" value="Tržná rána">Tržná rána (střední zranění)</option>
                    <option id="druh_zraneni_5" value="Povrchová odřenina (lehké zranění)">Povrchová odřenina (lehké zranění)</option>
                    <option id="druh_zraneni_6" value="Hematom (lehké zranění)">Hematom (lehké zranění)</option>
                    <option id="druh_zraneni_7" value="Jiné LZ (lehké zranění)">Jiné LZ (lehké zranění)</option>
                    <option id="druh_zraneni_8" value="Jiné SZ (střední zranění)">Jiné SZ (střední zranění)</option>
                    <option id="druh_zraneni_9" value="Jiné TZ (těžké zranění">Jiné TZ (těžké zranění)</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-sm-1">
                  <label class="form-label">{{ __('Předchozí preventivní opatření') }}</label>
                  <textarea class="form-control" id="preventivni_opatreni" name="preventivni_opatreni" type="text" placeholder="{{ __('Předchozí preventivní opatření') }}" rows="3"></textarea>
                </div>
                <div class="col-12 col-md-6 mb-sm-1">
                  <label class="form-label">{{ __('Zhodnocení zdrav. stavu, lékařem') }}</label>
                  <textarea class="form-control" id="zhodnoceni_stavu" name="zhodnoceni_stavu" type="text" placeholder="{{ __('Zhodnocení zdrav. stavu, lékařem') }}" rows="3"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-4 col-lg-2 mb-sm-1">
                  <label class="form-label">Datum zhodnocení lékařem</label>
                  <input class="form-control" id="datum" name="datum" type="date" placeholder="Upřesnění k překladu, jiný">
                </div>
                <div class="col-4 col-lg-3 mb-sm-1">
                  <label class="form-label">Jméno lékaře</label>
                  <select class="form-select" id="jmeno_lekare" name="jmeno_lekare">
                    @foreach ($doctors as $doctor)
                      <option value="{{ $doctor->title_preffix }} {{ $doctor->last_name }} {{ $doctor->first_name }}">
                        {{ $doctor->last_name }} {{ $doctor->first_name }}, {{ $doctor->title_preffix }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-4 col-lg-2 mb-sm-1">
                  <label class="form-label">{{ __('Další vývoj') }}</label>
                  <select class="form-select" id="vyvoj" name="vyvoj" aria-required="true" style="width: 100%;">
                    <option id="vyvoj_0" value="žádný" selected="selected">žádný</option>
                    <option id="vyvoj_1" value="operace">operace</option>
                    <option id="vyvoj_2" value="umrtí">umrtí</option>
                    <option id="vyvoj_3" value="překlad">překlad</option>
                    <option id="vyvoj_4" value="jiný">jiný</option>
                  </select>
                </div>
                <div class="col-128 col-lg-5 mb-sm-1">
                  <label class="form-label">Upřesnění k jinému vývoji</label>
                  <input class="form-control" id="upresneni" name="upresneni" type="text" placeholder="Upřesnění k jinému vývoji">
                </div>
              </div>
            </div>
          </div>
          <input id="action" name="action" type="hidden" />
          <input id="hidden_id" name="hidden_id" type="hidden" />

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

  {{-- Delete Event Modal --}}
  <div class="modal modal-blur fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
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
            {{ __('Do you really want to remove adverse event?') }}<br>{{ __('This operation cannot be undone') }}
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
          [1, "asc"]
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
          url: "{{ route('adversevents.index') }}",
        },
        columnDefs: [{
          type: 'czech',
          targets: [3]
        }],
        columns: [
          //  {
          //     data: 'department_name',
          //     "width": "5%",
          //     searchable: false
          //   },
          {
            data: 'spec_druh',
            "width": "7%"
          },
          {
            data: 'misto',
            "width": "6%"
          },
          {
            data: 'datum_cas',
            "width": "2%",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('DD. MM. YYYY');
            }
          },
          {
            data: 'cas',
            "width": "2%"
          },
          {
            data: 'pracovnik',
            "width": "3%"
          },
          {
            data: 'status',
            "width": "0.5%",
            render: function(data, type, full, meta) {
              if (data == 'Odesláno') {
                return "<span title='{{ __('Odesláno') }}' class='cursor-help mx-3 badge bg-success p-1 me-1'></span>";
              }
              if (data == 'Rozpracováno') {
                return "<span title='{{ __('Rozpracováno') }}' class='cursor-help mx-3 badge bg-orange p-1 me-1'></span>";
              }
              if (data == 'Dokončeno') {
                return "<span title='{{ __('Dokončeno') }}' class='cursor-help mx-3 badge bg-info p-1 me-1'></span>";
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

    $(function() {
      $('#jinydoplnek').prop('disabled', true);
      $('#spec_druh').change(function() {
        if ($(this).val() == "Jiný") {
          $('#jinydoplnek').prop('disabled', false);
        } else {
          $('#jinydoplnek').val('').prop('disabled', true);
        }
      });
    });

    $(function() {
      $('#upresneni').prop('disabled', true);
      $('#vyvoj').change(function() {
        if ($(this).val() == "jiný") {
          $('#upresneni').prop('disabled', false);
        } else {
          $('#upresneni').val('').prop('disabled', true);
        }
      });
    });

    $(function() {
      $('#pad_panel').hide();
      $('#spec_druh').change(function() {
        if ($(this).val() === "Pád") {
          $('#pad_panel').show();
        }
        if ($(this).val() !== "Pád") {
          $('#pad_panel').hide();
        }
      });
    });

    // Form Modal Functions
    $(document).on('click', '.edit', function() {
      var id = $(this).attr('id');
      $('#form_result_modal, form_result_window').html('');
      $.ajax({
        url: "/adversevents/" + id + "/edit",
        dataType: "json",
        success: function(html) {
          $('#inputForm')[0].reset();
          $("#modal-header, #modal-icon").removeClass();
          $('#formModal').modal('show');
          $('#modal-icon').addClass('fas fa-exclamation-triangle fa-2x m-2');
          $('#modal-header').addClass("modal-header bg-yellow-lt");
          $('#action_button, .modal-title').text("{{ __('Edit adverse event') }}");
          $('#action').val("Edit");
          $('#department_code').val(html.data.department.department_code);
          $('#department_id').val(html.data.department_id);
          $('#misto').val(html.data.misto);
          $('#datum_cas').val(html.data.datum_cas);
          $('#cas').val(html.data.cas);
          $('#spec_druh').val(html.data.spec_druh);
          $('#chorobopis').val(html.data.chorobopis);
          if ($('#spec_druh').val() === "Jiný") {
            $('#jinydoplnek').prop('disabled', false);
            $('#jinydoplnek').val(html.data.jinydoplnek);
          } else {
            $('#jinydoplnek').prop('disabled', true);
            $('#jinydoplnek').val();
          }
          $('#pacient').val(html.data.pacient);
          $('#datumnaroz').val(html.data.datumnaroz);
          $('#pracovnik').val(html.data.pracovnik);
          $('#svedek').val(html.data.svedek);
          $('#udalost').val(html.data.udalost);
          $('#reseni').val(html.data.reseni);
          $('#opatreni').val(html.data.opatreni);
          $('#informovan').val(html.data.informovan);
          $('#pricina').val(html.data.pricina);
          $('#stav_pacienta').val(html.data.stav_pacienta);
          $('#lokalizace').val(html.data.lokalizace);
          $('#druh_zraneni').val(html.data.druh_zraneni);
          $('#preventivni_opatreni').val(html.data.preventivni_opatreni);
          $('#zhodnoceni_stavu').val(html.data.zhodnoceni_stavu);
          $('#datum').val(html.data.datum);
          $('#jmeno_lekare').val(html.data.jmeno_lekare);
          $('#vyvoj').val(html.data.vyvoj);
          $('#upresneni').val(html.data.upresneni);
          $('#status').val(html.data.status);
          $('#created_at').val(html.data.created_at);
          $('#updated_at').val(html.data.updated_at);
          $('#hidden_id').val(html.data.id);
          if ($('#spec_druh').val() === "Pád") {
            $('#pad_panel').show();
          } else {
            $('#pad_panel').hide();
          }
        }
      })
    });

    $('#openCreateModal').click(function() {
      $('#inputForm')[0].reset();
      $("#modal-icon, #modal-header").removeClass();
      $('#department_id, #department_code, #spec_druh').val('');
      $('#formModal').modal('show');
      $('#modal-icon').addClass('fas fa-exclamation-triangle fa-2x m-2');
      $('#modal-header').addClass("modal-header bg-red-lt");
      $('#action_button, .modal-title').text("{{ __('Create new adverse event') }}");
      $('#action').val("Add");
      $('#status').val('Rozpracováno');
    })

    $('#inputForm').on('submit', function(event) {
      event.preventDefault();
      if ($('#action').val() == 'Add') {
        $.ajax({
          url: "{{ route('adversevents.store') }}",
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
              html = '<div class="alert alert-success text-success shadow-sm"><ul><li>' + data.success + '</li></ul></div>';
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
          url: "{{ route('adversevent.update') }}",
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
      event_id = $(this).attr('id');
      $('#ok_button').text("{{ __('Delete') }}");
      $('#confirmModal').modal('show');
    })

    $('#ok_button').click(function() {
      $.ajax({
        url: "adversevent/destroy/" + event_id,
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
