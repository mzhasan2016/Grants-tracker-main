<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roles:admin']);
    }

    public function index()
    {
        return view('settings.index', [
            'user' => Auth::user(),
            'categories' => Category::all()
        ]);
    }
}
