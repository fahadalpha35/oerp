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

                    <!-- Purchase create form -->
                    <form action="{{ route('purchase.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Dropdown for Supplier Name -->
                                <div class="form-group">
                                    <label for="supplier_id">Supplier Name</label>
                                    <div class="input-group">
                                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Button to open modal to add new supplier -->
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addSupplierModal">
                                                <font color="#fff">Add Supplier</font>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="company">Company Name</label>
                                    <input type="text" id="company" name="company" class="form-control" readonly>
                                </div>
                                <!-- Read-only fields for supplier details -->
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" readonly>
                                </div>                 

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <!-- Dropdown for Product Name -->
                                <div class="form-group">
                                    <label for="supplier_id">Products</label>
                                    <div class="input-group">
                                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                                            <option value="">Select Products</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Button to open modal to add new supplier -->
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addSupplierModal">
                                                <font color="#fff">Add Product</font>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" id="price" name="price" class="form-control" readonly>
                                </div>

                                <!-- Quantity input with increase and decrease buttons -->
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                                        </div>
                                        <input type="number" id="quantity" name="quantity" class="form-control" value="0" min="0" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="purchase">Purchase</label>
                                    <input type="text" id="purchase" name="purchase" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="sale">Sale</label>
                                    <input type="text" id="sale" name="sale" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="text" id="total" name="total" class="form-control" readonly>
                                </div>
                            </div>




                            <div class="col-md-5">
                            <label for="supplier_id">Purchase Info.</label>
                                <div class="form-group">
                                    <label for="name">Purchase ID</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                                <!-- Read-only fields for supplier details -->
                                <div class="form-group">
                                    <label for="phone">Product ID</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>                 
                                <div class="form-group">
                                    <label for="address">Price</label>
                                    <input type="text" id="address" name="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Quantity</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>                 

                                <div class="form-group">
                                    <label for="address">Total</label>
                                    <input type="text" id="address" name="address" class="form-control">
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Add Purchase</button>
                        <a href="{{ route('supplychain.index') }}" class="btn btn-secondary">Back</a>
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

    <!-- jQuery is needed for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // When supplier is selected, fetch details using AJAX
            $('#supplier_id').change(function () {
                var supplierId = $(this).val();
                if (supplierId) {
                    $.ajax({
                        url: '{{ route("purchase.getSupplierDetails", "") }}/' + supplierId,
                        type: 'GET',
                        success: function (response) {
                            if (response) {
                                // Update fields with supplier data
                                $('#phone').val(response.phone);
                                $('#name').val(response.name);
                                $('#address').val(response.address);
                                $('#company').val(response.company);
                            }
                        }
                    });
                } else {
                    // Reset fields if no supplier is selected
                    $('#phone').val('');
                    $('#name').val('');
                    $('#address').val('');
                    $('#company').val('');
                }
            });

            // Handle new supplier form submission
            $('#addSupplierForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("purchase.storeSupplier") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Show the success message in the middle of the page
                        $('#successMessage').fadeIn();

                        // Hide the success message after 3 seconds
                        setTimeout(function() {
                            $('#successMessage').fadeOut();
                        }, 3000);

                        // Reload the page to update the supplier list after the message disappears
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

        function increaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity() {
            let quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 0) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>
@endsection
