@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper"><br>
        <div style="background:#fff;border-radius:30px;padding:30px;">
            <div class="col-md-12 col-sm-12">
                <h3>Edit Order</h3><br>
                @if(Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                @endif
                <form method="POST" action="{{ route('order.update', $order->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="client_id">Client ID</label>
                        <input type="text" class="form-control" id="client_id" name="client_id" value="{{ $order->client_id }}" required>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $order->product_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="unit_of_measure">Unit of Measure</label>
                        <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" value="{{ $order->unit_of_measure }}" required>
                    </div>

                    <div class="form-group">
                        <label for="purchase_unit_of_measure">Purchase Unit of Measure</label>
                        <input type="text" class="form-control" id="purchase_unit_of_measure" name="purchase_unit_of_measure" value="{{ $order->purchase_unit_of_measure }}" required>
                    </div>

                    <div class="form-group">
                        <label for="sales_price">Sales Price</label>
                        <input type="number" step="0.01" class="form-control" id="sales_price" name="sales_price" value="{{ $order->sales_price }}" required>
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="{{ $order->cost }}" required>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label for="delivery_date">Delivery Date</label>
                        <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ $order->delivery_date }}">
                    </div>

                    <div class="form-group">
                        <label for="internal_notes">Internal Notes</label>
                        <textarea class="form-control" id="internal_notes" name="internal_notes">{{ $order->internal_notes }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $order->barcode }}">
                    </div>

                    <div class="form-group">
                        <label for="sku_code">SKU Code</label>
                        <input type="text" class="form-control" id="sku_code" name="sku_code" value="{{ $order->sku_code }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Image URL</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{ $order->image }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Order</button>
                    <a href="{{ route('order.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
