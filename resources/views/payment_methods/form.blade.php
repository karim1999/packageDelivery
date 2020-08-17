@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="stripeForm">
                    <loading :active.sync="isLoading"
                             :can-cancel="false"
                             :is-full-page="false"></loading>
                    <div class="card-header">New Payment Method</div>

                    <div class="card-body">
                        <div v-if="error"  class="alert alert-danger" role="alert">
                            @{{ error }}
                        </div>
                        <div v-else-if="msg" class="alert alert-success" role="alert">
                            @{{ msg }}
                        </div>
                        <input ref="clientSecret" type="hidden" style="display: none" value="{{ $intent->client_secret }}">
                        <div class="form-group">
                            <input v-model="name" placeholder="Card holder name" id="card-holder-name" name="name" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element" class="form-control"></div>
                        </div>
                        <button class="btn btn-primary" id="card-button" @click="submitPaymentMethod">
                            Update Payment Method
                        </button>
                        <a href="{{route('payment_methods.index')}}" ref="paymentMethodsUrl" style="display: none">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/payment_method.js') }}" defer></script>
@endpush
