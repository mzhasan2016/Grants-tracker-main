<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class GrantLiveController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('grants.live', [
            'user' => Auth::user(),
            'categories' => Category::all()
        ]);
    }*/

    //Zee's code to overcome login problems
    public function index()
    {
        return view('grants.applications');
    }
}
