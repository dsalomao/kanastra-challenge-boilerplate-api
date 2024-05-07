<?php

namespace App\Jobs;

use App\Models\Data;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class ProcessFile implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The file rows.
     *
     * @var array
     */
    public $data;

    /**
     * The file header.
     *
     * @var array
     */
    public $header;


    /**
     * Create a new job instance.
     */
    public function __construct(array $data, array $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = new Collection();

        $batch = Bus::batch([])->name('emails')->onQueue('emails')->dispatch();

        foreach ($this->data as $data) {
            $inputData = array_combine($this->header, $data);
            $model = Data::create($inputData);

            $batch->add(new ProcessTicket($model));
        }
    }
}
