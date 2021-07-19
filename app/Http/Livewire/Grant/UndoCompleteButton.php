<?php

namespace App\Http\Livewire\Grant;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;

class UndoCompleteButton extends Component
{
    public $grant;
    public $previous;
    public $modalOpen = false;

    public function mount()
    {
        $this->previous = URL::current();
    }

    public function undoComplete()
    {
        Gate::authorize('not-read-only');

        $this->grant->markAsNotCompleted();

        return redirect($this->previous);
    }

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function render()
    {
        return view('livewire.grant.undo-complete-button');
    }
}
