@extends('layouts.dashboard')

@section('title', 'Drivers')
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
                        Drivers
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{route('dashboard.driver.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Driver
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
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drivers as $driver)
                        <tr>
                            <th>{{$driver->id}}</th>
                            <th>{{$driver->name}}</th>
                            <th>{{$driver->email}}</th>
                            <th>{{$driver->status}}</th>
                            <th>{{$driver->created_at}}</th>
                            <th>
                                <a href="{{route('dashboard.driver.edit', $driver->id)}}" class="btn btn-sm btn-icon btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a onclick="event.preventDefault();
                                                     document.getElementById('driver-delete-'{{$driver->id}}).submit();"href="{{route('dashboard.driver.destroy', $driver->id)}}" class="btn btn-sm btn-icon btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                                <form id="driver-delete-{{$driver->id}}" action="{{route('dashboard.driver.destroy', $driver->id)}}" method="POST" style="display: none;">
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
