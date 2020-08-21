<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCacheCompletely extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all available commands to clear cache.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('optimize:clear');

        $this->call('cache:clear');

        $this->call('event:clear');

        $this->info('Cache has been reset!');

        return 0;
    }
}
