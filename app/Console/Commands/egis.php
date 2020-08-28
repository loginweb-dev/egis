<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TCG\Voyager\VoyagerServiceProvider;
class egis extends Command
{
    protected $signature = 'egis:install';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call('key:generate');
        // $this->call('migrate:reset');
        $this->call('migrate:refresh');
        $this->call('storage:link');
        $this->call('db:seed');
        $this->call('vendor:publish', ['--provider' => VoyagerServiceProvider::class, '--tag' => ['config', 'voyager_avatar']]);
        $this->info('
            █ █▄░█ █▀ ▀█▀ ▄▀█ █░░ █░░ █▀▀ █▀▄ █ █ 
            █ █░▀█ ▄█ ░█░ █▀█ █▄▄ █▄▄ ██▄ █▄▀ ▄ ▄ 
        ');
    }
}
