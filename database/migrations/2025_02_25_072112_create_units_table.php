<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('units', function (Blueprint $table) {
      $table->id();
      $table->string("legal_name", 100);
      $table->string("fantasy_name", 100);
      $table->string("cnpj", 14);

      $table->foreignId('flag_id')->constrained();

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('units');
  }
};
