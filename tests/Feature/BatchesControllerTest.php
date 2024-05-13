<?php

namespace Tests\Feature;

use App\Jobs\ProcessFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BatchesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retrieves_all_batches_named_files()
    {
        // Seed the database with test data
        $batchOne  = Bus::batch([
            new ProcessFile([], []),
            new ProcessFile([], []),
        ])->name('files')->onQueue('files')->dispatch();

        $batchTwo  = Bus::batch([
            new ProcessFile([], []),
            new ProcessFile([], []),
            new ProcessFile([], []),
        ])->name('files')->onQueue('files')->dispatch();

        $batchOther  = Bus::batch([
            new ProcessFile([], []),
        ])->name('other')->onQueue('other')->dispatch();

        // Make a request to the index route
        $response = $this->json('GET', 'api/batches');

        // Assert that the response is correct
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => ['id', 'name', 'created_at']
            ]
        ]);
        $response->assertJson([
            'success' => true,
            'data' => [
                ['name' => 'files', 'total_jobs' => 2],
                ['name' => 'files', 'total_jobs' => 3]
            ]
        ]);
        $response->assertJsonMissing([
            'data' => [
                ['name' => 'other', 'total_jobs' => 1]
            ]
        ]);
    }
}
