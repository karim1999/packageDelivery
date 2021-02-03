
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwIR9B2kY2dJyHX_IfqC7f9S93Oj0e1iI&callback=initMap&libraries=&v=weekly"
  defer
></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/kanban/kanban.bundle.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 75vh;
        width: 100%
            }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background-color:#1e1f2d;
      }
    </style>


      <body id="app">
        <div class="container-fluid ">
          <!-- header -->
          <div class="row" style="background:#1a1b27">
            <h2 style="color:#fff">Backage Delivery</h2>
          </div>
          <div class="row">

            <!-- left side -->
            <div class="col-sm-2 " style="margin-top:20px">

              <div style="background:#1a1b27;width:100%;padding:5px;text-align:center;border-radius:5px" >
              <h3 style="color:#fff">Packages</h3>
            </div>
              <nav style="margin-top:5px">
                <div class="nav nav-pills d-flex justify-content-center" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-Waiting-tab" data-toggle="tab" href="#nav-Waiting" role="tab" aria-controls="nav-Waiting" aria-selected="true">Waiting</a>
                  <a class="nav-item nav-link" id="nav-Approved-tab" data-toggle="tab" href="#nav-Approved" role="tab" aria-controls="nav-Approved" aria-selected="false">Approved</a>
                  <a class="nav-item nav-link" id="nav-Rejected-tab" data-toggle="tab" href="#nav-Rejected" role="tab" aria-controls="nav-Rejected" aria-selected="false">Rejected</a>
                  <a class="nav-item nav-link" id="nav-Delivering-tab" data-toggle="tab" href="#nav-Delivering" role="tab" aria-controls="nav-Delivering" aria-selected="false">Delivering</a>
                  <a class="nav-item nav-link" id="nav-Delivered-tab" data-toggle="tab" href="#nav-Delivered" role="tab" aria-controls="nav-Delivered" aria-selected="false">Delivered</a>


                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-Waiting" role="tabpanel" aria-labelledby="nav-Waiting-tab">
                  <div class="list-group" v-for="package in packages">
                    <button type="button"  v-if= "package.status == 'Waiting'" class="list-group-item list-group-item-action ">@{{package.name}}</button>
                  </div>

                  </div>
                <div class="tab-pane fade" id="nav-Approved" role="tabpanel" aria-labelledby="nav-Approved-tab">
                  <div class="list-group" v-for="package in packages">
                    <button type="button"  v-if= "package.status == 'Approved'" class="list-group-item list-group-item-action ">@{{package.name}}</button>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-Rejected" role="tabpanel" aria-labelledby="nav-Rejected-tab">
                  <div class="list-group" v-for="package in packages">
                    <button type="button"  v-if= "package.status == 'Rejected'" class="list-group-item list-group-item-action ">@{{package.name}}</button>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-Delivering" role="tabpanel" aria-labelledby="nav-Delivering-tab">
                  <div class="list-group" v-for="package in packages">
                    <button type="button"  v-if= "package.status == 'Delivering'" class="list-group-item list-group-item-action ">@{{package.name}}</button>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-Delivered" role="tabpanel" aria-labelledby="nav-Delivered-tab">
                  <div class="list-group" v-for="package in packages">
                    <button type="button"  v-if= "package.status == 'Delivered'" class="list-group-item list-group-item-action ">@{{package.name}}</button>
                  </div>
                </div>
                <div class="list-group">

                  <button type="button" class="list-group-item list-group-item-action ">Add Package</button>
                </div>
              </div>
            </div>

            <!-- comtainer map -->

            <div class="col-sm-8">
            <div id="map"  ></div>
              <!-- footer -->
              <div style="margin-top:10px" >
                <div id="kanban2"></div>
                <div style="display:none" id="kanban1"></div>

              </div>
            </div>

            <!-- righ side -->
            <div class="col-sm-2"  style="margin-top:20px">
              <div style="background:#1a1b27;width:100%;padding:5px;text-align:center;border-radius:5px" >
              <h3 style="color:#fff">Drivers</h3>
              </div>
              <nav style="margin-top:5px">
                <div class="nav nav-pills d-flex justify-content-center" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-Online-tab" data-toggle="tab" href="#nav-Online" role="tab" aria-controls="nav-Online" aria-selected="false">Online</a>
                  <a class="nav-item nav-link" id="nav-Offline-tab" data-toggle="tab" href="#nav-Offline" role="tab" aria-controls="nav-Offline" aria-selected="false">Offline</a>
                  <a class="nav-item nav-link" id="nav-Busy-tab" data-toggle="tab" href="#nav-Busy" role="tab" aria-controls="nav-Busy" aria-selected="false">Busy</a>


                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-Online" role="tabpanel" aria-labelledby="nav-Online-tab">
                  <div class="list-group" v-for="driver in drivers">
                    <button type="button"  v-if= "driver.status == 'Online'" class="list-group-item list-group-item-action ">@{{driver.name}}</button>
                  </div>


                  </div>
                <div class="tab-pane fade" id="nav-Offline" role="tabpanel" aria-labelledby="nav-Offline-tab">
                  <div class="list-group" v-for="driver in drivers">
                    <button type="button"  v-if= "driver.status == 'Offline'" class="list-group-item list-group-item-action ">@{{driver.name}}</button>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-Busy" role="tabpanel" aria-labelledby="nav-Busy-tab">
                  <div class="list-group" v-for="driver in drivers">
                    <button type="button"  v-if= "driver.status == 'Busy'" class="list-group-item list-group-item-action ">@{{driver.name}}</button>
                  </div>
                </div>
                <button type="button" class="list-group-item list-group-item-action ">Add Driver</button>


              </div>

            </div>
          </div>
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.js"></script>




        </div>


      </body>
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
markers = [];
infowindow = [];
var  initMap = ()=> {
       // The location of Uluru
       const uluru = { lat: -25.344, lng: 131.036 };
       // The map, centered at Uluru
       const map = new google.maps.Map(document.getElementById("map"), {
         zoom: 4,
         center: uluru,
         mapId: '425572bfa39a1bb5'

       });
       // The marker, positioned at Uluru
       app.drivers.map((driver)=>{
         markers[driver.id] = new google.maps.Marker({
          position:  { lat: parseInt(driver.lat), lng:parseInt(driver.long) },
          map: map,
        });
         infowindow[driver.id] = new google.maps.InfoWindow({
          content: "<h3>"+driver.name+"</h3>"
        });
        google.maps.event.addListener(markers[driver.id], 'click', function() {
            infowindow[driver.id].open(map,markers[driver.id]);
        });
       });

     }

     var pusher = new Pusher('cd684f435e5228ec1605', {
     cluster: 'us2'
   });

   var channel = pusher.subscribe('drivers');
   channel.bind('update', function(data) {
     // console.log(data);
     app.updateDriver(data)
     // app.messages.push(JSON.stringify(data));
   });


     const app = new Vue({
         el: '#app',

         data() {
           return {
             packages: {!! json_encode($packages->get()) !!},
             messages: [{id:1,name:'sss'},{id:1,name:'sss'}],
             drivers:{!! json_encode($drivers->get()) !!}
           }
         },

         created() {

         },

         methods: {
             updateDriver(data) {
               markers[data.id].setPosition({lat:parseInt(data.lat),lng:parseInt(data.long)});

               let obj = this.drivers.find(f=>f.id==data.id);
                if(obj){
                  obj.name =data.name;
                  obj.id = data.id;
                  obj.status= data.status;
                  obj.lat = data.lat;
                  obj.long = data.long;
                }
                // console.log(this.drivers);
                },


             addMessage(message) {
                 axios.post('/messages', {
                     message
                 }).then(response => {
                     this.messages.push({
                         message: response.data.message.message,
                         user: response.data.user
                     });
                 });
             },

             sendMessage() {
                 this.addMessage(this.newMessage);
                 this.newMessage = '';
             }
         }
     });


</script>
