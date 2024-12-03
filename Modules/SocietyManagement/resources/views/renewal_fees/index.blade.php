@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Renewal List</h3>
                    <div class="card">
                        <div class="card-body">
                        @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        @endif
                        @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong> {{ Session::get('success_message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                         @endif

                         <table id="exampleTableWithoutYajra" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renewalFees as $fee)
                                    <tr>
                                        <td>{{ $fee->name }}</td>
                                        <td>{{ $fee->email }}</td>
                                        <td>{{ $fee->contact_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($fee->due_date)->format('d-m-Y') }}</td>
                                        <td>{{ number_format($fee->amount, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $fee->status === 'Paid' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $fee->status }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $fee->payment_date ? \Carbon\Carbon::parse($fee->payment_date)->format('d-m-Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($fee->status === 'Unpaid')
                                                <form action="{{route('renewal_fees.store')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="renewal_fee_id" value="{{ $fee->id }}">
                                                    <button type="submit" class="btn btn-success btn-sm">Mark as Paid</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Paid</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('masterScripts')
<script>
$(document).ready(function() {
    var table = $('#exampleTableWithoutYajra').DataTable({
        responsive: true,
    });
});
</script>
@endpush

