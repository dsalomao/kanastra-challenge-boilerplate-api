<?php

namespace Tests\Feature;

use App\Jobs\ProcessFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Fake the storage to avoid dealing with real file uploads
        Storage::fake('local');
        // Fake the Bus to prevent jobs from actually being dispatched
        Bus::fake();
    }

    /** @test */
    public function it_responds_with_error_if_file_is_not_provided_or_invalid()
    {
        // Send a post request without a file
        $response = $this->json('POST', 'api/data', []);
        $response->assertStatus(422);
        $response->assertJson(["message" => "The file field is required."]);

        // Send a post request with an invalid file
        $invalidFile = UploadedFile::fake()->create('document.pdf', 0); // invalid file extension
        $response = $this->json('POST', 'api/data', ['file' => $invalidFile]);
        $response->assertStatus(422);
        $response->assertJson(["message" => "The file field must be a file of type: csv."]);
    }

     /** @test */
    public function it_handles_valid_file_upload_successfully()
    {
        // Create a fake file
        $file = UploadedFile::fake()->create('document.csv', 2048); // 2MB CSV

        // Send a post request with the valid file
        $response = $this->json('POST', 'api/data', ['file' => $file]);

        // Assert Bus::batch was called
        Bus::assertBatched(function ($batch) {
             return $batch->name == 'files' && $batch->jobs->count() === 0;
        });

        // Since the batch is fresh and likely hasn't processed, we simulate a successful batch with fake data
        $mockBatch = ['name' => 'files'];
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => $mockBatch]);
    }
}
