@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add New Purchase</h3>
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
                    <form action="{{ route('purchase.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                                <table id="supplierTable" class="table table-bordered table-hover mt-4" style="display:none;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Sale Price</th>
                                            <th>Purchase Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier_id">Supplier Name</label>
                                    <div class="input-group">
                                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                                    <input type="text" id="invoice_no" name="invoice_no" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="purchase_date">Purchase Date</label>
                                    <input type="date" id="purchase_date" name="purchase_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" id="discount" value="0" name="discount" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tax">Tax</label>
                                    <input type="number" id="tax" name="tax" value="0" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="delivary_cost">Dalivery Cost</label>
                                    <input type="number" id="delivary_cost" name="delivary_cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="service_cost">Service Cost</label>
                                    <input type="number" id="service_cost" name="service_cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Sub Total</label>
                                    <input type="text" id="sub_total" name="sub_total" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="total_amount">Total</label>
                                    <input type="number" id="total_amount" name="total" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="paid">Paid</label>
                                    <input type="number" id="paid" value="0" name="paid" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="due">Due</label>
                                    <input type="number" id="due" name="due" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add Purchase</button>
                                    <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- New Supplier Modal -->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSupplierForm">
                        @csrf
                        <div class="form-group">
                            <label for="supplier_name">Supplier Name</label>
                            <input type="text" id="supplier_name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_phone">Phone</label>
                            <input type="text" id="supplier_phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_email">Email</label>
                            <input type="email" id="supplier_email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_company">Company</label>
                            <input type="text" id="supplier_company" name="company" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_area">Area</label>
                            <input type="text" id="supplier_area" name="area" class="form-control"  required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_address">Address</label>
                            <textarea id="supplier_address" name="address" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="alert alert-success" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;">
        <strong>Supplier added successfully!</strong>
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
