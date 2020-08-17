<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    //
    public function index()
    {
        return view('oauth.index');
    }
}
