<?php

namespace App\Console\Commands;

use App\Http\Controllers\BatchUserController;
use Illuminate\Console\Command;

class UpdateUserApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User with third-party Api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $batchController = new BatchUserController();
        $batchController();
    }
}
