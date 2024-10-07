<?php

namespace App\Jobs;

use App\Services\UserService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateUsersJob implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $startBach, public int $limit)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new UserService())->updateUserByBatch($this->startBach, $this->limit);
    }
}
