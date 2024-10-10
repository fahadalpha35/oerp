@extends('backend.layout.layout')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div style="width: 100%; background-color: #fff;border-radius: 20px;">    
          
          <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('payrolls.create') }}" class="btn btn-success btn-sm"> Add Payroll</a>  
            <div class="col-md-12 col-xl-12 col-sm-12">
              <h3 class="mt-2 text-center">Payroll List</h3>

              <div class="card">
                  <div class="card-body">
                    @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get('error_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success: </strong> {{ Session::get('success_message')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            @endif
                    <table id="payroll_table" class="table table-bordered table-hover">
                      <thead class="thead-dark">
                      <tr>
                        <th>Serial No.</th>                        
                        <th>Employee Name</th>
                        <th>Salary Date</th>
                        <th>Paid Salary Amount (BDT)</th>
                        <th>Action</th>                         
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
          </div> 
          </div>
     
               
        </div>       
        <br>      
     
    </div>
    <!-- /.content-header -->
  </div>

@endsection

@push('masterScripts')
<script>
  this.loadDataTable('payroll_table', '{{ route('payrolls.index') }}',
          [
              { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
              { data: 'member_name', name: 'member_name'},
              { data: 'salary_date', name: 'salary_date' },
              { data: 'net_pay', name: 'net_pay'},
              { data: 'action', name: 'action', orderable: false, searchable: false }
          ],
  );
  </script>
  @endpush