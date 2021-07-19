<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class GrantSpent extends Component
{
    protected $listeners = ['spendingUpdated' => '$refresh'];

    public $grant;
    public $selectedSpending;
    public $editModalOpen = false;
    public $RemovalModalOpen = false;

    public $spendingDate;
    public $spendingAmount;
    public $spendingDescription;
    public $spendingEvidenceOutstanding;

    public $rules = [
        'spendingDate'                   => ['required', 'date'],
        'spendingAmount'                 => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        'spendingDescription'            => ['nullable', 'string'],
        'spendingEvidenceOutstanding'    => ['boolean'],
    ];

    public function showModal($key)
    {
        $this->selectedSpending = $this->grant->spendings->where('id', $key)->first();

        $this->spendingDate = $this->selectedSpending->spent_at->format('d-m-Y');
        $this->spendingAmount = $this->selectedSpending->amount / 100;
        $this->spendingDescription = $this->selectedSpending->description;
        $this->spendingEvidenceOutstanding = $this->selectedSpending->evidence_outstanding;

        $this->editModalOpen = true;
    }

    public function showRemovalModal()
    {
        $this->editModalOpen = false;
        $this->RemovalModalOpen = true;
    }

    public function removeSpending()
    {
        Gate::authorize('not-read-only');

        $this->selectedSpending->delete();

        $this->RemovalModalOpen = false;

        $this->emit('spendingUpdated');
    }

    public function updateSpending()
    {
        Gate::authorize('not-read-only');

        $this->selectedSpending->update([
            'amount'          => $this->spendingAmount,
            'evidence_outstanding'  => $this->spendingEvidenceOutstanding,
            'description'           => $this->spendingDescription,
            'spent_at'              => $this->spendingDate
        ]);

        $this->editModalOpen = false;

        $this->emit('spendingUpdated');
    }

    public function render()
    {
        return view('livewire.grant-spent');
    }
}
