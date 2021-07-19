<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use App\Models\Grant;
use Illuminate\Support\Facades\Gate;

class GrantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Grant $grant)
    {
        return view('grants.show', [
            'user' => Auth::user(),
            'grant' => $grant,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Grant $grant)
    {
        Gate::authorize('not-read-only');

        $request->validate([
            'organization'     => ['required', 'string'],
            'contact_person'   => ['nullable', 'string'],
            'email_address'    => ['nullable', 'email'],
            'phone_number'     => ['nullable', 'string'],
            'applied_amount'   => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'submitted_date'   => ['required', 'date'],
            'decision_date'    => ['nullable', 'date'],
            'website'          => ['nullable', 'string'],
            'description'      => ['nullable', 'string', 'max:40'],
            'notes'            => ['nullable', 'string', 'max:5000'],
            'status'           => ['nullable', 'string'],
            'awarded_date'     => ['nullable', 'date'],
            'spend_by_date'    => ['nullable', 'date'],
            'reporting_date'   => ['nullable', 'date'],
        ]);

        $grant->update($request->all());

        if($grant->status === Grant::STATUS_APPLICATION) {
            return redirect()->route('grants.applications');
        } elseif($grant->status === Grant::STATUS_WON) {
            return redirect()->route('grants.live');
        } elseif($grant->status === Grant::STATUS_NOTWON) {
            return redirect()->route('grants.reports');
        } else {
            return redirect()->back();
        }
    }

    public function notwon(Request $request, Grant $grant)
    {
        Gate::authorize('not-read-only');

        $request->validate([
            'status' => ['required', 'string'],
        ]);

        $grant->update($request->all());

        return redirect()->route('grants.applications');
    }

    public function won(Request $request, Grant $grant)
    {
        Gate::authorize('not-read-only');

        $request->validate([
            'status'            => ['required', 'string'],
            'awarded_date'      => ['required', 'date'],
            'spend_by_date'     => ['nullable', 'date'],
            'reporting_date'    => ['nullable', 'date'],
            'categories'        => ['required'],
            'amounts'           => ['required'],
            'categories.*'      => ['integer'],
            'amounts.*'         => ['regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $grant->update($request->only(['status', 'awarded_date', 'spend_by_date', 'reporting_date']));

        collect($request->only([
            'categories',
            'amounts'
        ]))->transpose()->map(function ($data) use ($request) {
            return [
                'subcategory_id' => $data[0],
                'amount' => $data[1],
                'awarded_at' => $request->awarded_date
            ];
        })->each(function ($award) use ($grant) {
            $grant->awards()->create($award);
        });

        return redirect()->route('grants.applications');
    }
}
