@extends('backend.layout.layout')
@section('content')

<style>
.content-wrapper1 {
    padding-top: 0;
    min-height: calc(100vh - 75px);
}
.content-wrapper1 {
    background: #F5F7FF;
    width: 100%;
    /* padding: 2.375rem 2.375rem; */
    -webkit-flex-grow: 1;
    flex-grow: 1;
}
@media (max-width: 767px) {
    .content-wrapper1 {
        padding: 1.5rem 1.5rem;
    }
}
</style>

<div class="main-panel">
    <div class="content-wrapper1">
        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5" style="padding: 25px;">
            Test
            </div>
        </div>
    </div>
    @include('backend.layout.footer')
</div>

<script>

</script>

@endsection
