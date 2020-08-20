<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Helpers\Format;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Repository\BackupRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index(BackupRepository $backupRepository)
    {
        $backups = $backupRepository->getBackups();

        return view('admin.settings.backup.index', [
            'backups' => $backups,
        ]);
    }

    public function database()
    {
        Artisan::queue('backup:run --only-db');

        return back()->with([
            'type' => 'success',
            'message' => 'Database backup has been requested.'
        ]);
    }

    public function download()
    {
        $filePath = storage_path('app/' . request()->backup);

        return Response::download($filePath);
    }

    public function clean()
    {
        Artisan::queue('backup:clean');

        return back()->with([
            'type' => 'success',
            'message' => 'Backups has been cleaned.'
        ]);
    }
}
