<?php

namespace Tests\Feature;

use App\Models\Data;
use App\Notifications\DataTicketNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class DataTicketNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function testNotificationIsSentWithPdfAttachment()
    {
        Notification::fake();

        $data = Data::factory()->create();

        $pdf = '%PDF-1.4 example content'; // Dummy PDF content

        $notification = new DataTicketNotification($data, $pdf);

        Notification::send($data, $notification);

        // Assert that a notification was sent to the given notifiable
        Notification::assertSentTo(
            $data,
            DataTicketNotification::class,
            function ($notification, $channels) use ($pdf, $data) {
                return $notification->pdf === $pdf &&
                       in_array('mail', $channels);
            }
        );
    }
}
