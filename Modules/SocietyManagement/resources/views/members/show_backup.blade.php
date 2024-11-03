@extends('backend.layout.layout')
@push('css')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #membershipCard, #membershipCard * {
            visibility: visible;
        }
        #membershipCard {
            position: absolute;
            left: 0;
            top: 0;
            border: 2px solid #6eb9e5 !important; /* Ensure border shows in print */
            box-shadow: none; /* Print-friendly shadow adjustment */
            padding: 20px;
            margin: auto;
        }
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{ route('society_members.index') }}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button class="btn btn-outline-success float-right mr-2" onclick="printCard()">
                        <i class="fas fa-print"></i> Print Membership Card
                    </button>
                </div>
                
                <div class="col-12">
                    <br>
                    <div class="card" id="membershipCard" style="max-width: 400px; margin: auto; padding: 20px; border: 2px solid #6eb9e5; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                        <div class="card-body text-center">
                            <img src="{{ asset('/backend/images/' . $member->member_image) }}"
                                 alt="No Preview"
                                 height="120px"
                                 width="120px"
                                 style="border: 2px solid #6eb9e5; border-radius: 50%; box-shadow: 0 0 0 3px #fff, 0 0 0 5px #6eb9e5;"
                                 onerror="this.onerror=null;this.src='{{ asset('/backend/images/avatar5.png') }}';">
                            <br><br>

                            <h4 class="text-muted">{{ $member->name }}</h4>
                            <p style="color: #0098ef; font-weight: bold;">Membership ID: {{ $member->id }}</p>

                            <div class="row text-left mt-4">
                                <div class="col-6">
                                    <label><strong>Membership Type:</strong></label>
                                    @if($member->membership_type == 1)
                                        <p style="color: #0098ef">Regular</p>
                                    @elseif($member->membership_type == 2)
                                        <p style="color: #0098ef">Premium</p>
                                    @else
                                        <p style="color: #0098ef">Honorary</p>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <label><strong>Joining Date:</strong></label>
                                    <p style="color: #0098ef">{{ $member->joining_date}}</p>
                                </div>
                                <div class="col-6">
                                    <label><strong>Expiry Date:</strong></label>
                                    <p style="color: #0098ef">{{ $member->expiration_date ? $member->expiration_date : 'N/A' }}</p>
                                </div>
                                <div class="col-6">
                                    <label><strong>Contact:</strong></label>
                                    <p style="color: #0098ef">{{ $member->contact_number }}</p>
                                </div>
                                <div class="col-12">
                                    <label><strong>Present Address:</strong></label>
                                    <p style="color: #0098ef">{{ $member->address }}</p>
                                </div>

                                <div class="col-12">
                                    <label><strong>Permanent Address:</strong></label>
                                    <p style="color: #0098ef">{{ $member->permanent_address }}</p>
                                </div>

                                <div class="col-12">
                                    <label><strong>Active Status:</strong></label>
                                    @if($member->active_status == 1)
                                    <p style="color: rgb(31, 233, 31)">Active</p>
                                    @else
                                    <p style="color: red">Inactive</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
</div>
@endsection

@push('masterScripts')
<script>
function printCard() {
        window.print();
    }
</script>
@endpush
