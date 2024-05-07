<?php

namespace App\Http\Controllers;
use App\Http\Requests\UploadFileRequest;
use App\Jobs\ProcessFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;

class DataController extends Controller
{
    public function upload(UploadFileRequest $request)
    {
        // If something went wrong with the uploded file
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['success' => true], 422);
        }

        $batch = $this->storeFile($request->file('file'));

        return response()->json(['success' => true, 'data' => $batch], 200);
    }

    private function storeFile(UploadedFile $file)
    {
        $data = file($file);

        $chunks = array_chunk($data, 1000);

        $header = [];
        $batch  = Bus::batch([])->name('files')->onQueue('files')->dispatch();

        foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);

            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            $batch->add(new ProcessFile($data, $header));
        }

        return $batch->fresh();
    }
}
