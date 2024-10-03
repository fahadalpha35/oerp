@extends('backend.layout.layout')

@section('content')
<div class="content-wrapper">
    <div style="background-color: #fff; border-radius: 20px;">
        <div class="mt-5 ml-4 row" style="padding: 25px;">
            <div class="col-md-5">
                <h3 class="mb-4">Work Order Details </h3>
            </div>
            <div class="col-md-7">
                <h3 class="mb-4">Cost Calculation</h3>
            </div>
            <div class="col-md-5">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <th>Product Name </th>
                          <td>{{ $data->product->name }}</td>
                        </tr>
                        <tr>
                          <th>Client Name</th>
                          <td> {{ $data->client->name }} </td>
                        </tr>
                        <tr>
                          <th>Quantity</th>
                          <td> {{ $data->quantity }} </td>
                        </tr>
                        <tr>
                          <th>Total Amount</th>
                          <td> {{ $data->total }} </td>
                        </tr>
                        <tr>
                          <th>Delivery Date</th>
                          <td> {{ $data->delivery_date }} </td>
                        </tr>
                        <tr>
                          <th>Internal Notes</th>
                          <td> {{ $data->internal_notes }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if (isset($data->order_cost))
            <div class="col-md-7">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th scope="col">Description</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data->order_cost as $item)
                            <tr>
                              <td>{{$item->name}}</td>
                              <td>{{$item->amount}}</td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
