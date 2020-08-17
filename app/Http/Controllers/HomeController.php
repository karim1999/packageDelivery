<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function index()
    {
        $plans = collect([
            (object)[
                "id" => "price_1HG1uzEWNKnb7XZPgPWjK6jP",
                "name" => "Basic Plan",
                "price" => "20",
                "description" => "Basic Plan for accessing the application",
                "features" => [
                    "Includes 150 Tasks/Month",
                    "Unlimited Agents",
                    "Additional Tasks at US$0.14/Task"
                ]
            ],
            (object)[
                "id" => "price_1HG1vTEWNKnb7XZPp3edqBoc",
                "name" => "Premium Plan",
                "price" => "50",
                "description" => "Premium Plan for accessing the application",
                "features" => [
                    "Includes 500 Tasks/Month",
                    "Unlimited Agents",
                    "Additional Tasks at US$0.14/Task"
                ]
            ],
            (object)[
                "id" => "price_1HGMzlEWNKnb7XZPUTbUhqNe",
                "name" => "Unlimited Plan",
                "price" => "200",
                "description" => "Unlimited Plan for accessing the application",
                "features" => [
                    "Includes Unlimited Tasks/Month",
                    "Unlimited Agents",
                    "Additional Tasks at US$0.14/Task",
                ]
            ],
        ]);


        return view('home', [
            "plans" => $plans
        ]);
    }
}
