@extends('layouts.dashboard')

@section('title', 'Kanban')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="row">
    <div class="col">
      <div class="alert alert-light alert-elevate fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
          Kanban JavaScript UI widget for web developers
          <br>
          For more info please visit the plugin's <a class="kt-link kt-font-bold" href="http://www.riccardotartaglia.it/jkanban/" target="_blank">Demo Page</a> or <a class="kt-link kt-font-bold" href="https://github.com/riktar/jkanban" target="_blank">GitHub</a>.
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Custom Colors Demo
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div id="kanban2"></div>
        </div>
      </div>
    </div>
  </div>

          <div style="display:none" id="kanban1"></div>

</div>

<script>
  var KTAppOptions = {
    "colors": {
      "state": {
        "brand": "#5d78ff",
        "dark": "#282a3c",
        "light": "#ffffff",
        "primary": "#5867dd",
        "success": "#34bfa3",
        "info": "#36a3f7",
        "warning": "#ffb822",
        "danger": "#fd3995"
      },
      "base": {
        "label": [
          "#c5cbe3",
          "#a1a8c3",
          "#3d4465",
          "#3e4466"
        ],
        "shape": [
          "#f0f3ff",
          "#d9dffa",
          "#afb4d4",
          "#646c9a"
        ]
      }
    }
  };
</script>
@endsection

@push('scripts')
<script src="{{asset('assets/plugins/kanban/kanban.bundle.js')}}" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
var kanban2 = new jKanban({
  element : '#kanban2',
  gutter  : '0',
  dropEl: function(el, target, source, sibling){
          var status = target.parentElement.getAttribute('data-id');
          var package_id = el.dataset.eid;
          $.get("/dashboard/change_status",{status,package_id}, function(data, status){
    });
        },
  click : function(el){
    alert(el.innerHTML);
  },
  boards  :[
    {
      'id' : 'Waiting',
      'title'  : 'Waiting',
      'class' : 'brand',
      'item'  : [
        @foreach($packages->get() as $package)
          @if($package->status == 'Waiting')
        {
          id:'{{$package->id}}',
          'title':'{{$package->name}} => {{$package->drivers[0]->name}}',
          'class': 'info',

        },
        @endif
        @endforeach

      ]
    },
    {
      'id' : 'Approved',
      'title'  : 'Approved',
      'class' : 'success',
      'item'  : [
        @foreach($packages->get() as $package)
          @if($package->status == 'Approved')
        {
          id:'{{$package->id}}',
          'title':'{{$package->name}} => {{$package->drivers[0]->name}}',
          'class': 'success',

        },
        @endif
        @endforeach

      ]
    },
    {
      'id' : 'Rejected',
      'title'  : 'Rejected',
      'class' : 'danger',
      'item'  : [
        @foreach($packages->get() as $package)
          @if($package->status == 'Rejected')
        {
          id:'{{$package->id}}',
          'title':'{{$package->name}} => {{$package->drivers[0]->name}}',
          'class': 'danger',

        },
        @endif
        @endforeach

      ]
    },
    {
      'id' : 'Delivering',
      'title'  : 'Delivering',
      'class' : 'warning',
      'item'  : [
        @foreach($packages->get() as $package)
          @if($package->status == 'Delivering')
        {
          id:'{{$package->id}}',
          'title':'{{$package->name}} => {{$package->drivers[0]->name}}',
          'class': 'warning',

        },
        @endif
        @endforeach

      ]
    },
    {
      'id' : 'Delivered',
      'title'  : 'Delivered',
      'class' : 'success',
      'item'  : [
        @foreach($packages->get() as $package)
          @if($package->status == 'Delivered')
        {
          id:'{{$package->id}}',
          'title':'{{$package->name}} => {{$package->drivers[0]->name}}',
          'class': 'warning',

        },
        @endif
        @endforeach

      ]
    }

  ]
});
</script>
<script src="{{asset('assets/js/kanban-board.js')}}" type="text/javascript"></script>

@endpush
