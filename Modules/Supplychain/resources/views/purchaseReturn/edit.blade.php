@extends('backend.layout.layout')

@section('content')
<div class="content-wrapper"><br>
    <div style="background:#fff;border-radius:30px;padding:30px;">
        <div class="mt-5 row" style="padding: 25px;">
            <div class="col-md-12 col-sm-12">
                <h3>Edit Client</h3><br>
                @if(Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                @endif
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
                <form method="POST" action="{{ route('purchase.update', $purchase->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="product">Products</label>
                                <div class="input-group">
                                    <select name="product" id="product" class="form-control">
                                        <option value="">Select Products</option>
                                        @foreach ($product as $data)
                                            <option value="{{ $data->id }}" data-cost-price="{{ $data->cost_price }}"
                                                data-selling-price="{{ $data->selling_price }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Purchase Quantity</label>
                                <input type="number" id="quantity" name="quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="purchase">Purchase Price</label>
                                <input type="text" id="purchase" name="purchase" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sale">Sale Price</label>
                                <input type="text" id="sale" name="sale" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="total">Total Amount <small style="color: red">(Quantity * Purchase Price)</small></label>
                                <input type="number" id="total" name="total" class="form-control" readonly>
                            </div>
                            <button type="button" id="cart_add" class="btn btn-primary">Add to Cart</button>
                            <table id="supplierTable" class="table table-bordered table-hover mt-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Sale Price</th>
                                        <th>Purchase Price</th>
                                        <th>Total</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($purchase->purchase_info))
                                        @foreach ($purchase->purchase_info as $data)
                                            <tr data-product-id="{{$data->product_id}}">
                                                <td>{{ $data->product->name }}</td>
                                                <td style="display: none"><input type="hidden" name="products[{{$data->product_id}}][id]" value="{{$data->id}}">{{$data->id}}</td>
                                                <td><input type="hidden" name="products[{{$data->product_id}}][quantity]" value="{{$data->quantity}}">{{$data->quantity}}</td>
                                                <td><input type="hidden" name="products[{{$data->product_id}}][sale_price]" value="{{$data->sale_price}}">{{$data->sale_price}}</td>
                                                <td><input type="hidden" name="products[{{$data->product_id}}][purchase_price]" value="{{$data->purchase_price}}">{{$data->purchase_price}}</td>
                                                <td class="product-total"><input type="hidden" name="products[{{$data->product_id}}][total]" value="{{$data->total}}"> {{$data->total}}</td>
                                                {{-- <td><button type="button" class="btn btn-danger btn-sm remove-btn">Remove</button></td> --}}
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplier_id">Supplier Name</label>
                                <div class="input-group">
                                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" @if ($supplier->id == $purchase->supplier_id) selected @endif>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addSupplierModal">
                                            <font color="#fff">Add Supplier</font>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="invoice_no">Invoice Number</label>
                                <input type="text" id="invoice_no" name="invoice_no" value="{{$purchase->invoice_no}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="purchase_date">Purchase Date</label>
                                <input type="date" id="purchase_date" name="purchase_date" value="{{$purchase->purchase_date}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" id="discount" name="discount" value="{{$purchase->discount}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tax">Tax</label>
                                <input type="number" id="tax" name="tax" value="{{$purchase->tax}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="delivary_cost">Dalivery Cost</label>
                                <input type="number" id="delivary_cost" name="delivary_cost" value="{{$purchase->delivary_cost}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="service_cost">Service Cost</label>
                                <input type="number" id="service_cost" name="service_cost" value="{{$purchase->service_cost}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Sub Total</label>
                                <input type="text" id="sub_total" name="sub_total" value="{{$purchase->sub_total}}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_amount">Total</label>
                                <input type="number" id="total_amount" name="total" value="{{$purchase->total}}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="paid">Paid</label>
                                <input type="number" id="paid" name="paid" value="{{$purchase->paid}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="due">Due</label>
                                <input type="number" id="due" name="due" value="{{$purchase->due}}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Purchase</button>
                                <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('masterScripts')
<script>
    $(document).ready(function () {
        $('#supplierTable').on('click', '.remove-btn', function() {
            $(this).closest('tr').remove();
            updateTotalAmount();
            toggleTableVisibility();
            totalSum();
        });
        function toggleTableVisibility() {
            if ($('#supplierTable tbody tr').length > 0) {
                $('#supplierTable').show(); // Show the table when there are rows
            } else {
                $('#supplierTable').hide();
            }
        }
        $('#cart_add').on('click', function () {
            var productId = $('#product').val();
            var productName = $('#product option:selected').text();
            var quantity = parseFloat($('#quantity').val());
            var purchasePrice = parseFloat($('#purchase').val());
            var salePrice = parseFloat($('#sale').val());
            var total = quantity * purchasePrice;

            if (!productId || quantity <= 0 || isNaN(salePrice)) {
                alert('Please select a valid product, quantity, and sale price.');
                return;
            }

            var existingRow = $('#supplierTable tbody').find(`tr[data-product-id="${productId}"]`);
            if (existingRow.length) {
                alert('This product is already added to the cart.');
                return;
            }

            var newRow = `
                <tr data-product-id="${productId}">
                    <td>${productName}</td>
                    <td><input type="hidden" name="products[${productId}][quantity]" value="${quantity}">${quantity}</td>
                    <td><input type="hidden" name="products[${productId}][sale_price]" value="${salePrice}">${salePrice}</td>
                    <td><input type="hidden" name="products[${productId}][purchase_price]" value="${purchasePrice}">${purchasePrice}</td>
                    <td class="product-total"><input type="hidden" name="products[${productId}][total]" value="${total.toFixed(2)}"> ${total.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-btn">Remove</button></td>
                </tr>
            `;
            $('#supplierTable tbody').append(newRow);

            toggleTableVisibility();
            updateTotalAmount();
            totalSum();

            $('#product').val('');
            $('#quantity').val('');
            $('#purchase').val('');
            $('#sale').val('');
            $('#total').val('');
        });

    function updateTotalAmount() {
        var totalAmount = 0;
        $('#supplierTable tbody tr').each(function() {
            var productTotal = parseFloat($(this).find('.product-total').text());
            totalAmount += productTotal;
        });
        $('#sub_total').val(totalAmount.toFixed(2));
        totalSum();
    };

    function totalSum(){
        var total = 0;

        // Get values and convert them to numbers
        var delivary_cost = parseFloat($('#delivary_cost').val()) || 0;
        var service_cost = parseFloat($('#service_cost').val()) || 0;
        var discount = parseFloat($('#discount').val()) || 0;
        var tax = parseFloat($('#tax').val()) || 0;
        var paid = parseFloat($('#paid').val()) || 0;
        var sub_total = parseFloat($('#sub_total').val()) || 0;


        total =  sub_total + delivary_cost + service_cost;
        total = total - discount - tax;
        total = total > 0 ? total : 0;
        $('#total_amount').val(total.toFixed(2));

        var checkdue = total - paid;
        var due = checkdue > 0 ? checkdue : 0;
        $('#due').val(due.toFixed(2));
    };

    $('#product').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var purchase = selectedOption.data('cost-price');
        var sale = selectedOption.data('selling-price');
        $('#purchase').val(purchase || '');
        $('#sale').val(sale || '');
    });

    $('#quantity').on('input', function(){
        var quantity  =parseFloat($('#quantity').val());
        var purchasePrice = parseFloat($('#purchase').val());
        var totalAmount = quantity * purchasePrice;
        $('#total').val(totalAmount.toFixed(2));
    });
    $('#delivary_cost ,#service_cost, #paid, #discount, #tax').on('input', function(){
        totalSum();
    });

    $('#addSupplierForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("purchase.storeSupplier") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#successMessage').fadeIn();
                setTimeout(function() {
                    $('#successMessage').fadeOut();
                }, 3000);
                setTimeout(function() {
                    location.reload();
                }, 0);
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                alert(errors.name ? errors.name[0] : 'An error occurred');
            }
        });
    });
});
</script>
@endpush
