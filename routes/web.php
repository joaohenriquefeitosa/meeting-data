<?php

use App\Http\Controllers\EmailPreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email-preview', [EmailPreviewController::class, 'preview']);
