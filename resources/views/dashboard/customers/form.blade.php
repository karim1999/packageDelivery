@extends('layouts.dashboard')
@section('title', 'New Package')
@push('header')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label"><span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        New Driver
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/custom/wizard/wizard-1.js')}}" type="text/javascript"></script>
@endpush
