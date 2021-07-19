<?php

namespace App\Http\Livewire\Grant;

use Livewire\Component;
use App\Models\Grant;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class ApplicationTable extends Component
{
    use WithPagination;

    public $sortField = 'decision_date';
    public $sortAsc = false;
    public $grantRemoval;
    public $showRemovalDropdown = false;
    public $showCreateModal = false;
    public $pagination = 10;

    public $grantorganization;
    public $grantcontact_person;
    public $grantemail_address;
    public $grantphone_number;
    public $grantapplied_amount;
    public $grantsubmitted_date;
    public $grantdecision_date;
    public $grantwebsite;
    public $grantdescription;
    public $grantnotes;

    public function updated()
    {
        if($this->showCreateModal == false) {
            $this->clearFields();
        }
    }

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function confirmRemoval($id)
    {
        $this->grantRemoval = $id;

        $this->showRemovalDropdown = true;
    }

    public function remove($id)
    {
        Gate::authorize('not-read-only');

        Grant::destroy($id);

        $this->showRemovalDropdown = false;
    }

    public function create()
    {
        Gate::authorize('not-read-only');

        $this->validate([
            'grantorganization'     => ['required', 'string'],
            'grantcontact_person'   => ['nullable', 'string'],
            'grantemail_address'    => ['nullable', 'email'],
            'grantphone_number'     => ['nullable', 'string'],
            'grantapplied_amount'   => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'grantsubmitted_date'   => ['required', 'date'],
            'grantdecision_date'    => ['nullable', 'date'],
            'grantwebsite'          => ['nullable', 'string'],
            'grantdescription'      => ['nullable', 'string', 'max:40'],
            'grantnotes'            => ['nullable', 'string', 'max:5000']
        ]);

        Grant::create([
            'organization'     => $this->grantorganization,
            'contact_person'   => $this->grantcontact_person,
            'email_address'    => $this->grantemail_address,
            'phone_number'     => $this->grantphone_number,
            'applied_amount'   => $this->grantapplied_amount,
            'submitted_date'   => $this->grantsubmitted_date,
            'decision_date'    => $this->grantdecision_date,
            'website'          => $this->grantwebsite,
            'description'      => $this->grantdescription,
            'notes'            => $this->grantnotes
        ]);

        $this->closeCreateModal();

        $this->clearFields();
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function clearFields()
    {
        $this->reset([
            'grantorganization',
            'grantcontact_person',
            'grantemail_address',
            'grantphone_number',
            'grantapplied_amount',
            'grantsubmitted_date',
            'grantdecision_date',
            'grantwebsite',
            'grantdescription',
            'grantnotes'
        ]);
    }

    public function render()
    {
        return view('livewire.grant.application-table', [
            'grants' => Grant::application()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->pagination)
        ]);
    }
}
