<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class UpdateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'With this command you can update the users table.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new UserService())->updateUsers();
    }
}
