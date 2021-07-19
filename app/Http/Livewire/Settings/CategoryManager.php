<?php

namespace App\Http\Livewire\Settings;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;

class CategoryManager extends Component
{
    public $CategoryRemoval;
    public $SubcategoryRemoval;
    public $showCategoryRemovalDropdown = false;
    public $showSubcategoryRemovalDropdown = false;
    public $showCategoryEditModal = false;
    public $showSubcategoryEditModal = false;
    public $category;
    public $subcategory;
    public $name;

    public function confirmCategoryRemoval($id)
    {
        $this->CategoryRemoval = $id;

        $this->showCategoryRemovalDropdown = true;
    }

    public function confirmSubcategoryRemoval($id)
    {
        $this->SubcategoryRemoval = $id;

        $this->showSubcategoryRemovalDropdown = true;
    }

    public function removeCategory($id)
    {
        try {
            Category::destroy($id);
        } catch (\Throwable $th) {
            session()->flash('error', 'This category cannot be removed as it is in use.');
        }

        $this->showCategoryRemovalDropdown = false;
    }

    public function removeSubcategory($id)
    {
        try {
            Subcategory::destroy($id);
        } catch (\Throwable $th) {
            session()->flash('error', 'This subcategory cannot be removed as it is in use.');
        }

        $this->showSubcategoryRemovalDropdown = false;
    }

    public function editCategory(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;

        $this->showCategoryEditModal = true;
    }

    public function editSubcategory(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
        $this->name = $subcategory->name;

        $this->showSubcategoryEditModal = true;
    }

    public function updateCategory()
    {
        $this->category->update([
            'name' => $this->name
        ]);

        $this->showCategoryEditModal = false;
    }

    public function updateSubcategory()
    {
        $this->subcategory->update([
            'name' => $this->name
        ]);

        $this->showSubcategoryEditModal = false;
    }

    public function render()
    {
        return view('livewire.settings.category-manager', [
            'categories' => Category::all()
        ]);
    }
}
