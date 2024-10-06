@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper"><br>
    <div style="background:#fff;border-radius:30px;padding:30px;">
        <div class="col-md-12 col-sm-12">
            <h3>Edit Client</h3><br>
            @if(Session::has('success_message'))
                <div class="alert alert-success">{{ Session::get('success_message') }}</div>
            @endif
            <form method="POST" action="{{ route('manufacturing.update', $client->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Client Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $client->city }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Client</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
    </div>
@endsection
