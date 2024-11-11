@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Update Item category</h3>
                    <form action="{{ route('item.update',$item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Item Name</label>
                                    <input type="text" class="form-control" value="{{ $item->name }}" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="active_status">Status</label>
                                    <select class="form-control" name="active_status" required>
                                        <option value="1" @if ($item->active_status == 1) selected @endif>Active</option>
                                        <option value="0" @if ($item->active_status == 0) selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Item</button>
                        <a href="{{ route('item.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
