@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Add category</h3>
                    <form action="{{ route('category.update',$category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="active_status">Item Category</label>
                                    <select class="form-control" name="item_id" required>
                                        <option value="">Select Item category</option>
                                        @foreach ($item as $data)
                                            <option value="{{$data->id}}" @if ($data->id == $category->item_id) selected @endif  >{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" value="{{$category->name}}" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="1" @if ($category->status == 1) selected @endif >Active</option>
                                        <option value="0" @if ($category->status == 0) selected @endif >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">update Category</button>
                        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
