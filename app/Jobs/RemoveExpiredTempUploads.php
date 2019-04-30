<?php

namespace App\Jobs;

use App\TempUpload;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RemoveExpiredTempUploads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get all temp-uploads that are expired
        $expiredUploads = TempUpload::expired()->get();

        foreach($expiredUploads as $upload) {
            $upload->delete();
        }

        return $expiredUploads->count();
    }
}
