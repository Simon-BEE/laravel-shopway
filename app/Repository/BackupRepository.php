<?php

namespace App\Repository;

use App\Helpers\Format;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BackupRepository
{
    public function getBackups()
    {
        return collect(Storage::files('backup'))->mapWithKeys(function ($path){
            return $this->format($path);
        })->reverse();
    }

    private function format(string $path)
    {
        $dateRaw = Str::before(Str::after($path, 'backup/'), '.zip');
        $date = Str::substr($dateRaw, 0, 10);
        $time = Str::replaceArray('-', [':', ':'], Str::substr($dateRaw, -8));

        return [Format::date($date . ' ' . $time, 'd/m/Y H:i') => $path];
    }
}