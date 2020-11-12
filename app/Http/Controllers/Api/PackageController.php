<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    //
    /**
     * Get Packages.
     *
     * @authenticated
     * @bodyParam  email string The Email of the Driver. Example: karim.elbadry2@gmail.com
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function all(Request $request){
        $user= auth('drivers')->user();
        $validator = Validator::make($request->all(), [
            'start_date' => 'date',
            'end_date' => 'date',
            'limit' => 'integer',
            'sort_by' => 'in:id,created_at',
            'sort_type' => 'in:ASC,DESC',
            'status' => 'in:Waiting,Approved,Rejected,Delivering,Delivered',
            'owned' => 'boolean'
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()], 400);
        }
        $sort_type= "ASC";
        $sort_by= "id";
        $packages= [];
        if($request->get('owned')){
            $packages= $user->packages();
        }else{
            $packages= Package::query();
        }

        if($request->get('sort_by')){
            $sort_by= $request->get('sort_by');
        }
        if($request->get('sort_type')){
            $sort_type= $request->get('sort_type');
        }

        if($request->get('start_date')){
            $packages= $packages->whereDate('created_at', '>=', \Carbon\Carbon::parse($request->get('start_date')));
        }
        if($request->get('end_date')){
            $packages= $packages->whereDate('created_at', '<=', \Carbon\Carbon::parse($request->get('end_date')));
        }
        if($request->get('search')){
            $packages= $packages->where("name", "LIKE", "%".$request->get('search')."%");
        }


        $packages= $packages->orderBy($sort_by, $sort_type);
        if($request->get('limit')){
            $packages= $packages->limit($request->get('limit'));
        }

        return response()->json([
            "packages"=> $packages->get()
        ], 200);

    }
}
