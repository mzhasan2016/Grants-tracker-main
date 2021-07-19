<?php

namespace App\Http\Livewire\Settings;

use App\Models\Grant;
use App\Exports\GrantsExport;
use Livewire\Component;

class GrantManager extends Component
{
    public $status;
    public $dateFrom;
    public $dateTo;
    public $exportDateFrom;
    public $exportDateTo;
    public $deleteTransactionsOnly;
    public $showGrantRemovalModal = false;

    public function mount()
    {
        $this->status = 'all';
    }

    public function DeleteGrants()
    {
        Grant::whereBetween('submitted_date', [date('Y-m-d', strtotime($this->dateFrom)), date('Y-m-d', strtotime($this->dateTo))])
            ->when($this->deleteTransactionsOnly, function ($query) {
                return $query->get()->each(fn ($grant) => $grant->spendings()->delete());
            }, function ($query) {
                return $query->get()->each(fn ($grant) => $grant->delete());
            });

        $this->showGrantRemovalModal = false;
    }

    public function confirmGrantsRemoval()
    {
        $this->validate([
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date',
            'deleteTransactionsOnly' => 'nullable'
        ]);

        $this->showGrantRemovalModal = true;
    }

    public function export()
    {
        $this->validate([
            'exportDateFrom' => 'nullable|date',
            'exportDateTo' => 'nullable|date',
            'status' => 'required'
        ]);

        switch ($this->status) {
            case 'all':
                $status = null;
                break;
            case 'application':
                $status = 'application';
                break;
            case 'won':
                $status = 'won';
                break;
            case 'not won':
                $status = 'not won';
                break;
            case 'complete':
                $status = 'won';
                break;
            default:
                $status = null;
                break;
        }

        $grants = Grant::select([
            'organization',
            'applied_amount',
            'website',
            'status',
            'is_completed',
            'decision_date',
            'submitted_date',
            'awarded_date',
            'spend_by_date',
            'reporting_date'
        ])
        ->when($status, fn ($query) => $query->where('status', $status))
        ->where('is_completed', $this->status === 'complete' ? true : false)
        ->when($this->exportDateFrom && $this->exportDateTo, function ($query) {
            return $query->whereBetween('awarded_date', [date('Y-m-d', strtotime($this->exportDateFrom)), date('Y-m-d', strtotime($this->exportDateTo))]);
        })
        ->withSum('awards', 'amount')
        ->withSum('receivings', 'amount')
        ->withSum('spendings', 'amount')
        ->get();

        return (new GrantsExport($grants))->download();
    }

    public function render()
    {
        return view('livewire.settings.grant-manager');
    }
}
