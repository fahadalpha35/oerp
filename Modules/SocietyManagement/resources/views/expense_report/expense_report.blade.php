@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
          <div class="row">
             
              <div class="col-12">
                <h3 class="mt-2 text-center">Expense Report</h3>
                  <br>
                  <div class="card">          
                        <div class="card-body">
                            
                            <form action="{{route('society_expense_report_submit')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="monthPicker">Start Date:</label>
                                            <input type="date" class="form-control" name="from_date" id="from_date" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="monthPicker">End Date:</label>
                                            <input type="date" class="form-control" name="to_date" id="to_date" required>
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
});
</script>
@endpush
