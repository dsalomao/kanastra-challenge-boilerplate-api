<?php

namespace App\Jobs;

use App\Models\Data;
use App\Notifications\DataTicketNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;

class ProcessTicket implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The Data model.
     *
     * @var Data
     */
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('pdf.ticket', ['ticket' => $this->data]);
        $output = $pdf->output();

        $this->data->notify(new DataTicketNotification($this->data, $output));
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [new RateLimited('emails')];
    }
}
