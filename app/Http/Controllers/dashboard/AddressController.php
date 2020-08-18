<?php

namespace App\Http\Controllers\dashboard;

use App\Address;
use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $addressTypes;
    public function __construct()
    {
        $this->addressTypes= [
            (object) [
                "title"=> "Manual Address",
                "description"=> "Write your address manually by adding the country, state, city, address, and postal code",
                "value"=> "Manual"
            ],
            (object) [
                "title"=> "Maps",
                "description"=> "Add your address using google maps API",
                "value"=> "Map"
            ],
        ];
    }

    public function index()
    {
        //
        $addresses= auth()->user()->addresses;
        return view('dashboard.addresses.index', [
            "addresses" => $addresses
        ]);
    }

    public function verifyAddress(Request $request, $address){
        $validatedData = $request->validate([
            'type' => 'required|in:Map,Manual',
            'country' => 'required_if:type,Manual|integer|exists:countries,id',
            'state' => 'required_if:type,Manual|integer|exists:states,id',
            'city' => 'required_if:type,Manual',
            'address' => 'required_if:type,Manual',
            'postal_code' => 'required_if:type,Manual|integer',
            'latitude' => 'required_if:type,Map',
            'longitude' => 'required_if:type,Map',
            'name' => 'required_if:type,Map',
        ]);
        $type= $request->input('type');
        $address->type= $type;
        $address->user_id= auth()->user()->id;
        if($type == "Manual"){
            $address->country_id= $request->input('country');
            $address->state_id= $request->input('state');
            $address->city= $request->input('city');
            $address->street= $request->input('address');
            $address->postal_code= $request->input('postal_code');
        }else{
            $address->latitude= $request->input('latitude');
            $address->longitude= $request->input('longitude');
            $address->name= $request->input('name');
        }
        return $address;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $address= new Address();
        $countries= Country::all();
        $states= State::all();
        return view('dashboard.addresses.form', [
            'addressTypes'=> $this->addressTypes,
            'address'=> $address,
            'countries'=> $countries,
            'states'=> $states
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $address= new Address();
        $address= $this->verifyAddress($request, $address);

        $address->save();
        return redirect()->route('dashboard.address.index')->with("status", "An address was added successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return Response
     */
    public function edit(Address $address)
    {
        //
        $countries= Country::all();
        $states= State::all();
        return view('dashboard.addresses.form', [
            'addressTypes'=> $this->addressTypes,
            'address' => $address,
            'countries'=> $countries,
            'states'=> $states
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Address $address
     * @return Response
     */
    public function update(Request $request, Address $address)
    {
        //
        $this->verifyAddress($request, $address);
        $address->save();
        return redirect()->route('dashboard.address.index')->with("status", "The address was edited successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return Response
     * @throws Exception
     */
    public function destroy(Address $address)
    {
        //
        $address->delete();
        return redirect()->route('dashboard.address.index')->with("status", "The address was deleted successfully.");
    }
}
