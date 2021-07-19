<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Grant;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class GrantsLiveTable extends Component
{
    use WithPagination;

    public $sortField = 'spend_by_date';
    public $sortAsc = false;
    public $pagination = 10;

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.grants-live-table', [
            'grants' => Grant::live()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->withSum('awards', 'amount')->withSum('spendings', 'amount')->withSum('receivings', 'amount')->addSelect(DB::raw('(SELECT(IFNULL(receivings_sum_amount, 0) - IFNULL(spendings_sum_amount, 0))) AS available'))->withCount('media')->paginate($this->pagination)
        ]);
    }
}
