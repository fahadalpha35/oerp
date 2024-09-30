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
                            <div class="col-md-3">
                                <!-- Dropdown for Supplier Name -->
                                <div class="form-group">
                                    <label for="supplier_id">Supplier Name</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#addSupplierModal">Add New Supplier</button>
                                </div>

                                <!-- Read-only fields for supplier details -->
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" id="company" name="company" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
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
                            <input type="text" id="supplier_area" name="area" class="form-control">
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
                                $('#email').val(response.email);
                                $('#company').val(response.company);
                                $('#address').val(response.address);
                            }
                        }
                    });
                } else {
                    // Reset fields if no supplier is selected
                    $('#phone').val('');
                    $('#email').val('');
                    $('#company').val('');
                    $('#address').val('');
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
                        alert(response.success);
                        $('#addSupplierModal').modal('hide');
                        location.reload(); // Reload the page to update supplier list
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        alert(errors.name ? errors.name[0] : 'An error occurred');
                    }
                });
            });
        });
    </script>
@endsection
