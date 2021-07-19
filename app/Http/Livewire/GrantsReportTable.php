<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Grant;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GrantsReportTable extends Component
{
    use WithPagination;

    public $display;
    public $dateApplied;
    public $maincategory;
    public $subcategory;
    public $live;
    public $evidenceOutstanding;
    public $complete;
    public $search;

    public $sortField = 'submitted_date';
    public $sortAsc = false;
    public $grantRemoval;
    public $showRemovalDropdown = false;
    public $pagination = 10;

    public $categories;
    public $subcategories;
    public $grantResults;
    public $subcategoryNames;
    public $subcategoryNameSelected;

    public $RemoveSelectedGrantsModal = false;

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = Collect();
        $this->subcategoryNames = Subcategory::select('name')->groupBy('name')->get()->pluck('name');
        $this->storeGrantResults();
    }

    public function updated()
    {
        $this->storeGrantResults();
    }

    public function storeGrantResults()
    {
        $this->grantResults = Grant::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->withSum('spendings', 'amount')
            ->withSum('receivings', 'amount')
            ->withSum('awards', 'amount')
            ->addSelect(DB::raw('(SELECT(IFNULL(receivings_sum_amount, 0) - IFNULL(spendings_sum_amount, 0))) AS available'))
            ->when($this->display, fn ($query, $display) => $query->where('status', $display))
            ->when($this->dateApplied, function ($query, $dateApplied) {
                if($dateApplied === '6months') {
                    $date = Carbon::now()->sub('month', 6);
                } elseif($dateApplied === '1year') {
                    $date = Carbon::now()->sub('year', 1);
                } elseif($dateApplied === '2year') {
                    $date = Carbon::now()->sub('year', 2);
                }

                return $query->where('submitted_date', '>', $date);
            })
            ->when($this->maincategory, function ($query, $maincategory) {
                return $query->whereHas('receivings.subcategory.category', function ($query) use ($maincategory) {
                    return $query->where('id', $maincategory);
                });
            })
            ->when($this->subcategory, function ($query, $subcategory) {
                return $query->whereHas('receivings', fn ($query) => $query->where('subcategory_id', $subcategory));
            })
            ->when($this->live, fn ($query) => $query->where([['status', 'won'], ['is_completed', false]]))
            ->when($this->evidenceOutstanding, function ($query) {
                return $query->whereHas('spendings', fn ($query) => $query->where('evidence_outstanding', true));
            })
            ->when($this->complete, fn ($query) => $query->where('is_completed', true))
            ->when($this->subcategoryNameSelected, function ($query, $subcategoryNameSelected) {
                return $query->whereHas('awards.subcategory', function ($query) use ($subcategoryNameSelected) {
                    return $query->where('name', $subcategoryNameSelected);
                });
            })
            ->where('organization', 'LIKE', '%' . $this->search . '%')
            ->get();
    }

    public function UpdatedMainCategory($category)
    {
        $this->subcategories = Subcategory::where('category_id', $category)->get();
        $this->subcategory = null;
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

    public function confirmSelectedGrantsRemoval()
    {
        $this->RemoveSelectedGrantsModal = true;
    }

    public function remove($id)
    {
        Gate::authorize('not-read-only');

        Grant::destroy($id);

        $this->showRemovalDropdown = false;
    }

    public function removeSelectedGrants()
    {
        Gate::authorize('not-read-only');

        $this->grantResults->each(fn ($grant) => $grant->delete());

        $this->RemoveSelectedGrantsModal = false;
    }

    public function render()
    {
        $grants = Grant::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->withSum('spendings', 'amount')
            ->withSum('receivings', 'amount')
            ->withSum('awards', 'amount')
            ->addSelect(DB::raw('(SELECT(IFNULL(receivings_sum_amount, 0) - IFNULL(spendings_sum_amount, 0))) AS available'))
            ->when($this->display, fn ($query, $display) => $query->where('status', $display))
            ->when($this->dateApplied, function ($query, $dateApplied) {
                if($dateApplied === '6months') {
                    $date = Carbon::now()->sub('month', 6);
                } elseif($dateApplied === '1year') {
                    $date = Carbon::now()->sub('year', 1);
                } elseif($dateApplied === '2year') {
                    $date = Carbon::now()->sub('year', 2);
                }

                return $query->where('submitted_date', '>', $date);
            })
            ->when($this->maincategory, function ($query, $maincategory) {
                return $query->whereHas('receivings.subcategory.category', function ($query) use ($maincategory) {
                    return $query->where('id', $maincategory);
                });
            })
            ->when($this->subcategory, function ($query, $subcategory) {
                return $query->whereHas('receivings', fn ($query) => $query->where('subcategory_id', $subcategory));
            })
            ->when($this->live, fn ($query) => $query->where([['status', 'won'], ['is_completed', false]]))
            ->when($this->evidenceOutstanding, function ($query) {
                return $query->whereHas('spendings', fn ($query) => $query->where('evidence_outstanding', true));
            })
            ->when($this->complete, fn ($query) => $query->where('is_completed', true))
            ->when($this->subcategoryNameSelected, function ($query, $subcategoryNameSelected) {
                return $query->whereHas('awards.subcategory', function ($query) use ($subcategoryNameSelected) {
                    return $query->where('name', $subcategoryNameSelected);
                });
            })
            ->where('organization', 'LIKE', '%' . $this->search . '%')
            ->paginate($this->pagination);

        return view('livewire.grants-report-table', [
            'grants' => $grants
        ]);
    }
}
