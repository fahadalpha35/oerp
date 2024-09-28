{{-- @extends('layouts.app') --}}
@extends('backend.layout.layout')

@section('content')
<div class="main-panel"> 
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h2>Employee Details</h2>

                    <div class="col-12">
                        <a class="btn btn-outline-info float-right" href="{{route('employees.index')}}">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>  
                        <div class="card">
                            <div class="card-body">
                             
                               
                            </div>
                        </div>
                </div>
            </div>
        </div>
   
</div>
@endsection
