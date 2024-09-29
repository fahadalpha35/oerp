@extends('backend.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper"><br>
    <div style="background:#fff;border-radius:30px;padding:30px;">
        <div class="col-md-12 col-sm-12">
            <h3>Edit Client</h3><br>
            @if(Session::has('success_message'))
                <div class="alert alert-success">{{ Session::get('success_message') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form method="POST" action="{{ route('supplychain.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Supplier Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
                </div>
                <div class="form-group">
                    <label for="city">Area</label>
                    <input type="text" name="area" class="form-control" value="{{ $data->area }}" required>
                </div>
                <div class="form-group">
                    <label for="city">Company</label>
                    <input type="text" name="company" value="{{ $data->company }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="city">Address</label>
                    <input type="text" name="address" value="{{ $data->address }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Supplier</button>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
