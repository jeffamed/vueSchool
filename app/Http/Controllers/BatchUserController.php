<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Bus\Batch;
use App\Jobs\UpdateUsersJob;

class BatchUserController extends Controller
{
    /**
     * Execute a Bus::batch to update information of users in batches
     */
    public function __invoke()
    {
        $batchSize = 1000;
        $totalRecords = User::count();
        $jobs = [];

        for ($i = 0; $i <= $totalRecords; $i += $batchSize) {
            $jobs[] = new UpdateUsersJob($i, $batchSize);
        }

        \Bus::batch($jobs)
        ->then(function (Batch $batch) {
            \Log::info("Batch {$batch->id} processed successfully");
        });
    }
}
