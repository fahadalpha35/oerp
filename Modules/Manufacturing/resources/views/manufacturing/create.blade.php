@extends('backend.layout.layout')

@section('content') 
<div class="main-panel">
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add New Client</h3>
                    <form action="{{ route('manufacturing.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Client Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Client</button>
                        <a href="{{ route('manufacturing.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('backend.layout.footer')
</div>
@endsection
