@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('fingerprint_portal')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Set Device IP</h3>
                  <br>
                  <div class="card">
                        <div class="card-body">

                            @php
                            if (function_exists('socket_create')) {
                                echo "Sockets extension is enabled.";
                            } else {
                                echo "Sockets extension is not enabled.";
                            }
                            @endphp

                            <form action="{{route('store_ip')}}" method="POST">
                                @csrf
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                   <div class="form-group">
                                        <label>Set Device IP</label>
                                        <input type="text" class="form-control" name="device_ip" id="device_ip" required>
                                    </div>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-success float-right">Submit</button>
                            </form>
                            @if(session('message'))
                                <p>{{ session('message') }}</p>
                            @endif
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

