<?php

namespace Tests\Feature;

use App\Jobs\ProcessTicket;
use App\Models\Data;
use App\Notifications\DataTicketNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessTicketTest extends TestCase
{
    use RefreshDatabase;

    public function testProcessTicketJob()
    {
        Queue::fake();
        Notification::fake();

        $data = Data::factory()->create();

        ProcessTicket::dispatch($data);

        Queue::assertPushed(ProcessTicket::class, function ($job) use ($data) {
            return $job->data->id === $data->id;
        });
    }
}
