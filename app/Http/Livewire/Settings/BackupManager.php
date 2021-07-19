<?php

namespace App\Http\Livewire\Settings;

use App\Services\Backup;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Services\BackupRestoreService;
use Spatie\Valuestore\Valuestore;

class BackupManager extends Component
{
    use WithPagination, WithFileUploads;

    public $fileName;
    public $file;
    public $showBackupRemovalModal = false;
    public $showBackupRestoreModal = false;
    public $enableDailyBackups;

    public function mount()
    {
        $settings = Valuestore::make(storage_path('app/settings.json'));

        $this->enableDailyBackups = $settings->get('enable_daily_backups', true);
    }

    public function updatedEnableDailyBackups()
    {
        $settings = Valuestore::make(storage_path('app/settings.json'));

        $settings->put('enable_daily_backups', $this->enableDailyBackups);
    }

    public function create()
    {
        Backup::create();
    }

    public function confirmDeletion($fileName)
    {
        $this->fileName = $fileName;

        $this->showBackupRemovalModal = true;
    }

    public function confirmRestore()
    {
        $this->validate([
            'file' => ['required', 'max:5000000', 'mimes:zip']
        ]);

        $this->showBackupRestoreModal = true;
    }

    public function delete()
    {
        (new Backup($this->fileName))->delete();

        $this->showBackupRemovalModal = false;
    }

    public function restore()
    {
        (new BackupRestoreService($this->file))->run();

        return redirect()->route('settings');
    }

    public function download($fileName)
    {
        return (new Backup($fileName))->download();
    }

    public function render()
    {
        return view('livewire.settings.backup-manager', [
            'backups' => Backup::all()->sortByDesc(fn ($backup) => $backup->lastModified())->paginate(6)
        ]);
    }
}
