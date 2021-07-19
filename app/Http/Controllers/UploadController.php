<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //Zee's code
    public function index()
    {
        return view('uploads.file');
    }
}
