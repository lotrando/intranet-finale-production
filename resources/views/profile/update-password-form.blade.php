    <div class="container-fluid py-2 pt-3">
      <div class="card card-md shadow-sm">
        <div class="card-body">
          <div class="mb-6">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
          </div>

          <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">{{ __('Current password') }}</label>
              <input class="form-control" name="current_password" type="password" placeholder="{{ __('Current password') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('New password') }}</label>
              <input class="form-control" name="password" type="password" placeholder="{{ __('New password') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('New password confirmation') }}</label>
              <input class="form-control" name="password_confirmation" type="password" placeholder="{{ __('New password confirmation') }}">
            </div>

            <div class="d-flex justify-content-end">
              <div class="form-footer">
                <button class="btn btn-success text-uppercase hover-shadow mb-2" type="submit">{{ __('Update') }}</button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
