@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <h3 class="text-center">Add New Estimation</h3>
                <div class="col-md-12">
                    @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('estimation.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="order_id">Order ID</label>
                            <select name="order_id" id="order_id" class="form-control">
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->id }} - {{ $order->product_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estimation_number">Estimation Number</label>
                            <input type="text" class="form-control" name="estimation_number" id="estimation_number" placeholder="Enter estimation number" required>
                        </div>

                        <div class="form-group">
                            <label for="estimation_date">Estimation Date</label>
                            <input type="date" class="form-control" name="estimation_date" id="estimation_date" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Estimation</button>
                        <a href="{{ route('estimation.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
