<?php

namespace App\Http\Livewire\Grant;

use App\Models\Category;
use App\Models\Receiving;
use App\Models\Subcategory;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class ReceivingsList extends Component
{
    protected $listeners = ['refresh' => '$refresh'];

    public $grant;
    public $fundingModalOpen = false;
    public $receivingEditModalOpen = false;
    public $receivingDeleteModalOpen = false;
    public $funds;
    public $date;
    public $receiving;
    public $categories;
    public $subcategories;
    public $receivingAmount;
    public $receivingSubcategory;

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = Subcategory::all();
    }

    public function isCategoryAwarded($id)
    {
        return $this->grant->awards->contains('subcategory_id', $id);
    }

    public function showFundDetails($key)
    {
        $this->funds = $this->grant->receivings->where('received_at', Carbon::create($key)->toDateTimeString());
        $this->date = $this->funds->first()->received_at->format('d-m-Y');

        $this->fundingModalOpen = true;
    }

    public function showReceivingEditModal($key)
    {
        $this->fundingModalOpen = false;

        $receiving = Receiving::find($key);

        $this->receiving = $receiving;
        $this->receivingAmount = $receiving->amount / 100;
        $this->receivingSubcategory = $receiving->subcategory_id;

        $this->receivingEditModalOpen = true;
    }

    public function updateReceiving()
    {
        Gate::authorize('not-read-only');

        $this->validate([
            'receivingAmount' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'receivingSubcategory' => ['required', 'integer']
        ]);

        $this->receiving->update([
            'amount' => $this->receivingAmount,
            'subcategory_id' => $this->receivingSubcategory
        ]);

        $this->emit('refresh');
        $this->emit('spendingUpdated');

        $this->receivingEditModalOpen = false;
        $this->fundingModalOpen = true;
    }

    public function confirmRemoval($key)
    {
        $this->receiving = Receiving::find($key);

        $this->fundingModalOpen = false;
        $this->receivingDeleteModalOpen = true;
    }

    public function removeReceiving()
    {
        Gate::authorize('not-read-only');

        $this->receiving->delete();
        $this->funds = null;

        $this->emit('refresh');
        $this->emit('spendingUpdated');

        $this->receivingDeleteModalOpen = false;
    }

    public function updateDate()
    {
        Gate::authorize('not-read-only');

        $this->validate([
            'date' => ['date']
        ]);

        $this->funds->each(fn ($fund) => $fund->update([
            'received_at' => $this->date
        ]));

        $this->fundingModalOpen = false;

        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.grant.receivings-list', [
            'receivings' => collect($this->grant->receivings->groupBy(fn ($grant) => $grant->received_at->toDateString()))
        ]);
    }
}
