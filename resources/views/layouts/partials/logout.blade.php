{{-- Logout Modal --}}
<div class="modal fade" id="logout-modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-status bg-danger"></div>
      <div class="modal-body py-4 text-center">
        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
        <svg class="icon icon-tabler icon-tabler-logout icon-lg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
             stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
          <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
        </svg>
        <h3>{{ __('Are you sure?') }}</h3>
        <div class="text-muted">{{ __('Do you really want to logout?') }}</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a class="btn w-100" data-bs-dismiss="modal" href="#">
                {{ __('Close') }}
              </a></div>
            <div class="col">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100" data-bs-dismiss="modal" type="submit" type="button"> {{ __('Logout') }}</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
