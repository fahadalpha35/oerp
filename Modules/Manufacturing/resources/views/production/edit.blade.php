@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Edit Production Order</h3>
                    <form action="{{ route('production.update', $production->id) }}" method="POST">
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
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="order_id">Work Order <small style="color: red">*</small></label>
                                <select  class="form-control select2" id="order_id" name="order_id" required>
                                    <option value="{{$production->order->id}}" selected readonly># {{$production->order->id .'-'. $production->order->client->name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="number_of_worker"> Number of Worker <small style="color: red">*</small></label>
                                <input type="number" class="form-control" name="worker" placeholder="Number of Worker" value="{{$production->worker}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="working_day">Working Day <small style="color: red">*</small></label>
                                <input type="number" class="form-control" name="duration" placeholder="Number of day" value="{{$production->duration}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="working_day">Total</label>
                                <input type="number" id="totalAmount" class="form-control" value="{{$production->total}}" name="total" placeholder="Total Cost Amount" readonly>
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
                                        @if (isset($production->production_cost))
                                            @foreach ($production->production_cost as $item)
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
    $.noConflict();
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
</script>

<script>
    $(document).ready(function() {
        $('#order_id').on('change', function(event) {
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

    $('#order_id').trigger('change');
        function calculateTotal() {
            let total = 0;
            $('.amount').each(function() {
                let amount = parseFloat($(this).val()) || 0;
                total += amount;
            });
            $('#totalAmount').val(total.toFixed(2));
        }

        $('#addRow').on('click', function() {
            let newRow = `<tr>
                            <input type="hidden" name="id[]">
                            <td class="form-group"><input type="text" name="name[]" class="name form-control" required></td>
                            <td class="form-group"><input type="number" name="amount[]" class="amount form-control" min="0" step="1" required></td>
                            <td class="form-group"><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                          </tr>`;
            $('#dynamicTable tbody').append(newRow);
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
            calculateTotal();
        });

        $(document).on('input', '.amount', function() {
            calculateTotal();
        });

        calculateTotal();
    });
</script>
@endpush
