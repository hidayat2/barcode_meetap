<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    $details = [
        'title' => 'Percobaan Email',
        'body' => 'Ini adalah email percobaan dari Laravel.'
    ];

    Mail::raw($details['body'], function($message) use ($details) {
        $message->to('hidayat.day233@gmail.com')
                ->subject($details['title']);
    });

    return 'Email telah dikirim';
});


Route::get('/', function () {
    return view('welcome');
});



Route::prefix("participant")->name("participant")->group(function() {
	Route::get("/register", [ParticipantController::class, "register"])->name('.register');
	Route::post("/register", [ParticipantController::class, "register_store"]);
});


