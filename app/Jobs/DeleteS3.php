<?php

namespace App\Jobs;

use App\Trait\UploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteS3 implements ShouldQueue
{

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels,
        UploadService;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $url;
    public $path;
    public function __construct($url, $path)
    {
        $this->url = $url;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->delete_s3($this->url, $this->path);
    }
}
