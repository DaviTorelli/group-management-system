<?php

//* Importações de libs
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//* Componentes Livewire
//auth
use App\Livewire\Auth\Login;

//home
use App\Livewire\Private\Home;

//grupo economico
use App\Livewire\Private\EconomicGroup\CreateEconomicGroup;
use App\Livewire\Private\EconomicGroup\EconomicGroupsList;
use App\Livewire\Private\EconomicGroup\EditEconomicGroup;

//bandeira
use App\Livewire\Private\Flag\CreateFlag;
use App\Livewire\Private\Flag\EditFlag;
use App\Livewire\Private\Flag\FlagsList;

//unidade
use App\Livewire\Private\Unit\CreateUnit;
use App\Livewire\Private\Unit\EditUnit;
use App\Livewire\Private\Unit\UnitsList;

//colaborador
use App\Livewire\Private\Employee\CreateEmployee;
use App\Livewire\Private\Employee\EditEmployee;
use App\Livewire\Private\Employee\EmployeesList;
use App\Livewire\Private\Employee\ViewEmployee;

//relatorios
use App\Livewire\Private\Report\EconomicGroupEmployees;
use App\Livewire\Private\Report\FlagEmployees;
use App\Livewire\Private\Report\UnitEmployees;

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

  Route::prefix('flags')->group(function () {
    Route::get('/', FlagsList::class)->name('flags');
    Route::get('/create', CreateFlag::class)->name('flags.create');
    Route::get('/edit/{id}', EditFlag::class)->name('flags.edit');
  });

  Route::prefix('units')->group(function () {
    Route::get('/', UnitsList::class)->name('units');
    Route::get('/create', CreateUnit::class)->name('units.create');
    Route::get('/edit/{id}', EditUnit::class)->name('units.edit');
  });

  Route::prefix('employees')->group(function () {
    Route::get('/', EmployeesList::class)->name('employees');
    Route::get('/create', CreateEmployee::class)->name('employees.create');
    Route::get('/edit/{id}', EditEmployee::class)->name('employees.edit');
    Route::get('/view/{id}', ViewEmployee::class)->name('employees.view');
  });

  Route::prefix('reports')->group(function () {
    Route::get('/units', UnitEmployees::class)->name('unit-employees');
    Route::get('/flags', FlagEmployees::class)->name('flag-employees');
    Route::get('/economic-groups', EconomicGroupEmployees::class)->name('economic-group-employees');
  });
});
