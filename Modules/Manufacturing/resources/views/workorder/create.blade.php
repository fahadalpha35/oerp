@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add New Work Order</h3>
                    <form action="{{ route('workorder.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="estimation_id">Estimation</label>
                            <select name="estimation_id" class="form-control" required>
                                <option value="">Select Estimation</option>
                                @foreach($estimations as $estimation)
                                    <option value="{{ $estimation->id }}">{{ $estimation->estimation_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assign_manager">Assign Manager</label>
                            <input type="text" class="form-control" name="assign_manager" placeholder="Manager's Name" required>
                        </div>

                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="text" class="form-control" name="priority" placeholder="Priority" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" name="notes" placeholder="Additional notes"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="preferred_date">Preferred Date</label>
                            <input type="date" class="form-control" name="preferred_date">
                        </div>

                        <div class="form-group">
                            <label for="preference_note">Preference Note</label>
                            <textarea class="form-control" name="preference_note" placeholder="Preference note"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Work Order</button>
                        <a href="{{ route('workorder.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
