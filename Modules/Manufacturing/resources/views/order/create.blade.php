@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add New Order</h3>
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

                        <div class="form-group">
                            <label for="client_id">Client ID</label>
                            <input type="text" class="form-control" name="client_id" required>
                        </div>

                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" name="product_name" required>
                        </div>

                        <div class="form-group">
                            <label for="internal_notes">Internal Notes</label>
                            <textarea class="form-control" name="internal_notes"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="unit_of_measure">Unit of Measure</label>
                            <input type="text" class="form-control" name="unit_of_measure" required>
                        </div>

                        <div class="form-group">
                            <label for="purchase_unit_of_measure">Purchase Unit of Measure</label>
                            <input type="text" class="form-control" name="purchase_unit_of_measure" required>
                        </div>

                        <div class="form-group">
                            <label for="sales_price">Sales Price</label>
                            <input type="number" step="0.01" class="form-control" name="sales_price" required>
                        </div>

                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="number" step="0.01" class="form-control" name="cost" required>
                        </div>

                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" class="form-control" name="barcode">
                        </div>

                        <div class="form-group">
                            <label for="sku_code">SKU Code</label>
                            <input type="text" class="form-control" name="sku_code">
                        </div>

                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="text" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label for="delivery_date">Delivery Date</label>
                            <input type="date" class="form-control" name="delivery_date" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
