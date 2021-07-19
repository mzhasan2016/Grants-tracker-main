<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use ZipArchive;

class BackupRestoreService
{
    private $file;
    private $disk;

    public function __construct($file)
    {
        $this->file = $file;
        $this->disk = Storage::disk('backup-restore');
    }

    public function run()
    {
        $this->unzipBackup();
        $this->dropAllCurrentTables();
        $this->removeFiles();
        $this->loadMysqlDump();
        $this->restoreFiles();
        $this->cleanup();
    }

    private function dropAllCurrentTables()
    {
        DB::connection(DB::getDefaultConnection())
            ->getSchemaBuilder()
            ->dropAllTables();

        DB::reconnect();
    }

    private function loadMysqlDump()
    {
        $path = 'db-dumps/mysql-' . config('database.connections.mysql.database') . '.sql';

        DB::connection(DB::getDefaultConnection())->unprepared($this->disk->get($path));
    }

    private function restoreFiles()
    {
        File::copyDirectory(storage_path('app/backup-restore/storage/app/public'), storage_path('app/public'));
    }

    private function unzipBackup()
    {
        $zip = new ZipArchive;
        $zip->open($this->file->getRealPath());
        $zip->extractTo(storage_path('app/backup-restore'));
        $zip->close();
    }

    private function cleanup()
    {
        $file = new Filesystem;
        $file->cleanDirectory(storage_path('app/backup-restore'));
    }

    private function removeFiles()
    {
        $directories = Storage::allDirectories('public');

        foreach ($directories as $directory) {
            Storage::deleteDirectory($directory);
        }
    }
}