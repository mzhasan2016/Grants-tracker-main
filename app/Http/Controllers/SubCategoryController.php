<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ]);

        Subcategory::create($request->all());

        return redirect()->back();
    }
}
