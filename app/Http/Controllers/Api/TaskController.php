<?php

namespace App\Http\Controllers\Api;

use App\DriverPackage;
use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //
    /**
     * Get Tasks.
     *
     * @authenticated
     * @queryParam start_date Date default(no start date). Example: MM/DD/YYYY
     * @queryParam end_date Date default(no end date). Example: MM/DD/YYYY
     * @queryParam limit Integer the number of results u want default(unlimited). Example: 10
     * @queryParam sort_by Enum (id, created_at) default(id). Example: id
     * @queryParam sort_type Enum (ASC, DESC) default(id). Example: ASC
     * @queryParam status Enum (Waiting,Approved,Rejected,Delivering,Delivered) default(gets all). Example: Waiting
     * @queryParam search string search for a package.
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
            'sort_type' => 'in:ASC,DESC,asc,desc',
            'status' => 'in:Waiting,Approved,Rejected,Delivering,Delivered'
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()], 400);
        }
        $sort_type= "ASC";
        $sort_by= "id";
        $tasks= DriverPackage::with('package');

        if($request->get('sort_by')){
            $sort_by= $request->get('sort_by');
        }
        if($request->get('sort_type')){
            $sort_type= $request->get('sort_type');
        }

        if($request->get('start_date')){
            $tasks= $tasks->whereDate('created_at', '>=', \Carbon\Carbon::parse($request->get('start_date')));
        }
        if($request->get('end_date')){
            $tasks= $tasks->whereDate('created_at', '<=', \Carbon\Carbon::parse($request->get('end_date')));
        }
        if($request->get('search')){
            $search= $request->get('search');
            $tasks= $tasks->whereHas("package", function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%');
            });
        }

        if($request->get('status')){
            $tasks= $tasks->where('driver_id', $user->id)->where('status', $request->get('status'));
        }else{
            $tasks= $tasks->where('driver_id', $user->id);
        }


        $tasks= $tasks->orderBy($sort_by, $sort_type);
        if($request->get('limit')){
            $tasks= $tasks->limit($request->get('limit'));
        }

        return response()->json([
            "tasks"=> $tasks->get()
        ], 200);

    }
    /**
     * Update Tasks status.
     *
     * @authenticated
     * @urlParam  id required The ID of the Package.
     * @bodyParam status Enum (Waiting,Approved,Rejected,Delivering,Delivered) default(gets all). Example: Waiting
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(DriverPackage $DriverPackage, Request $request){
        $user= auth('drivers')->user();
        $validator = Validator::make($request->all(), [
            'status' => 'in:Waiting,Approved,Rejected,Delivering,Delivered'
        ]);

        if($DriverPackage->driver_id !== $user->id){
            return response()->json(["error" => "You cannot change this package's status"], 401);
        }

        $DriverPackage->status= $request->post('status');
        $DriverPackage->save();

        return response()->json([
            "message"=> "The task's status was updated successfully.",
            "task"=> $DriverPackage->with('package')->first()
        ], 200);
    }

}
