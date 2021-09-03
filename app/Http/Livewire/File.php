<?php

namespace App\Http\Livewire;

use Livewire\Component;


use App\Models\Multimedia;
use Illuminate\Contracts\Cache\Store;
//use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as Directory;


use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class File extends Component
{
    use WithFileUploads, WithPagination;


    public  $multimedia_id, $multimedia_name, $multimedia_description;
    public $uploadedFileName;
    public $user;

    public $isOpen = 0;
    public $updateMode = false;

    public $tempFiles;

    public $previousMultimediaData;

    //public  $multimedias;
    private  $multimedias;

    public $sortColumn = "name";

    public function render()
    {
        $this->body_class = 'bg-black';

        return view('livewire.file', [
            'multimedias' => Multimedia::orderBy($this->sortColumn, 'ASC')->paginate(10), 'body_class'
        ]);
    }

    public function renderDifferent()
    {
        $this->sortColumn = "created_at";
        $this->render();
    }


    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    public function closeUpdateModal()
    {
        $this->updateMode = false;
        $this->resetValidation();
    }

    private function resetInputFields()
    {
        $this->multimedia_id = '';
        $this->multimedia_name = '';
        $this->multimedia_description = '';
        $this->multimedia_location = '';
        $this->uploadedFileName = '';
    }

    public function store()
    {
        if ($this->uploadedFileName && (!is_string($this->uploadedFileName))) {
            $uploadedFileNameTemp = $this->uploadedFileName;
            $this->uploadedFileName = $this->uploadedFileName->getClientOriginalName();

            $validator = Validator::make(
                [
                    'multimedia_description' => $this->multimedia_description,
                    'uploadedFileName' => $this->uploadedFileName

                ],
                [
                    'multimedia_description' => 'required',
                    'uploadedFileName' => ['required', Rule::unique('multimedia', 'name')]

                ]
            );

            if (!empty($validator->errors()->messages()['uploadedFileName'])) {
                $uploadedFileNameErrorMessage = $validator->errors()->messages()['uploadedFileName'];

                if (in_array("The uploaded file name has already been taken.", $uploadedFileNameErrorMessage)) {
                    $this->dispatchBrowserEvent('clearFile');
                }
                $this->uploadedFileName = null;
            }

            $validatedData = $validator->validate();

            $this->uploadedFileName = $uploadedFileNameTemp;
        } else {
            $validator = Validator::make(
                [
                    'multimedia_description' => $this->multimedia_description,
                    'uploadedFileName' => $this->uploadedFileName

                ],
                [
                    'multimedia_description' => 'required',
                    'uploadedFileName' => 'required'

                ]
            );

            $validatedData = $validator->validate();
        }

        $tempFileName = $this->uploadedFileName->getClientOriginalName();
        $validatedData['multimedia_name'] = $tempFileName;

        $this->uploadedFileName->storeAs('documents', $validatedData['multimedia_name']);

        $this->multimedia_name = $validatedData['multimedia_name'];
        $this->multimedia_description = $validatedData['multimedia_description'];

        Multimedia::create([
            'name' => $this->multimedia_name,
            'description' => $this->multimedia_description
        ]);
        session()->flash('message', 'File Successfully Uploaded.');

        $this->closeModal();

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        $this->multimedia_id = $id;
        $this->multimedia_name = $multimedia->name;
        $this->multimedia_description = $multimedia->description;
        $this->previousMultimediaData = $multimedia;
        $this->updateMode = true;
    }


    public function update()
    {
        if ($this->multimedia_name != $this->previousMultimediaData->name) {
            $validatedData = $this->validate([
                'multimedia_name' => ['required', Rule::unique('multimedia', 'name')],
                'multimedia_description' => 'required',
            ]);
        } else {
            $validatedData = $this->validate([
                'multimedia_description' => 'required'
            ]);
            $validatedData['multimedia_name'] = $this->multimedia_name;
        }

        $file = Multimedia::find($this->multimedia_id);

        $this->multimedia_description = $validatedData['multimedia_description'];

        if ($this->multimedia_name != $this->previousMultimediaData->name) {

            rename(Storage::disk('local')->getAdapter()->getPathPrefix() . "documents" . '\\' . $this->previousMultimediaData->name, Storage::disk('local')->getAdapter()->getPathPrefix() . "documents" . '\\' . $this->multimedia_name);
        }

        $file->update([

            'name' => $this->multimedia_name,
            'description' => $this->multimedia_description,

        ]);

        $this->updateMode = false;

        session()->flash('message', 'File Updated Successfully.');

        $this->resetInputFields();
    }

    public function fileDownload($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        $filePath = Storage::disk('local')->getAdapter()->getPathPrefix() . 'documents' . '\\' . $multimedia->name;
        $headers = [
            'Content-Disposition' => 'attachment'
        ];
        return response()->download($filePath, $multimedia->name, $headers);
    }

    public function delete($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        $filePath = Storage::disk('local')->getAdapter()->getPathPrefix() . 'documents' . '\\' . $multimedia->name;
        unlink($filePath);
        $multimedia->delete();
        session()->flash('message', 'File Deleted Successfully.');
    }
}
