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
                        New Package
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit" id="packageForm">
                <div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v1__nav">

                            <!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                            <div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step"  data-ktwizard-state="current">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-list"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            1. Package Details
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-bus-stop"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            2. Package Recived from customer
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-truck"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            3. Delivery customer
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-responsive"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            4. Select Driver
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Nav -->
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

                        <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="kt_form" method="post" action="{{isset($package->id) ? route('dashboard.package.update', $package->id) : route('dashboard.package.store')}}">
                        @isset($package->id)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endisset
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Enter the Details of your Package</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="form-group">
                                            <label>Package Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $package->name) }}" name="name" placeholder="Package Name">
                                            <span class="form-text text-muted">Please enter your Pakcage Name.</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Package Details</label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $package->description) }}" name="description" placeholder="Package Details">
                                            <span class="form-text text-muted">Please enter your Pakcage Details.</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Package Weight in KG</label>
                                            <input type="number" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $package->weight) }}" name="weight" placeholder="Package Weight">
                                            <span class="form-text text-muted">Please enter your Package Weight in KG.</span>
                                        </div>
                                        <div class="kt-wizard-v1__form-label">Package Dimensions</div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>Package Width in CM</label>
                                                    <input type="number" class="form-control @error('width') is-invalid @enderror" value="{{ old('width', $package->width) }}" name="width" placeholder="Package Width">
                                                    <span class="form-text text-muted">Please enter your Package Width in CM.</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>Package Height in CM</label>
                                                    <input type="number" class="form-control @error('height') is-invalid @enderror" value="{{ old('height', $package->height) }}" name="height" placeholder="Package height">
                                                    <span class="form-text text-muted">Please enter your Package Height in CM.</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>Package Length in CM</label>
                                                    <input type="number" class="form-control @error('length') is-invalid @enderror" value="{{ old('length', $package->length) }}" name="length" placeholder="Package Length">
                                                    <span class="form-text text-muted">Please enter your Package Length in CM.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">Select a customer to recieve package from  </div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">

                                        <div class="separator separator-dashed my-5"></div>


                                        <div v-if="how_from == 'List'" class="form-group form-group-marginless">
                                            <div class="form-group">
                                                <label>Customer: </label>
                                                <select required name="customer_id_from" class="form-control @error('address_id_from') is-invalid @enderror">
                                                    <option disabled value="">Please select a customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}" {{old('customer_from') == $customer->id || ($package->customer_from == $customer->id) ? "selected": ""}}>{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('address_id_from')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 2-->

                            <!--begin: Form Wizard Step 3-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Setup Your Delivery Customer</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">

                                        <div class="separator separator-dashed my-5"></div>


                                        <div v-if="how_to == 'List'" class="form-group form-group-marginless">
                                            <div class="form-group">
                                                <label>Customer: </label>
                                                <select required name="customer_id_to" class="form-control @error('customer_id_to') is-invalid @enderror">
                                                    <option disabled value="">Please select a Customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}" {{old('customer_to') == $customer->id || ($package->customer_to == $customer->id) ? "selected": ""}}>{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id_to')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 3-->

                            <!--begin: Form Wizard Step 4-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Select your Services</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="form-group">
                                            <label>Driver: </label>
                                            <select required name="driver" class="form-control @error('driver') is-invalid @enderror">
                                                <option disabled value="">Please select a driver</option>
                                                @foreach($drivers as $diver)
                                                    <option value="{{$diver->id}}" {{old('driver') == $diver->id || ($package->driver_id == $diver->id) ? "selected": ""}}>{{$diver->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('driver')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 4-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                    Previous
                                </button>
                                <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                    Submit
                                </button>
                                <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                    Next Step
                                </button>
                            </div>

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('js/app.js')}}"></script>
{{--    <script src="{{asset('assets/js/pages/custom/wizard/wizard-1.js')}}" type="text/javascript"></script>--}}
    <script src="{{asset('js/packageForm.js')}}"></script>
    <script>
        wizard = new KTWizard('kt_wizard_v1', {
            startStep: 1, // initial active step number
            clickableSteps: true,  // allow step clicking
        });
    </script>
@endpush
