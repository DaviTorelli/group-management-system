<?php

namespace Database\Seeders;

//* Importações de libs
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

//* Importações de models
use App\Models\User;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory()->create([
      'name'  => 'Test User',
      'email' => 'test@example.com',
      'password' => Hash::make("123123")
    ]);
  }
}
