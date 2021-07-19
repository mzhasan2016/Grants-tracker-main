<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\FilesystemAdapter as Disk;

class Backup
{
    const PATH = 'Grant-Tracker/';

    public $fileName;
    public Disk $disk;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->disk = Storage::disk('backup');
    }

    public static function create()
    {
        Artisan::call('backup:run');

        Artisan::call('backup:clean');
    }

    public static function all()
    {
        $backups = collect([]);

        foreach (Storage::disk('backup')->files(self::PATH) as $backup) {
            $backups->push(new Backup(ltrim($backup, self::PATH)));
        }

        return $backups;
    }

    public function lastModified()
    {
        return Carbon::createFromTimestamp($this->disk->lastModified(self::PATH . $this->fileName));
    }

    public function size()
    {
        return self::makeReadable($this->disk->size(self::PATH . $this->fileName));
    }

    private static function makeReadable($bytes)
    {
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), [0,0,2,2,3][$i]).['B','KB','MB','GB','TB'][$i];
    }

    public function delete()
    {
        $this->disk->delete(self::PATH . $this->fileName);
    }

    public function download()
    {
        return $this->disk->download(self::PATH . $this->fileName);
    }
}
