<?php

namespace App\Jobs;

use App\Trait\UploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, UploadService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $file;
    public $path;
    public function __construct($file,  $path)

    {

        $this->file = $file;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path =  $this->upload_image($this->file, $this->path);
    }
}
