@extends('layouts.clear')
<style>
  /* Slideshow container */
  .slideshow-container {
    max-width: 750px;
    position: relative;
    margin: auto;
  }

  /* Hide the images by default */
  .mySlides {
    display: none;
    overflow: hidden;
  }

  /* Next & previous buttons */
  .prev {
    cursor: pointer;
    position: absolute;
    top: 50%;
    left: -12%;
    width: auto;
    margin-top: -45px;
    font-weight: bold;
    transition: 0.6s ease;
    border-radius: 10px;
    user-select: none;
  }

  /* Position the "next button" to the right */
  .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    right: -12%;
    width: auto;
    margin-top: -45px;
    font-weight: bold;
    transition: 0.6s ease;
    border-radius: 10px;
    user-select: none;
  }

  /* Caption text */
  .text {
    color: #f2f2f2;
    font-family: 'Roboto Condensed';
    font-size: 15px;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
  }

  /* Slide numbers text */
  .numbertext {
    color: #f2f2f2;
    font-size: 25px;
    padding: 3px 8px;
    position: absolute;
    font-family: 'Roboto Condensed';
    top: 0;
  }

  /* Dots indicators */
  .dot {
    cursor: none;
    color: white;
    padding-top: 1px;
    height: 22px;
    width: 22px;
    margin: 0 0px;
    background-color: rgba(114, 121, 134, 0.659);
    font-family: 'Roboto Condensed';
    font-size: 14px;
    border-radius: 15%;
    display: inline-block;
    transition: background-color 0.6s ease;
  }

  /* Active Dot */
  .active-dot {
    background-color: #206bc4;
  }
</style>
@section('main')
  @foreach ($data as $item)
    <div class="slideshow-container">
      @if ($item->slide->count())
        @foreach ($item->slide as $slide)
          <div class="col-12">
            <div class="card mySlides mt-5 shadow-lg">
              <div class="ribbon ribbon bg-red">
                {{ $slide->position }}/{{ $item->slide->count() }}
              </div>
              <div class="card-header">
                <h1 class="card-title">{{ $item->title }}</h1>
              </div>
              <div class="card-body p-1">
                <img src="../trainings/slides/{{ $slide->directory }}/{{ $slide->path }}" style="width:100%">
              </div>
            </div>
          </div>
          <!-- Next and previous buttons -->
          <a class="btn btn-primary hover-shadow text-decoration-none prev p-3 text-white" onclick="plusSlides(-1)">&#10094;</a>
          <a class="btn btn-primary hover-shadow text-decoration-none next p-3 text-white" onclick="plusSlides(1)">&#10095;</a>
        @endforeach
      @endif
    </div>
    <br>
    <!-- The dots/circles -->
    <div id="dots" style="text-align:center">
      @foreach ($item->slide as $slide)
        <span class="dot">{{ $slide->position }}</span>
      @endforeach
    </div>
  @endforeach
@endsection

@section('modals')
  <!-- Start Modal content -->
  <div class="modal modal-blur" id="start_modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        {{-- <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="{{ __('Close') }}"></button> --}}
        <div class="modal-status bg-success"></div>
        <div class="modal-body py-4 text-center">
          <div class="row">
            <div class="col-12">
              <span id="form_result_modal"></span>
            </div>
          </div>
          <svg class="icon icon-tabler icon-lg icon-tabler-presentation" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="3" y1="4" x2="21" y2="4"></line>
            <path d="M4 4v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-10"></path>
            <line x1="12" y1="16" x2="12" y2="20"></line>
            <line x1="9" y1="20" x2="15" y2="20"></line>
            <path d="M8 12l3 -3l2 2l3 -3"></path>
          </svg>
          <h3>{{ __('Stisknutím tlačítka start spustíte školení?') }}</h3>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button class="btn btn-success w-100 hover-shadow" id="start-button" onclick="getStart()">{{ __('Start') }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- End Modal content -->
  <div class="modal modal-blur" id="end_modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <formrm class="modal-content shadow-lg">
        <div class="modal-status bg-info"></div>
        <div class="modal-body py-4 text-center">
          <div class="row">
            <div class="col-12">
              <span id="form_result_modal"></span>
            </div>
          </div>
          <svg class="icon icon-tabler text-info icon-tabler-question-mark icon-lg mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path>
            <line x1="12" y1="19" x2="12" y2="19.01"></line>
          </svg>
          <form action="{{ route('attendances.store') }}" method="post">
            @csrf
            <div class="mb-6">
              @if ($errors->any())
                <div class="alert alert-danger text-danger shadow">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
            <div class="row mb-4">
              <div class="col-2">
                <label class="form-label">{{ __('Personal number') }}</label>
                <input class="form-control" id="personal_number" name="personal_number" type="text" placeholder="{{ __('Personal number') }}">
              </div>
              <div class="col-5">
                <label class="form-label">{{ __('Last name') }}</label>
                <input class="form-control" id="last_name" name="last_name" type="text" placeholder="{{ __('Last name') }}">
              </div>
              <div class="col-5">
                <label class="form-label">{{ __('First name') }}</label>
                <input class="form-control" id="first_name" name="first_name" type="text" placeholder="{{ __('First name') }}">
              </div>
              <input id="training_id" name="training_id" type="hidden" value="{{ $item->id }}">
              <input id="start" name="start_time" type="hidden" value="">
              <input id="end" name="end_time" type="hidden" value="">
            </div>
            <button class="btn btn-info w-100 hover-shadow" id="subbmit_button" type="submit">{{ __('Confirm') }}</button>
          </form>
        </div>
    </div>
  @endsection

  @section('scripts')
    <script>
      startModal = document.getElementById("start_modal");
      endModal = document.getElementById("end_modal");

      // Starting first slide
      slideIndex = 0;
      showSlides(slideIndex);

      function getStart() {
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()
        document.getElementById('start').value = time
      }

      // start presentation
      $('#start-button').click(function() {
        startModal.style.display = "none";
        slideIndex = 1;
      })

      $('#cancel-button').click(function() {
        console.log('pressed');
        startModal.style.display = "none";
        slideIndex = 0;
      })

      // Next/previous controls
      function plusSlides(n) {
        showSlides(slideIndex += n);
      }

      // Thumbnail image controls
      function currentSlide(n) {
        showSlides(slideIndex = n);
      }

      function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
          slideIndex = 1
        }
        if (n <= 0) {
          slideIndex = 0;
          startModal.style.display = "block";
        }
        if (n > slides.length) {
          slideIndex = slides.length;
          var today = new Date();
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()
          document.getElementById('end').value = time
          endModal.style.display = "block";
        }
        if (n < 1) {
          slideIndex = 1
        }
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active-dot", "")
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active-dot";
      }
    </script>
  @endsection
