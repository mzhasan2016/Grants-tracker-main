<?php

namespace App\Http\Livewire\Grant;

use App\Models\Category;
use App\Models\Award;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class AwardsList extends Component
{
    protected $listeners = ['awardUpdated' => '$refresh'];

    public $grant;
    public $categories;
    public $fundingModalOpen = false;
    public $awardEditModalOpen = false;
    public $awardDeleteModalOpen = false;
    public $funds;
    public $award;
    public $date;

    public $awardedSubcategory;
    public $awardedAmount;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function showFundDetails($key)
    {
        $this->funds = $this->grant->awards->where('awarded_at', Carbon::create($key)->toDateTimeString());
        $this->date = $this->funds->first()->awarded_at->format('d-m-Y');

        $this->fundingModalOpen = true;
    }

    public function showAwardEditModal($key)
    {
        $this->fundingModalOpen = false;

        $award = Award::find($key);

        $this->award = $award;
        $this->awardedAmount = $award->amount / 100;
        $this->awardedSubcategory = $award->subcategory_id;

        $this->awardEditModalOpen = true;
    }

    public function updateAward()
    {
        Gate::authorize('not-read-only');

        $this->validate([
            'awardedAmount' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'awardedSubcategory' => ['required', 'integer']
        ]);

        $this->award->update([
            'amount' => $this->awardedAmount,
            'subcategory_id' => $this->awardedSubcategory
        ]);

        $this->emit('awardUpdated');

        $this->awardEditModalOpen = false;
        $this->fundingModalOpen = true;
    }

    public function confirmRemoval($key)
    {
        $this->award = Award::find($key);

        $this->fundingModalOpen = false;
        $this->awardDeleteModalOpen = true;
    }

    public function removeAward()
    {
        Gate::authorize('not-read-only');

        $this->award->delete();
        $this->funds = null;

        $this->emit('awardUpdated');

        $this->awardDeleteModalOpen = false;
    }

    public function updateDate()
    {
        Gate::authorize('not-read-only');

        $this->validate([
            'date' => ['date']
        ]);

        $this->funds->each(fn ($fund) => $fund->update([
            'awarded_at' => $this->date
        ]));

        $this->fundingModalOpen = false;

        $this->emit('awardUpdated');
    }

    public function render()
    {
        return view('livewire.grant.awards-list', [
            'awards' => collect($this->grant->awards->groupBy(fn ($grant) => $grant->awarded_at->toDateString()))
        ]);
    }
}
