@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Edit Work Order</h3>
                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="client_id">Client Name <small style="color: red">*</small></label>
                                <select  class="form-control select2" id="client_id" name="client_id" required>
                                <option value="">Select Client</option>
                                    @foreach ($clint as $data)
                                        <option value="{{$data->id}}" @if ($data->id == $order->client_id) selected @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-sm-6">
                                <label for="product_name">Product Name <small style="color: red">*</small></label>
                                <select  class="form-control select2" id="product_id" name="product_id" required>
                                    <option value="">Select Product</option>
                                    @foreach ($product as $data)
                                        <option value="{{$data->id}}" @if ($data->id == $order->product_id) selected @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" name="quantity" value="{{$order->quantity}}" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 total">
                                <label for="total">Total</label>
                                <input id="totalAmount" type="text" step="0.01" class="form-control" value="{{$order->total}}" name="total" required readonly>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="delivery_date">Delivery Date</label>
                                <input type="date" class="form-control" name="delivery_date" value="{{$order->delivery_date}}" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="internal_notes">Internal Notes</label>
                                <textarea class="form-control" rows="1" cols="5" name="internal_notes">{{$order->internal_notes}}</textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
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
                                        @if (isset($order->order_cost))
                                            @foreach ($order->order_cost as $item)
                                                <tr>
                                                    <input type="hidden" name="id[]" value="{{$item->id}}">
                                                    <td class="form-group">
                                                        <input type="text" name="name[]" class="name form-control" value="{{$item->name}}" required>
                                                    </td>
                                                    <td class="form-group">
                                                        <input type="number" name="amount[]" class="amount form-control" value="{{$item->amount}}" min="0" step="1" required>
                                                    </td>
                                                    <td class="form-group">
                                                        @if($loop->last)
                                                            <button type="button" class="btn btn-info" id="addRow">Add Row</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <input type="hidden" name="id[]">
                                            <td class="form-group">

                                                <input type="text" name="name[]" class="name form-control" required>
                                            </td>
                                            <td class="form-group">
                                                <input type="number" name="amount[]" class="amount form-control" min="0" step="1" required>
                                            </td>
                                            <td class="form-group">
                                                <button type="button" class="btn btn-info" id="addRow">Add Row</button>
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Order</button>
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

        // Add new row
        $('#addRow').on('click', function() {
            let newRow = `<tr>
                            <input type="hidden" name="id[]">
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
