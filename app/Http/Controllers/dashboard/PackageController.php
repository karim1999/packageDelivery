<?php

namespace App\Http\Controllers\dashboard;

use App\Address;
use App\Country;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Package;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageController extends Controller
{
    public $address;
    public $customer;
    public $addressTypes;
    public $addAddressTypes;

    public function __construct()
    {
        $this->address= new AddressController();
        $this->customer= new CustomerController();
        $this->addressTypes= $this->address->addressTypes;
        $this->addAddressTypes= $this->customer->addAddressTypes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $packages= auth()->user()->packages;
        return view('dashboard.packages.index', [
            "packages"=> $packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $package= new Package();
        $addresses= auth()->user()->addresses;
        $countries= Country::all();
        $states= State::all();
        $drivers= auth()->user()->drivers;
        $customers= auth()->user()->customers;

        return view('dashboard.packages.form', [
            "drivers" => $drivers,
            "addresses" => $addresses,
            'addressTypes'=> $this->addressTypes,
            'addAddressTypes'=> $this->addAddressTypes,
            "package"=> $package,
            'countries'=> $countries,
            'states'=> $states,
            'customers'=> $customers
        ]);

    }
    public function verifyPackage(Request $request, Package $package){
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'width' => 'required',
            'height' => 'required',
            'length' => 'required',
            'how_from' => 'required|in:List,New',
            'type_from' => 'required_if:how_from,New|in:Map,Manual',
            'address_id_from'=> 'required_if:how_from,List|exists:addresses,id',
            'how_to' => 'required|in:List,New',
            'type_to' => 'required_if:how_to,New|in:Map,Manual',
            'address_id_to'=> 'required_if:how_to,List|exists:addresses,id',
            'driver'=> 'required|exists:drivers,id',
        ]);

        $package->name= $request->input('name');
        $package->description= $request->input('description');
        $package->weight= $request->input('weight');
        $package->width= $request->input('width');
        $package->height= $request->input('height');
        $package->length= $request->input('length');
        if($request->input('how_from') == "New"){
            $request->merge([
                'type' => $request->input('type_from'),
                'country' => $request->input('country_from'),
                'state' => $request->input('state_from'),
                'city' => $request->input('city_from'),
                'address' => $request->input('address_from'),
                'postal_code' => $request->input('postal_code_from'),
                'latitude' => $request->input('latitude_from'),
                'longitude' => $request->input('longitude_from'),
            ]);
//            print_r($request->all());
//            return $package;
            $address= new Address();
            $address= $this->address->verifyAddress($request, $address);
            $address->user_id= auth()->user()->id;
            $address->save();
            $package->addressFrom()->associate($address->id);
        }else{
            $package->addressFrom()->associate($request->input('address_id_from'));
        }
        if($request->input('how_to') == "New"){
            $request->merge([
                'type' => $request->input('type_to'),
                'country' => $request->input('country_to'),
                'state' => $request->input('state_to'),
                'city' => $request->input('city_to'),
                'address' => $request->input('address_to'),
                'postal_code' => $request->input('postal_code_to'),
                'latitude' => $request->input('latitude_to'),
                'longitude' => $request->input('longitude_to'),
                'name' => $request->input('name'),
            ]);
            $address= new Address();
            $address= $this->address->verifyAddress($request, $address);
            $address->user_id= auth()->user()->id;
            $address->save();
            $package->addressTo()->associate($address->id);
        }else{
            $package->addressTo()->associate($request->input('address_id_to'));
        }
        return $package;
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
        $package= new Package();
        $package= $this->verifyPackage($request, $package);
        $package->user_id= auth()->user()->id;
        $package->save();
        $package->drivers()->sync($request->input('driver'));
        return redirect()->route('dashboard.package.index')->with("status", "A package was added successfully.");
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
     * @param Package $package
     * @return Response
     */
    public function edit(Package $package)
    {
        //
        $addresses= auth()->user()->addresses;
        $countries= Country::all();
        $states= State::all();
        $customers= auth()->user()->customers;
        $drivers= auth()->user()->drivers;

        return view('dashboard.packages.form', [
            "drivers" => $drivers,
            "addresses" => $addresses,
            'addressTypes'=> $this->addressTypes,
            'addAddressTypes'=> $this->addAddressTypes,
            "package"=> $package,
            'countries'=> $countries,
            'states'=> $states,
            'customers'=> $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Package $package
     * @return Response
     */
    public function update(Request $request, Package $package)
    {
        //
        $package= $this->verifyPackage($request, $package);
        $package->save();
        $package->drivers()->sync($request->input('driver'));
        return redirect()->route('dashboard.package.index')->with("status", "The package was edited successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Package $package
     * @return void
     * @throws \Exception
     */
    public function destroy(Package $package)
    {
        //
        $package->delete();
        return redirect()->route('dashboard.package.index')->with("status", "The package was deleted successfully.");
    }
}
