<?php

//* Importações de libs
use Illuminate\Support\Facades\Route;

//* Componentes Livewire
use App\Livewire\Auth\Login;
use App\Livewire\Private\Home;

Route::get('/login', Login::class);
Route::get('/dashboard', Home::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', function () {
        return view('livewire.welcome');
    });
});
