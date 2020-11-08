<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    //

    /**
     * Update driver's info.
     *
     * @authenticated
     * @bodyParam  email string The Email of the Driver. Example: karim.elbadry2@gmail.com
     * @bodyParam  password string The Password of the Driver. Example: karim
     * @bodyParam  name string The Password of the Driver. Example: Karim Mahmoud
     * @bodyParam  avatar string The Password of the Driver.
     * @bodyParam  vehicle enum The Password of the Driver Values ["Car", "Bicycle", "Van", "Motorcycle", "None"]. Example: Car.
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $user= auth('drivers')->user();
        $validator = Validator::make($request->all(), [
            'name' => '',
            'password' => '',
            'email' => [
                'email',
                Rule::unique('drivers')->ignore($user->id),
            ],
            'avatar' => 'image',
            'vehicle' => 'in:Car,Bicycle,Van,Motorcycle,None'
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()], 400);
        }

        if($request->input('name')){
            $user->name= $request->input('name');
        }
        if($request->input('email')){
            $user->email= $request->input('email');
        }
        if($request->input('password')){
            $user->password= Hash::make($request->input('password'));
        }
        if($request->input('vehicle')){
            $user->vehicle= $request->input('vehicle');
        }

        if($request->file("avatar"))
            $user->addMediaFromRequest("avatar")->toMediaCollection('avatar');

        $user->save();


        return response()->json([
            "message"=> "The driver was updated successfully.",
            "driver"=> $user
        ], 200);
    }

   /**
     * Update Driver's Location.
     *
     * @authenticated
     * @bodyParam  lat long required The Latitude of the Driver. Example: 30.044420
     * @bodyParam  long long required The Longitude of the Driver. Example: 31.235712
     *
     * @return JsonResponse
     */
    public function updateLocation(Request $request)
    {
        $user= auth('drivers')->user();
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'long' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()], 400);
        }

        if($request->input('lat')){
            $user->lat= $request->input('lat');
        }
        if($request->input('long')){
            $user->long= $request->input('long');
        }

        $user->save();


        return response()->json([
            "message"=> "The driver's location was updated successfully.",
            "driver"=> $user
        ], 200);
    }
   /**
     * Update Driver's Availability.
     *
     * @authenticated
     * @bodyParam  available boolean required Change the driver's availability status. Example: true
     *
     * @return JsonResponse
     */
    public function updateStatus(Request $request)
    {
        $user= auth('drivers')->user();
        $validator = Validator::make($request->all(), [
            'available' => 'required|bool',
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()], 400);
        }

        if($request->input('available')){
            $user->available= $request->input('available');
        }

        $user->save();


        return response()->json([
            "message"=> "The driver's availability was updated successfully.",
            "driver"=> $user
        ], 200);
    }


}
