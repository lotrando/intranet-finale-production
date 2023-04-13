@extends('layouts.employee')

@section('main')
  <div class="container-fluid mt-2">
    <div class="row mb-2">
      <div class="col-sm-12 col-lg-3">
        <div class="my-md-0 flex-grow-1 flex-md-grow-0 order-md-last card order-first p-2">
          <input class="form-control" id="search" type="text" value="" aria-label="Search employee"
                 placeholder="{{ __('Search by... personal number, lastname or firstname') }}">
          <div id="display"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function fill(Value) {
      $('#search').val(Value);
      $('#display').hide();
    }
    $(document).ready(function() {
      $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {
          $("#display").html("");
        } else {
          $.ajax({
            type: "GET",
            url: "{{ route('employees.search') }}",
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
@endsection
