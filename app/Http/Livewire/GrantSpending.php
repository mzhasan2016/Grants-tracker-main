<?php

namespace App\Http\Livewire;

use App\Models\Subcategory;
use Livewire\Component;

class GrantSpending extends Component
{
    protected $listeners = ['spendingUpdated' => '$refresh'];

    public $grant;
    public $spendModalOpen = false;
    public $subcategoryModel;

    public function openSpendModal(Subcategory $subcategory)
    {
        $this->spendModalOpen = true;
        $this->subcategoryModel = $subcategory;
    }

    public function isCategoryReceived()
    {
        if(is_null($this->subcategoryModel)) {
            return false;
        }

        return $this->grant->receivings->contains('subcategory_id', $this->subcategoryModel->id);
    }

    public function render()
    {
        $subcategories = Subcategory::all()->sortByDesc(function ($subcategory) {
            return $this->grant->receivings->where('subcategory_id', $subcategory->id)->sum('amount') - $this->grant->spendings->where('subcategory_id', $subcategory->id)->sum('amount');
        });

        return view('livewire.grant-spending', [
            'subcategories' => $subcategories
        ]);
    }
}
