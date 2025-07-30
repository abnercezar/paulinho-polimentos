<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/clients', function () {
    return view('clients');
});

// Appointment routes
Route::resource('appointments', AppointmentController::class);

// Client routes
Route::resource('clients', ClientController::class);

// Service routes
Route::resource('services', ServiceController::class);

// Rota de exemplo para testar o layout
Route::get('/teste-layout', function () {
    return view('teste-layout');
});
