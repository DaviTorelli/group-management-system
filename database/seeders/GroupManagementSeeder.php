<?php

namespace Database\Seeders;

//* Importações de libs
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupManagementSeeder extends Seeder
{
  public function run(): void
  {
    $now = Carbon::now();

    // Inserindo grupos econômicos
    $economicGroups = [
      ['name' => 'Grupo Alpha', 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Grupo Beta',  'created_at' => $now, 'updated_at' => $now],
    ];
    DB::table('economic_groups')->insert($economicGroups);

    // Pegando IDs dos grupos
    $economicGroups = DB::table('economic_groups')->pluck('id')->toArray();

    // Inserindo bandeiras
    $flags = [
      ['name' => 'Bandeira X', 'economic_group_id' => $economicGroups[0], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Bandeira Y', 'economic_group_id' => $economicGroups[1], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Bandeira Z', 'economic_group_id' => $economicGroups[1], 'created_at' => $now, 'updated_at' => $now],
    ];
    DB::table('flags')->insert($flags);

    // Pegando IDs das bandeiras
    $flags = DB::table('flags')->pluck('id')->toArray();

    // Inserindo unidades
    $units = [
      ['legal_name' => 'Unidade 1 LTDA', 'fantasy_name' => 'Unidade 1', 'cnpj' => '12345678000199', 'flag_id' => $flags[0], 'created_at' => $now, 'updated_at' => $now],
      ['legal_name' => 'Unidade 2 LTDA', 'fantasy_name' => 'Unidade 2', 'cnpj' => '98765432000188', 'flag_id' => $flags[1], 'created_at' => $now, 'updated_at' => $now],
    ];
    DB::table('units')->insert($units);

    // Pegando IDs das unidades
    $units = DB::table('units')->pluck('id')->toArray();

    // Inserindo funcionários
    $employees = [
      ['name' => 'John Lennon',     'email' => 'john.lennon@email.com',     'cpf' => '11122233344', 'unit_id' => $units[0], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Freddie Mercury', 'email' => 'freddie.mercury@email.com', 'cpf' => '22233344455', 'unit_id' => $units[0], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Elvis Presley',   'email' => 'elvis.presley@email.com',   'cpf' => '33344455566', 'unit_id' => $units[1], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Whitney Houston', 'email' => 'whitney.houston@email.com', 'cpf' => '44455566677', 'unit_id' => $units[1], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Madonna Ciccone', 'email' => 'madonna.ciccone@email.com', 'cpf' => '55566677788', 'unit_id' => $units[0], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'David Bowie',     'email' => 'david.bowie@email.com',     'cpf' => '66677788899', 'unit_id' => $units[1], 'created_at' => $now, 'updated_at' => $now],
      ['name' => 'Paul McCartney',  'email' => 'paul.mccartney@email.com',  'cpf' => '77788899900', 'unit_id' => $units[1], 'created_at' => $now, 'updated_at' => $now],
    ];
    DB::table('employees')->insert($employees);
  }
}
