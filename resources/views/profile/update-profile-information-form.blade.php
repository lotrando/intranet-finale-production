<div class="container-fluid py-2">
  <div class="card card-md shadow-sm">
    @csrf
    <div class="card-body">
      <div class="mb-6">
        @if ($errors->any())
        <div class="alert alert-danger text-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if (session('status') == 'profile-information-updated')
        <div class="alert alert-success" role="alert">
          {{ __('Profile updated') }}
        </div>
        @endif
      </div>

      <form method="POST" action="{{ route('user-profile-information.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">{{ __('Name') }}</label>
          <input class="form-control" name="name" type="text" value="{{ old('name') ?? auth()->user()->name }}" placeholder="{{ __('Name') }}">
        </div>

        <div class="mb-3">
          <label class="form-label">{{ __('Email address') }}</label>
          <input class="form-control" name="email" type="email" value="{{ old('email') ?? auth()->user()->email }}" placeholder="{{ __('Email address') }}">
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
