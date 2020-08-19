<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $user= auth()->user();
        $packagesCount= $user->packages()->count();
        $driversCount= $user->drivers()->count();
        $addressesCount= $user->addresses()->count();
        $customersCount= $user->customers()->count();
        $states= [
            [
                "title"=> "All Drivers",
                "value"=> $packagesCount,
                "description"=> "The number of drivers",
                "percent"=> $packagesCount/100,
                "type"=> "brand",
            ],
            [
                "title"=> "All Packages",
                "value"=> $driversCount,
                "description"=> "The number of Packages",
                "percent"=> $driversCount/100,
                "type"=> "danger",
            ],
            [
                "title"=> "All Customers",
                "value"=> $customersCount,
                "description"=> "The number of Customers",
                "percent"=> $customersCount/100,
                "type"=> "success",
            ],
            [
                "title"=> "All Addresses",
                "value"=> $addressesCount,
                "description"=> "The number of addresses",
                "percent"=> $addressesCount/100,
                "type"=> "warning",
            ],
        ];

        $newPackages= $user->packages()->whereDate('created_at', Carbon::today())->count();
        $waitingPackages= $user->packages()->whereHas('drivers', function (Builder $query) {
            $query->where('driver_packages.status', 'Waiting');
        })->count();
        $approvedPackages= $user->packages()->whereHas('drivers', function (Builder $query) {
            $query->where('driver_packages.status', 'Approved');
        })->count();
        $rejectedPackages= $user->packages()->whereHas('drivers', function (Builder $query) {
            $query->where('driver_packages.status', 'Rejected');
        })->count();
        $deliveringPackages= $user->packages()->whereHas('drivers', function (Builder $query) {
            $query->where('driver_packages.status', 'Delivering');
        })->count();
        $deliveredPackages= $user->packages()->whereHas('drivers', function (Builder $query) {
            $query->where('driver_packages.status', 'Delivered');
        })->count();

        $packagesStates= [
            [
                "title"=> "New Packages",
                "value"=> $newPackages,
                "description"=> "The number of New Packages",
                "percent"=> $newPackages/100,
                "type"=> "warning",
            ],
            [
                "title"=> "Waiting Packages",
                "value"=> $waitingPackages,
                "description"=> "The number of Waiting Packages",
                "percent"=> $waitingPackages/100,
                "type"=> "warning",
            ],
            [
                "title"=> "Approved Packages",
                "value"=> $approvedPackages,
                "description"=> "The number of Approved Packages",
                "percent"=> $approvedPackages/100,
                "type"=> "brand",
            ],
            [
                "title"=> "Rejected Packages",
                "value"=> $rejectedPackages,
                "description"=> "The number of Rejected Packages",
                "percent"=> $rejectedPackages/100,
                "type"=> "danger",
            ],
            [
                "title"=> "Delivering Packages",
                "value"=> $deliveringPackages,
                "description"=> "The number of Delivering Packages",
                "percent"=> $deliveringPackages/100,
                "type"=> "success",
            ],
            [
                "title"=> "Delivered Packages",
                "value"=> $deliveredPackages,
                "description"=> "The number of Delivered Packages",
                "percent"=> $deliveredPackages/100,
                "type"=> "warning",
            ],
        ];
        return view('dashboard.home', [
            "states"=> $states,
            "packagesStates"=> $packagesStates,
        ]);
    }
}
