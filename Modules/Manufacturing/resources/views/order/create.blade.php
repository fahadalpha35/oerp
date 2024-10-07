@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add New Work Order</h3>
                    <form action="{{ route('order.store') }}" method="POST">
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
                            <!-- Client Selection -->
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="client_id">Client Name <small style="color: red">*</small></label>
                                <select class="form-control select2" id="client_id" name="client_id" required>
                                    <option value="">Select Client</option>
                                    @foreach ($clint as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Selection -->
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="product_id">Product Name <small style="color: red">*</small></label>
                                <select class="form-control select2" id="product_id" name="product_id" required>
                                    <option value="">Select Product</option>
                                    @foreach ($product as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity Input -->
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" required>
                            </div>

                            <!-- Total Display -->
                            <div class="form-group col-md-6 col-sm-6 total">
                                <label for="total">Total</label>
                                <input id="totalAmount" type="text" step="0.01" class="form-control" name="total" required readonly>
                            </div>

                            <!-- Delivery Date Input -->
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="delivery_date">Delivery Date</label>
                                <input type="date" class="form-control" name="delivery_date" required>
                            </div>

                            <!-- Internal Notes -->
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="internal_notes">Internal Notes</label>
                                <textarea class="form-control" rows="1" cols="5" name="internal_notes"></textarea>
                            </div>

                            <!-- Cost Calculation Table -->
                            <div class="form-group col-md-12 col-sm-12">
                                <h3 class="mb-4">Cost Calculation</h3>
                                <table id="dynamicTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Service Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- Name Input -->
                                            <td class="form-group">
                                                <input type="text" name="name[]" class="name form-control" required>
                                            </td>
                                            
                                            <!-- Amount Input -->
                                            <td class="form-group">
                                                <input type="number" name="amount[]" class="amount form-control" min="0" step="0.01" required>
                                            </td>
                                            
                                            <!-- Service Type Select -->
                                            <td class="form-group">
                                                <select name="service_id[]" class="form-control select2" required>
                                                    <option value="">Select Service</option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            
                                            <!-- Action Buttons -->
                                            <td class="form-group">
                                                <button type="button" class="btn btn-info addRow">Add Row</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Form Buttons -->
                        <button type="submit" class="btn btn-primary">Create Order</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
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

        // Initialize total on page load
        calculateTotal();

        // Add new row
        $('.addRow').on('click', function() {
            let newRow = `<tr>
                            <!-- Name Input -->
                            <td class="form-group">
                                <input type="text" name="name[]" class="name form-control" required>
                            </td>
                            
                            <!-- Amount Input -->
                            <td class="form-group">
                                <input type="number" name="amount[]" class="amount form-control" min="0" step="0.01" required>
                            </td>
                            
                            <!-- Service Type Select -->
                            <td class="form-group">
                                <select name="service_id[]" class="form-control select2" required>
                                    <option value="">Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
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
    });
</script>
@endpush
