@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
          <div class="row">
             
              <div class="col-12">
                <h3 class="mt-2 text-center">Profit And Loss Report</h3>
                  <br>
                  <div class="card">          
                        <div class="card-body">
                            
                            <form action="{{route('society_profit_and_loss_submit')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="monthPicker">Select Month:</label>
                                            <select class="form-control select2" id="monthPicker" name="month" required>
                                                <option value="">--Select--</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="yearPicker">Select Year:</label>
                                            <select class="form-control select2" id="yearPicker" name="year" required>
                                                {{-- <option value="">--Select--</option> --}}
                                              <!-- JavaScript will populate this with years -->
                                            </select>
                                          </div>
                                    </div>
                                </div>
                              <button type="submit" class="btn btn-success float-right">Submit</button>
                            </form>                         
                        </div>
                      <!-- /.card-body -->
                    </div>
              </div>
          </div>
          <br>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    </div>
@endsection

@push('masterScripts')
<script>
$.noConflict(); // Ensures jQuery does not conflict with other libraries
jQuery(document).ready(function($) {
    $('.select2').select2();
})

document.addEventListener('DOMContentLoaded', function() {
  const yearPicker = document.getElementById('yearPicker');
  const currentYear = new Date().getFullYear();
  const startYear = 2000;  // Define the starting year
  const endYear = currentYear;  // You can adjust the end year if needed

  // Populate year dropdown
  for (let year = startYear; year <= endYear; year++) {
    const option = document.createElement('option');
    option.value = year;
    option.text = year;
    yearPicker.appendChild(option);
  }

  // Pre-select current year
  yearPicker.value = currentYear;

  yearPicker.addEventListener('change', function() {
    const selectedYear = yearPicker.value;
    console.log('Selected year:', selectedYear);
    // Perform actions based on the selected year
  });
});

</script>
@endpush
