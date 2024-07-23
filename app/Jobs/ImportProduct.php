<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $count;
    /**
     * Create a new job instance.
     */
    public function __construct($count)
    {
        $this->count=$count;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Product::factory($this->count)->create();
    }
}
