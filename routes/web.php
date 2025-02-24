<?php

//* Importações de libs
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//* Componentes Livewire
use App\Livewire\Auth\Login;
use App\Livewire\Private\Brand\BrandsList;
use App\Livewire\Private\EconomicGroup\CreateEconomicGroup;
use App\Livewire\Private\EconomicGroup\EconomicGroupsList;
use App\Livewire\Private\EconomicGroup\EditEconomicGroup;
use App\Livewire\Private\Employee\EmployeesList;
use App\Livewire\Private\Home;
use App\Livewire\Private\Unit\UnitsList;

Route::get('/login', Login::class)->name('login');
Route::post('/logout', function () {
  Auth::logout();
  session()->invalidate();
  session()->regenerateToken();

  return redirect()->route('login');
})->name('logout');

Route::middleware('auth')->group(function () {
  Route::get('/', Home::class)->name('home');

  Route::prefix('economic-groups')->group(function () {
    Route::get('/', EconomicGroupsList::class)->name('economic-groups');
    Route::get('/create', CreateEconomicGroup::class)->name('economic-groups.create');
    Route::get('/edit/{id}', EditEconomicGroup::class)->name('economic-groups.edit');
  });

  Route::prefix('brands')->group(function () {
    Route::get('/', BrandsList::class);
  });

  Route::prefix('units')->group(function () {
    Route::get('/', UnitsList::class);
  });

  Route::prefix('employees')->group(function () {
    Route::get('/', EmployeesList::class);
  });
});
