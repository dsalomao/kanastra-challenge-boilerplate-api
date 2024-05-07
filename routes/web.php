<?php

use App\Models\Data;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = Data::first();
    return view('pdf.ticket', ['ticket'=>$data]);
});
