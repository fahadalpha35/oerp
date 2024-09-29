@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <h3 class="text-center">Edit Work Order</h3>
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

                    <form action="{{ route('workorder.update', $workOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="estimation_id">Estimation</label>
                            <select name="estimation_id" id="estimation_id" class="form-control" required>
                                @foreach($estimations as $estimation)
                                    <option value="{{ $estimation->id }}" {{ $workOrder->estimation_id == $estimation->id ? 'selected' : '' }}>
                                        {{ $estimation->estimation_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assign_manager">Assign Manager</label>
                            <input type="text" class="form-control" name="assign_manager" id="assign_manager" value="{{ $workOrder->assign_manager }}" required>
                        </div>

                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="text" class="form-control" name="priority" id="priority" value="{{ $workOrder->priority }}" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" name="notes" id="notes">{{ $workOrder->notes }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="preferred_date">Preferred Date</label>
                            <input type="date" class="form-control" name="preferred_date" id="preferred_date" value="{{ $workOrder->preferred_date }}" required>
                        </div>

                        <div class="form-group">
                            <label for="preference_note">Preference Note</label>
                            <textarea class="form-control" name="preference_note" id="preference_note">{{ $workOrder->preference_note }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Work Order</button>
                        <a href="{{ route('workorder.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
