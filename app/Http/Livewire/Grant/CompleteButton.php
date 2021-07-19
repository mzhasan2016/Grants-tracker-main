<?php

namespace App\Http\Livewire\Grant;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class CompleteButton extends Component
{
    public $grant;
    public $modalOpen = false;
    public $warningModalOpen = false;
    public string $warningMessage;

    public function completeGrant()
    {
        if($this->grant->awarded_amount > $this->grant->received_amount) {
            $this->closeModal();
            return $this->openWarningModal('Not all money awarded has been received.');
        }

        if($this->grant->available_amount > 0) {
            $this->closeModal();
            return $this->openWarningModal('There is outstanding money to spend.');
        }

        $this->markAsCompleted();
    }

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function openWarningModal(string $message)
    {
        $this->warningModalOpen = true;
        $this->warningMessage = $message;
    }

    public function markAsCompleted()
    {
        Gate::authorize('not-read-only');

        $this->grant->markAsCompleted();

        return redirect()->route('grants.live');
    }

    public function render()
    {
        return view('livewire.grant.complete-button');
    }
}
