@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Member Renewal Fees</h2>

    {{-- Success & Error Messages --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Table for Renewal Fees --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
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
@endsection