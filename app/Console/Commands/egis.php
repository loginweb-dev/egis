<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class egis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'egis:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // return 0;
        $this->call('key:generate');
        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->info('
                █ █▄░█ █▀ ▀█▀ ▄▀█ █░░ █░░ █▀▀ █▀▄ █ █ 
                █ █░▀█ ▄█ ░█░ █▀█ █▄▄ █▄▄ ██▄ █▄▀ ▄ ▄ 
            ');
    }
}
