@extends('layouts.dashboard')

@section('title', 'Customers')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label"><span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        Customers
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{route('dashboard.customer.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Customer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <th>{{$customer->id}}</th>
                            <th>{{$customer->name}}</th>
                            <th>{{$customer->email}}</th>
                            <th>{{$customer->phone}}</th>
                            @if ($customer->address->type == "Manual")
                                <th>{{$customer->address->address_format}}</th>
                            @else
                                <th>
                                    <a target="_blank" href="http://www.google.com/maps/place/{{$customer->address->latitude}},{{$customer->address->longitude}}">
                                        {{$customer->address->address_format}}
                                    </a>
                                </th>
                            @endif
                            <th>{{$customer->created_at}}</th>
                            <th>
                                <a href="{{route('dashboard.customer.edit', $customer->id)}}" class="btn btn-sm btn-icon btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a onclick="event.preventDefault();
                                                     document.getElementById('customer-delete-{{$customer->id}}').submit();"href="{{route('dashboard.customer.destroy', $customer->id)}}" class="btn btn-sm btn-icon btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                                <form id="customer-delete-{{$customer->id}}" action="{{route('dashboard.customer.destroy', $customer->id)}}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

@endsection

@push('scripts')
@endpush
