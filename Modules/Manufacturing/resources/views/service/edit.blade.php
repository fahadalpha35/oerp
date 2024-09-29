@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper"><br>
        <div style="background:#fff;border-radius:30px;padding:30px;">
            <div class="col-md-12 col-sm-12">
                <h3>Edit Service</h3><br>
                @if(Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                @endif
                <form method="POST" action="{{ route('service.update', $service->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" value="{{ $service->unit }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $service->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                    <a href="{{ route('service.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
