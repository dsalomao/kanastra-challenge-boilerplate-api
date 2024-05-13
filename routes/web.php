<?php

use App\Models\Data;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return phpinfo();
});
