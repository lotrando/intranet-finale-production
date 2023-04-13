@section('searchbar')
<div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
  <form autocomplete="off">
    <div class="input-icon">
      <span class="input-icon-addon">
        <svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
          <path d="M21 21l-6 -6"></path>
        </svg>
      </span>
      <input type="text" id="search" class="form-control" placeholder="{{ __('Hledat standard nebo dokument...') }}">
    </div>
  </form>
</div>
@endsection
