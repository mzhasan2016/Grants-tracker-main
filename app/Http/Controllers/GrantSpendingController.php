<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grant;
use Illuminate\Support\Facades\Gate;

class GrantSpendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Grant $grant)
    {
        Gate::authorize('not-read-only');

        $request->validate([
            'spent_at'              => ['required', 'date'],
            'subcategory_id'        => ['required', 'integer', 'exists:subcategories,id'],
            'amount'                => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description'           => ['nullable', 'string'],
            'evidence_outstanding'  => ['boolean'],
        ]);

        $grant->spendings()->create($request->all());

        return redirect()->back();
    }
}
