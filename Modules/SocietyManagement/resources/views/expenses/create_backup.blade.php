@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('society_expenses.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Expense</h3>
                  <br>
                  <div class="card">
                        <div class="card-body">
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
                            <form action="{{route('society_expenses.store')}}" method="POST">
                                @csrf
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Expense Type <small style="color: red">*</small></label>
                                        <select required  class="form-control select2" id="expense_type_id" name="expense_type_id" style="width: 100%;">
                                         @foreach($society_expense_types as $society_expense_type)
                                          <option value="{{$society_expense_type->id}}">{{$society_expense_type->type_name}}</option>
                                          @endforeach
                                      </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expense Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Expense Name" required id="expense_name" name="expense_name" value="{{old('type_name')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expense Date <small style="color: red">*</small></label>
                                        <input type="date" required id="expense_date" name="expense_date" value="{{old('expense_date')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Description </label>
                                        <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expense Amount (BDT) <small style="color: red">*</small></label>
                                        <input type="number" step="0.01" required id="expense_amount" name="expense_amount" value="{{old('expense_amount')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                              </div>
                              <button type="submit" class="btn btn-success float-right">Submit</button>
                            </form>
                        </div>
                      <!-- /.card-body -->
                    </div>
              </div>
          </div>
          <br>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    </div>
@endsection


@push('masterScripts')
<script>
$.noConflict(); // Ensures jQuery does not conflict with other libraries
jQuery(document).ready(function($) {
    $('.select2').select2();
})
</script>
@endpush
