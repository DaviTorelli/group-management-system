<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    //** GRUPOS ECONÔMICOS **//
    Schema::create('economic_group_logs', function (Blueprint $table) {
      $table->id();
      $table->string('economic_group_id');
      $table->string('action'); // 'created', 'updated', 'deleted'
      $table->json('old_values')->nullable();
      $table->json('new_values')->nullable();

      $table->timestamps();

      // salvando quem fez como string, para que caso o usuário seja excluído, não percamos os dados
      $table->string('performer_id');
      $table->string('performer_name');
    });

    //** BANDEIRAS **//
    Schema::create('flag_logs', function (Blueprint $table) {
      $table->id();
      $table->string('flag_id');
      $table->string('action'); // 'created', 'updated', 'deleted'
      $table->json('old_values')->nullable();
      $table->json('new_values')->nullable();

      $table->timestamps();

      // salvando quem fez como string, para que caso o usuário seja excluído, não percamos os dados
      $table->string('performer_id');
      $table->string('performer_name');
    });

    //** UNIDADES **//
    Schema::create('unit_logs', function (Blueprint $table) {
      $table->id();
      $table->string('unit_id');
      $table->string('action'); // 'created', 'updated', 'deleted'
      $table->json('old_values')->nullable();
      $table->json('new_values')->nullable();

      $table->timestamps();

      // salvando quem fez como string, para que caso o usuário seja excluído, não percamos os dados
      $table->string('performer_id');
      $table->string('performer_name');
    });

    //** COLABORADORES **//
    Schema::create('employee_logs', function (Blueprint $table) {
      $table->id();
      $table->string('employee_id');
      $table->string('action'); // 'created', 'updated', 'deleted'
      $table->json('old_values')->nullable();
      $table->json('new_values')->nullable();

      $table->timestamps();

      // salvando quem fez como string, para que caso o usuário seja excluído, não percamos os dados
      $table->string('performer_id');
      $table->string('performer_name');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('economic_group_logs');
    Schema::dropIfExists('flag_logs');
    Schema::dropIfExists('unit_logs');
    Schema::dropIfExists('employee_logs');
  }
};
