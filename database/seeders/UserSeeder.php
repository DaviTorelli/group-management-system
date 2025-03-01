<?php

namespace Database\Seeders;

//* Importações de libs
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

//* Importações de models
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    User::factory()->create([
      'name'     => 'Michael Jackson',
      'email'    => 'michael.jackson@email.com',
      'password' => Hash::make("password")
    ]);
  }
}
