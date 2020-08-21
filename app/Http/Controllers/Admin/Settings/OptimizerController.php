<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\StreamOutput;

class OptimizerController extends Controller
{
    public function clear()
    {
        $stream = new BufferedOutput();

        Artisan::call('cache:reset', [], $stream);

        return redirect()->route('admin.settings.index')->with([
            'type' => 'success',
            'message' => $stream->fetch(),
        ]);
    }

    public function cache()
    {
        $stream = new BufferedOutput();

        Artisan::call('cache:all', [], $stream);

        return redirect()->route('admin.settings.index')->with([
            'type' => 'success',
            'message' => 'Everything has been cached!',
        ]);
    }
}
