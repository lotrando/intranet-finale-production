@extends('layouts.blank')

@section('favicon')
<link type="image/png" href="{{ asset('img/kantyna.png') }}" rel="shortcut icon">
@endsection

@section('content')
<div class="page-wrapper">
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-fluid">
      <div class="row align-items-center">
        <!-- Page pre-title -->
        <div class="col">
          <div class="page-pretitle text-primary">
            {{ __($pretitle) ?? '' }}
          </div>
          <h2 class="page-title text-primary">
            {{ __($title) ?? '' }}
          </h2>
        </div>

        <div class="ms-auto d-print-none col-auto">
          <div class="btn-list">
            <div class="d-flex justify-content-end">
              {{ $daylist->onEachSide(7)->links() }}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Wrapper End -->

<!-- Page body -->
<div class="page-body">
  <div class="container-fluid">
    <div class="row justify-content-start g-1">
      <div class="col-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
        <div class="card">
          <div class="card-header bg-azure-lt text-left">
            <div class="d-flex justify-item-center align-items-center">
              <div class="avatar bg-azure-lt col-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M19 3v12h-5c-.023 -3.681 .184 -7.406 5 -12zm0 12v6h-1v-3m-10 -14v17m-3 -17v3a3 3 0 1 0 6 0v-3"></path>
                </svg>
              </div>
              <div>
                <h2 class="ms-2 col-auto mb-0">Nabídka teplých jídel</h2>
              </div>
            </div>
          </div>
          <div class="card-body px-3">
            <div class="divide-y">
              @foreach ($daylist as $day)
              @if (date('N', strtotime($day->date)) < 6) <div>
                <div class="row d-flex align-items-center justify-content-start">
                  <div class="col-1">
                    @if (date('N', strtotime($day->date)) >= 6)
                    <span class="avatar bg-pink-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                    @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                    <span class="avatar bg-lime-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                    @else
                    <span class="avatar bg-azure-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                    @endif
                  </div>
                  @if (date('N', strtotime($day->date)) >= 6)
                  <div class="col-1">
                    <span>
                      <div class="text-pink">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                    </span>
                  </div>
                  @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                  <div class="col-1">
                    <span>
                      <div class="text-lime">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                    </span>
                  </div>
                  <div class="col-4">
                    @if ($day->polevka == '')
                    <div class="text-red mb-3">Nevyplněno</div>
                    @else
                    <div class="text-lime mb-3">{{ $day->polevka }}</div>
                    @endif
                    @if ($day->jidlo_a == '')
                    <div class="text-red mb-3">Nevyplněno</div>
                    @else
                    <div class="text-lime mb-3">{{ $day->jidlo_a }}</div>
                    @endif
                    @if ($day->jidlo_b == '')
                    <div class="text-red">Nevyplněno</div>
                    @else
                    <div class="text-lime">{{ $day->jidlo_b }}</div>
                    @endif
                  </div>
                  @else
                  <div class="col-1">
                    <span>
                      <div class="text-azure">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                    </span>
                  </div>
                  <div class="col-4">
                    @if ($day->polevka == '')
                    <div class="text-red mb-3">Nevyplněno</div>
                    @else
                    <div class="text-blue mb-3">{{ $day->polevka }}</div>
                    @endif
                    @if ($day->jidlo_a == '')
                    <div class="text-red mb-3">Nevyplněno</div>
                    @else
                    <div class="text-blue mb-3">{{ $day->jidlo_a }}</div>
                    @endif
                    @if ($day->jidlo_b == '')
                    <div class="text-red">Nevyplněno</div>
                    @else
                    <div class="text-blue">{{ $day->jidlo_b }}</div>
                    @endif
                  </div>
                  @endif
                  @auth
                  @if (Auth::user()->role == 'strava' or Auth::user()->role == 'admin')
                  @if (date('N', strtotime($day->date)) < 6) <div class="col-12 col-lg-6">
                    <select class="form-select edit-polevka mb-1 p-1" name="polevka[{{ $day->id }}]" data-id="{{ $day->id }}">
                      <option value="">Vyber polévku</option>
                      <option value="*">*</option>
                      <option value="* Svátek - Dnes se nevaří">* Svátek - Dnes se nevaří</option>
                      @foreach ($food->where('type', '=', 'soup') as $polevka)
                      <option value="{{ $polevka->name }}" @if ($day->polevka == $polevka->name) selected @endif>
                        {{ $polevka->name }}
                      </option>
                      @endforeach
                    </select>
                    <select class="form-select edit-jidlo-a mb-1 p-1" name="jidlo_a[{{ $day->id }}]" data-id="{{ $day->id }}">
                      <option value="">Vyber polévku</option>
                      <option value="*">*</option>
                      <option value="* Svátek - Dnes se nevaří">* Svátek - Dnes se nevaří</option>
                      @foreach ($food->where('type', 'food') as $jidlo)
                      <option value="{{ $jidlo->name }}" @if ($day->jidlo_a == $jidlo->name) selected @endif>
                        {{ $jidlo->name }}
                      </option>
                      @endforeach
                    </select>

                    <select class="form-select edit-jidlo-b p-1" name="jidlo_b[{{ $day->id }}]" data-id="{{ $day->id }}">
                      <option value="">Vyber polévku</option>
                      <option value="*">*</option>
                      <option value="* Svátek - Dnes se nevaří">* Svátek - Dnes se nevaří</option>
                      @foreach ($food->where('type', 'food') as $jidlo)
                      <option value="{{ $jidlo->name }}" @if ($day->jidlo_b == $jidlo->name) selected @endif>
                        {{ $jidlo->name }}
                      </option>
                      @endforeach
                    </select>
                </div>
                @endif
                @endauth
                @endif
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-12 col-lg-6 col-xl-5 col-xxl-4">
    <div class="card">
      <div class="card-header bg-teal-lt text-left">
        <div class="d-flex justify-item-center align-items-center">
          <div class="avatar bg-teal-lt col-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-teal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
              <circle cx="18" cy="18" r="4"></circle>
              <path d="M15 3v4"></path>
              <path d="M7 3v4"></path>
              <path d="M3 11h16"></path>
              <path d="M18 16.496v1.504l1 1"></path>
            </svg>
          </div>
          <div>
            <h2 class="ms-2 col-auto mb-0">Provozní doba</h2>
          </div>
        </div>
      </div>
      <div class="card-body card-body-scrollable card-body-scrollable-shadow">
        <div class="divide-y">
          @foreach ($daylist as $day)
          <div>
            <div class="row d-flex align-items-center justify-content-between">
              <div class="col-auto">
                @if (date('N', strtotime($day->date)) >= 6)
                <span class="avatar bg-pink-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
                <span class="avatar bg-lime-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                @else
                <span class="avatar bg-blue-lt"><strong>{{ Carbon\Carbon::parse($day->date)->format('d|m') }}</strong></span>
                @endif
              </div>
              @if (date('N', strtotime($day->date)) >= 6)
              <div class="d-flex align-items-center justify-content-start col-2">
                <span>
                  <div class="text-pink">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                </span>
              </div>
              @elseif (Carbon\Carbon::parse($day->date) == Carbon\Carbon::today())
              <div class="d-flex align-items-center justify-content-start col-2">
                <span>
                  <div class="text-lime">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                </span>
              </div>
              @else
              <div class="d-flex align-items-center justify-content-start col-2">
                <span>
                  <div class="text-azure">{{ Carbon\Carbon::parse($day->date)->locale('cs')->dayName }}</div>
                </span>
              </div>
              @endif
              @auth
              <div class="col-12 col-lg-3">
                <div class="text-blue"> {{ $day->kantyna }}</div>
              </div>
              @if (Auth::user()->role == 'kantyna' or Auth::user()->role == 'admin')
              <div class="col-12 col-lg-6">
                <input class="form-control kantyna" type="text" name="kantyna[{{ $day->id }}]" data-id="{{ $day->id }}" value="{{ $day->kantyna }}">
              </div>
              @endif
              @else
              <div class="col-8 d-flex align-items-center justify-content-start">
                <div class="text-truncate fw-bold">{{ $day->kantyna }}</div>
              </div>
              @endauth
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

</div>
</div>
@endsection

@section('scripts')
<script>
$('.edit-polevka').on('change', function() {
  var value = $(this).val()
  var id = $(this).data('id')
  $.ajax({
    type: 'POST',
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/stravovani/polevka/update/" + id,
    data: {
      polevka: value,
      id: id
    },
    dataType: "json",
    success: function(data) {
      console.log('success')
      location.reload()
    }
  })
})
$('.edit-jidlo-a').on('change', function() {
  var value = $(this).val()
  var id = $(this).data('id')
  $.ajax({
    type: 'POST',
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/stravovani/jidloa/update/" + id,
    data: {
      jidlo_a: value,
      id: id
    },
    dataType: "json",
    success: function(data) {
      console.log('success')
      location.reload()
    }
  })
})
$('.edit-jidlo-b').on('change', function() {
  var value = $(this).val()
  var id = $(this).data('id')
  $.ajax({
    type: 'POST',
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/stravovani/jidlob/update/" + id,
    data: {
      jidlo_b: value,
      id: id
    },
    dataType: "json",
    success: function(data) {
      console.log('success')
      location.reload()
    }
  })
})
$('.kantyna').on('change', function() {
  var value = $(this).val()
  var id = $(this).data('id')
  $.ajax({
    type: 'POST',
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/stravovani/kantyna/update/" + id,
    data: {
      kantyna: value,
      id: id
    },
    dataType: "json",
    success: function(data) {
      console.log('success')
      location.reload()
    }
  })
})
</script>
@endsection