<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotifyController;

Route::get('/', function () {
    return 'Hello World';
});

Route::get('/notifications', [NotifyController::class, 'index'])->name('notifications.index');
Route::get('/notifications/sent', [NotifyController::class, 'sent'])->name('notifications.sent');