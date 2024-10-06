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
                          <th>Clinte Order Code</th>
                          <td> {{  ' # ' . $production->order->id . ' - ' . $production->order->client->name }} </td>
                        </tr>
                        <tr>
                          <th>Total Worker</th>
                          <td> {{ $production->worker }} </td>
                        </tr>
                        <tr>
                          <th>Production Duration</th>
                          <td> {{ $production->duration }} </td>
                        </tr>
                        <tr>
                          <th>Total Amount</th>
                          <td> {{ $production->total }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if (isset($production->production_cost))
            <div class="col-md-7">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th scope="col">Description</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($production->production_cost as $item)
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
