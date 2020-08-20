<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Jobs\ProccessCommandInBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function index()
    {
        //TODO: retrieve all backup
        return view('admin.settings.backup.index');
    }

    public function database()
    {
        Artisan::queue('backup:run --only-db');

        return redirect()->route('admin.settings.index')->with([
            'type' => 'success',
            'message' => 'Database backup has been requested.'
        ]);
    }
}
