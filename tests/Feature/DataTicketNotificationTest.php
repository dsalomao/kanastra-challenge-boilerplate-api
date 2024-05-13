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

        // Assuming Data is a model that might be stored in the database
        $data = Data::factory()->create(); // Ensure you have a factory for Data model

        // Create a dummy PDF content (usually you might grab this from a storage or similar)
        $pdf = '%PDF-1.4 example content'; // Dummy PDF content

        // Create an instance of the notification
        $notification = new DataTicketNotification($data, $pdf);

        // Send the notification
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
