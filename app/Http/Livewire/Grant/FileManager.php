<?php

namespace App\Http\Livewire\Grant;

use App\Models\Grant;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Gate;

class FileManager extends Component
{
    use WithFileUploads;

    public $grant;
    public $files = [];
    public $iteration = 0;
    protected $listeners = ['refreshMedia' => '$refresh'];

    public function saveMedia()
    {
        Gate::authorize('not-read-only');

        $this->validate([
            'files.*' => 'required|max:50000',
        ]);

        foreach ($this->files as $file) {
            $this->grant->addMedia($file->path())->usingFileName($file->getClientOriginalName())->toMediaCollection();
        }

        $this->iteration++;

        $this->emit('refreshMedia');
    }

    public function removeMedia($id)
    {
        Gate::authorize('not-read-only');

        Grant::whereHas('media', function ($query) use($id){
            $query->whereId($id);
        })->first()->deleteMedia($id);

        $this->emit('refreshMedia');
    }

    public function downloadMedia(Media $media) {
        return response()->download($media->getPath(), $media->file_name);
    }

    public function render()
    {
        return view('livewire.grant.file-manager');
    }
}
