<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCacheCompletely extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all available commands to set cache.';

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
        $this->call('config:cache');
        $this->call('event:cache');
        $this->call('route:cache');
        $this->call('view:cache');

        $this->info('Everything has been cached!');
        
        return 0;
    }
}
