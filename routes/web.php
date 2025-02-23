<?php

//* Importações de libs
use Illuminate\Support\Facades\Route;

//* Importações Livewire
use App\Livewire\Auth\Login;


Route::get('/login', Login::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', function () {
        return view('livewire.welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
