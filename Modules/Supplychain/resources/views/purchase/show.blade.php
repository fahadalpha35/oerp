@extends('backend.layout.layout')

@section('content')
<div class="content-wrapper">
<a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back</a>
    <div style="background-color: #fff; border-radius: 20px;">
        <div class="mt-5 ml-4 row" style="padding: 25px;">
            <div class="col-md-5">
                <h3 class="mb-4">Production Order Details </h3>
            </div>
            <div class="col-md-7">
                <h3 class="mb-4">Production Cost Calculation</h3>
            </div>
            <div class="col-md-5">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <th>Purchase Invoice No </th>
                          <td> {{  ' # ' . $purchase->invoice_no}} </td>
                        </tr>
                        <tr>
                          <th>Purchase Date</th>
                          <td> {{ $purchase->purchase_date }} </td>
                        </tr>
                        <tr>
                          <th>Sub Total</th>
                          <td> {{ $purchase->sub_total }} </td>
                        </tr>
                        @if ($purchase->delivary_cost)
                        <tr>
                          <th>Total Amount</th>
                          <td> {{ $purchase->delivary_cost }} </td>
                        </tr>
                        @endif
                        <tr>
                          <th>Total Amount</th>
                          <td> {{ $purchase->total }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if (isset($purchase->purchase_info))
            <div class="col-md-7">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th scope="col">Sale Price</th>
                          <th scope="col">Purchase Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($purchase->purchase_info as $item)
                            <tr>
                              <td>{{$item->sale_price}}</td>
                              <td>{{$item->purchase_price}}</td>
                              <td>{{$item->quantity}}</td>
                              <td>{{$item->total}}</td>
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
