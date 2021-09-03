<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Zee's code
    public function index()
    {
        $user = Auth::user();

        return view('uploads.files', [
            'user' => $user
        ]);
    }
}
