<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GrantApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('grants.applications', [
            'user' => Auth::user()
        ]);
    }

    //Zee's code to overcome login problems
    /*public function index()
    {
        return view('grants.applications');
    }*/
}
