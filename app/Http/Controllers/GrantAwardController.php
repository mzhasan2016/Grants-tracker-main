<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grant;
use Illuminate\Support\Facades\Gate;

class GrantAwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Grant $grant)
    {
        Gate::authorize('not-read-only');

        $request->validate([
            'awarded_date_funding'  => ['required', 'date'],
            'categories'            => ['required'],
            'amounts'               => ['required'],
            'categories.*'          => ['integer'],
            'amounts.*'             => ['regex:/^\d+(\.\d{1,2})?$/']
        ]);

        collect($request->only([
            'categories',
            'amounts'
        ]))->transpose()->map(function ($data) use ($request) {
            return [
                'subcategory_id' => $data[0],
                'amount' => $data[1],
                'awarded_at' => $request->awarded_date_funding
            ];
        })->each(function ($award) use ($grant) {
            $grant->awards()->create($award);
        });

        return redirect()->back();
    }
}
