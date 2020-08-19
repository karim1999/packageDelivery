<?php

namespace App\Http\Controllers\dashboard;

use App\Address;
use App\Country;
use App\Customer;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $address;
    public $addressTypes;
    public $addAddressTypes;
    public function __construct()
    {
        $this->address= new AddressController();
        $this->addressTypes= $this->address->addressTypes;
        $this->addAddressTypes= [
            (object) [
                "title"=> "Address List",
                "description"=> "Add the address from one of the addresses that you added previously",
                "value"=> "List"
            ],
            (object) [
                "title"=> "New",
                "description"=> "Add a new address to your address list",
                "value"=> "New"
            ],
        ];
    }

    public function index()
    {
        $customers= auth()->user()->customers;
        return view('dashboard.customers.index', [
            "customers" => $customers
        ]);
    }

    public function verifyCustomer(Request $request, Customer $customer){
        $validatedData = $request->validate([
            'how' => 'required|in:List,New',
            'email' => 'required',
            'name' => 'required',
            'phone' => '',
            'address_id'=> 'required_if:how,List|exists:addresses,id',
            'type' => 'required_if:how,New|in:Map,Manual',
        ]);

        $how= $request->input('how');
        if($how == "List"){
            $customer->address_id= $request->input('address_id');
        }else{
            $address= new Address();
            $address= $this->address->verifyAddress($request, $address);
            $address->save();
            $customer->address_id= $address->id;
        }

        $customer->name= $request->input('name');
        $customer->email= $request->input('email');
        $customer->phone= $request->input('phone');
        return $customer;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $customer= new Customer;
        $addresses= auth()->user()->addresses;
        $countries= Country::all();
        $states= State::all();

        return view('dashboard.customers.form', [
            "addresses" => $addresses,
            'addressTypes'=> $this->addressTypes,
            'addAddressTypes'=> $this->addAddressTypes,
            'customer' => $customer,
            'countries'=> $countries,
            'states'=> $states,
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
        $customer= new Customer();
        $customer= $this->verifyCustomer($request, $customer);
        $customer->user_id= auth()->user()->id;
        $customer->save();
        return redirect()->route('dashboard.customer.index')->with("status", "A customer was added successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return void
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        //
        $addresses= auth()->user()->addresses;
        $countries= Country::all();
        $states= State::all();
        return view('dashboard.customers.form', [
            "addresses" => $addresses,
            'addAddressTypes'=> $this->addAddressTypes,
            'addressTypes'=> $this->addressTypes,
            'customer' => $customer,
            'countries'=> $countries,
            'states'=> $states,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $customer= $this->verifyCustomer($request, $customer);
        $customer->save();
        return redirect()->route('dashboard.customer.index')->with("status", "the customer was edited successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
        return redirect()->route('dashboard.customer.index')->with("status", "The customer was deleted successfully.");
    }
}
