@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add New Order</h3>
                    <form action="{{ route('production.store') }}" method="POST">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="order_id">Work Order <small style="color: red">*</small></label>
                                <select  class="form-control select2" id="order_id" name="order_id" required>
                                <option value="">Select Work Order</option>
                                    @foreach ($order as $data)
                                        <option value="{{$data->id}}"># {{$data->id .'-'. $data->client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="number_of_worker"> Number of Worker <small style="color: red">*</small></label>
                                <input type="number" class="form-control" name="worker" placeholder="Number of Worker">
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="working_day">Working Day <small style="color: red">*</small></label>
                                <input type="number" class="form-control" name="duration" placeholder="Number of day">
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="working_day">Total</label>
                                <input type="number" id="totalAmount" class="form-control" name="total" placeholder="Total Cost Amount" readonly>
                            </div>
                            <div id="work_order_cost" class="form-group col-md-6 col-sm-6">
                                <h3 class="mb-4">Select Work Order</h3>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <h3 class="mb-4">Cost Calculation</h3>
                                <table id="dynamicTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="form-group">
                                                <input type="text" name="name[]" class="name form-control" required>
                                            </td>
                                            <td class="form-group">
                                                <input type="number" name="amount[]" class="amount form-control" min="0" step="0.01" required>
                                            </td>
                                            <td class="form-group">
                                                <button type="button" class="btn btn-info" id="addRow">Add Row</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('masterScripts')
<script>
    $.noConflict(); // Ensures jQuery does not conflict with other libraries
    jQuery(document).ready(function($) {
        $('.select2').select2();
        $('#order_id').on('change',function(event){
            event.preventDefault();
            var order_id = $('#order_id').val();
            if (order_id == '') {
                $('#work_order_cost').html('');
                    return false;
                }
            $.ajax({
                url: '/get-order-details',
                type: 'POST',
                data: {
                    id: order_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#work_order_cost').html(response);
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to calculate the total amount
        function calculateTotal() {
            let total = 0;
            $('.amount').each(function() {
                let amount = parseFloat($(this).val()) || 0;
                total += amount;
            });
            $('#totalAmount').val(total.toFixed(2));
        }

        // Add new row
        $('#addRow').on('click', function() {
            let newRow = `<tr>
                            <td class="form-group"><input type="text" name="name[]" class="name form-control" required></td>
                            <td class="form-group"><input type="number" name="amount[]" class="amount form-control" min="0" step="0.01" required></td>
                            <td class="form-group"><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                          </tr>`;
            $('#dynamicTable tbody').append(newRow);
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

        // Calculate total on page load
        calculateTotal();
    });
</script>
@endpush
