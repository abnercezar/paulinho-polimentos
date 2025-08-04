<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Rota inicial (página de boas-vindas)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota estática para visualização de serviços (não é CRUD)
Route::get('/services', function () {
    return view('services');
});

// Rota para redirecionamento do WhatsApp
Route::get('/whatsapp-redirect', function () {
    $numeroTelefone = '554384524454';
    $mensagem = urlencode('Olá Paulinho! Gostaria de agendar um horário para polimento automotivo. Vi seu site e fiquei interessado nos serviços!');
    $link = "https://wa.me/$numeroTelefone?text=$mensagem";

    return redirect()->away($link);
})->name('whatsapp.redirect');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Rotas resource para CRUD de agendamentos
    Route::resource('appointments', AppointmentController::class);

    // Rotas resource para CRUD de clientes
    Route::resource('clients', ClientController::class);

    // Rotas resource para CRUD de serviços
    Route::resource('services', ServiceController::class);

    // Rotas resource para CRUD de caixas
    Route::resource('cash_registers', CashRegisterController::class);
});
