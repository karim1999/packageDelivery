@extends('layouts.dashboard')
@section('title', 'Home')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-lg">
                    @foreach($states as $state)
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            @include('dashboard.partials.card_widget', $state)
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-lg">
                    @foreach($packagesStates as $state)
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            @include('dashboard.partials.card_widget', $state)
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--End::Dashboard 1-->
    </div>

@endsection
@push('scripts')
    <script src="{{asset('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
@endpush
