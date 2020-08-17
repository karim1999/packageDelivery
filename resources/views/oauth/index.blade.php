@extends('layouts.app')

@section('content')
    <div class="container" id="auth">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <passport-clients></passport-clients>
            </div>
            <div class="col-md-8" style="margin-top: 20px">
                <passport-authorized-clients></passport-authorized-clients>
            </div>
            <div class="col-md-8" style="margin-top: 20px">
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endpush
