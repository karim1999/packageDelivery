<?php

namespace App\Http\Controllers\dashboard;

use App\Driver;
use App\Http\Controllers\Controller;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->query('status')){
            $drivers= auth()->user()->drivers()->where('drivers.status', $request->query('status'))->get();
        }else{
            $drivers= auth()->user()->drivers;
        }

        return view('dashboard.drivers.index', [
            "drivers" => $drivers
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
        $driver= new Driver;
        return view('dashboard.drivers.form', [
            'driver' => $driver
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
        $validatedData = $request->validate([
            'email' => 'required|unique:drivers',
            'name' => 'required',
            'password' => 'required',
        ]);
        $user= auth()->user();
        $driver= new Driver();
        $driver->name= $request->input('name');
        $driver->email= $request->input('email');
        $driver->password= Hash::make($request->input('password'));
        $driver->save();
        $user->drivers()->attach($driver);
        return redirect()->route('dashboard.driver.index')->with("status", "A driver was added successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param Driver $driver
     * @return void
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Driver $driver
     * @return Response
     */
    public function edit(Driver $driver)
    {
        //
        return view('dashboard.drivers.form', [
            'driver' => $driver
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Driver $driver
     * @return Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required',
        ]);
        $driver->name= $request->input('name');
        $driver->email= $request->input('email');
        if($request->input('password'))
            $driver->password= Hash::make($request->input('password'));

        $driver->save();
        return redirect()->route('dashboard.driver.index')->with("status", "the driver was edited successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Driver $driver
     * @return Response
     * @throws \Exception
     */
    public function destroy(Driver $driver)
    {
        //
        $driver->delete();
        return redirect()->route('dashboard.driver.index')->with("status", "The driver was deleted successfully.");
    }
}
