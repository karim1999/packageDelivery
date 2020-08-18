@extends('layouts.dashboard')
@section('title', 'New Address')
@push('header')
@endpush
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label"><span class="kt-portlet__head-icon"><i
                            class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        New Address
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit" id="addressForm">
                <form class="form" method="post"
                      action="{{isset($address->id) ? route('dashboard.address.update', $address->id) : route('dashboard.address.store')}}">
                    @isset($address->id)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group form-group-marginless">
                            <label>Choose Address Type:</label>
                            <type-input name="type" @set-value="setValue" default="{{old('type') ? old('type') : ($address->type ? $address->type : "Manual") }}" :options='@json($addressTypes)'></type-input>
                        </div>
                        <div class="separator separator-dashed my-5"></div>

                        <div v-if="value == 'Manual'" class="form-group form-group-marginless">
                            <div class="form-group">
                                <label>Country: </label>
                                <select required id="countrySelect" name="country" class="form-control @error('country') is-invalid @enderror">
                                    <option disabled value="">Please select a Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{old('country') == $country->id || ($address->country_id == $country->id) ? "selected": ""}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>State: </label>
                                <select required id="stateSelect" name="state" class="form-control @error('state') is-invalid @enderror">
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}" {{old('state') == $state->id || ($address->state_id == $state->id) ? "selected": ""}}>{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="separator separator-dashed my-5"></div>

                            <div class="form-group">
                                <label>City:</label>
                                <input required type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                       value="{{ old('city', $address->city) }}" placeholder="Enter city"/>
                                @error('city')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="separator separator-dashed my-5"></div>

                            <div class="form-group">
                                <label>Address:</label>
                                <input required type="text" class="form-control @error('address') is-invalid @enderror"
                                       name="address" value="{{ old('address', $address->street) }}" placeholder="Enter address"/>
                                @error('address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="separator separator-dashed my-5"></div>

                            <div class="form-group">
                                <label>Postal Code:</label>
                                <input required type="text" pattern="[0-9]{5}" class="form-control @error('postal_code') is-invalid @enderror"
                                       name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" placeholder="Enter postal code"/>
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="separator separator-dashed my-5"></div>
                        </div>
                        <div v-else class="form-group form-group-marginless">
                            <div class="form-group">
                                <label>Name:</label>
                                <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', $address->name) }}" placeholder="Enter a name for this address"/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="separator separator-dashed my-5"></div>

                            <gmap-map :center="center" :zoom="7" style="width: 100%; height: 500px">
                                <gmap-marker :position="position" :clickable="true" :draggable="true" @dragend="gMapFunc($event.latLng)"></gmap-marker>
                            </gmap-map>
                            <input id="latitudeInput" type="hidden" required style="display: none" name="latitude" v-model="position.lat" value="{{ old('latitude', $address->latitude) }}">
                            <input id="longitudeInput" type="hidden" required style="display: none" name="longitude" v-model="position.lng" value="{{ old('longitude', $address->longitude) }}">
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{route('dashboard.address.index')}}">
                            <button type="button" class="btn btn-secondary">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/addressForm.js')}}"></script>
    @if ($address->latitude)
        <script>
            window.onload = function() {
                {{--var latitudeInput= document.getElementById("latitudeInput").value= {{$address->latitude}}--}}
                {{--var longitudeInput= document.getElementById("longitudeInput").value= {{$address->longitude}}--}}
            };

        </script>
    @endif
    <script>
        var states= @json($states, JSON_PRETTY_PRINT);
        var countrySelect= document.getElementById("countrySelect")
        countrySelect.onchange = function () {
            var countrySelectValue= countrySelect.value
            var stateSelect= document.getElementById("stateSelect")
            stateSelect.innerHTML= ""
            for (var i= 0; i < states.length; i++) {
                if(states[i].country_id == countrySelectValue){
                    var opt = document.createElement('option');
                    opt.value = states[i].id;
                    opt.innerHTML = states[i].name;
                    stateSelect.appendChild(opt);
                }
            }
        }
    </script>
@endpush
