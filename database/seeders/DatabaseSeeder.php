<?php

namespace Database\Seeders;

//* Importações de libs
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

//* Importações de models
use App\Models\User;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([UserSeeder::class]);

    // em produção (APP_DEBUG=false), não rodamos a seed GMS
    if (config('app.debug')) $this->call([GroupManagementSeeder::class]);
  }
}
