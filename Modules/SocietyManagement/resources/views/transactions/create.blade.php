@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('society_transaction_list')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Transaction</h3>
                  <br>
                  <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{route('store_society_transaction')}}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                <table id="dynamicTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Account Name</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Name</th>
                                            <th>Cost Less</th>
                                            <th>Transaction Amount (BDT)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                       
                                        <!-- Account Type Select -->
                                        <td class="form-group">
                                            <select name="account_id[]" class="form-control select2" required>
                                                <option value="">Select</option>
                                                @foreach($account_types as $account_type)
                                                    <option value="{{$account_type->id}}">{{$account_type->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <!-- Transaction Date -->
                                        <td class="form-group">
                                            <input type="date" name="transaction_date[]" class="name form-control" required>
                                        </td>

                                        <!-- Transaction Name Input -->
                                        <td class="form-group">
                                            <input type="text" name="transaction_name[]" class="name form-control" required>
                                        </td>

                                        <!-- Cost Less -->
                                        <td class="form-group">
                                            <select name="cost_less[]" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </td>
                                        
                                        <!--Transaction Amount Input -->
                                        <td class="form-group">
                                            <input type="number" name="transaction_amount[]" class="amount form-control" min="0" step="0.01" required>
                                        </td>
                                                                                                                         
                                        <!-- Action Buttons -->
                                        <td class="form-group">
                                            <button type="button" class="btn btn-info addRow">Add Row</button>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <br>

                                <!-- Total Amount -->
                                <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6 total">
                                    <label for="total">Total</label>
                                    <input id="totalAmount" type="text" step="0.01" class="form-control" name="" readonly>
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


        // Function to calculate the total amount
        function calculateTotal() {
            let total = 0;
            $('.amount').each(function() {
                let amount = parseFloat($(this).val()) || 0;
                total += amount;
            });
            $('#totalAmount').val(total.toFixed(2));
        }

        // Initialize total on page load
        calculateTotal();

         // Add new row
         $('.addRow').on('click', function() {
            let newRow = `<tr>
                           <!-- Account Type Select -->
                            <td class="form-group">
                                <select name="account_id[]" class="form-control select2" required>
                                    <option value="">Select</option>
                                    @foreach($account_types as $account_type)
                                        <option value="{{$account_type->id}}">{{$account_type->account_name}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Transaction Date -->
                            <td class="form-group">
                                <input type="date" name="transaction_date[]" class="name form-control" required>
                            </td>

                            <!-- Transaction Name Input -->
                            <td class="form-group">
                                <input type="text" name="transaction_name[]" class="name form-control" required>
                            </td>

                            <!-- Cost Less -->
                            <td class="form-group">
                                <select name="cost_less[]" class="form-control select2" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            
                            <!--Transaction Amount Input -->
                            <td class="form-group">
                                <input type="number" name="transaction_amount[]" class="amount form-control" min="0" step="0.01" required>
                            </td>
                            
                            <!-- Remove Button -->
                            <td class="form-group">
                                <button type="button" class="btn btn-danger removeRow">Remove</button>
                            </td>
                          </tr>`;
            $('#dynamicTable tbody').append(newRow);
            $('.select2').select2();  // Re-initialize select2 for the new select
        });

        // Remove row
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
            calculateTotal(); // Recalculate total after removal
        });

        // Update total when amount changes
        $(document).on('input', '.amount', function() {
            calculateTotal();
        });
})
</script>
@endpush
