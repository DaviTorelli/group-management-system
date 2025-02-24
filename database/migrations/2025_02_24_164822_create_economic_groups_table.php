<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('economic_groups', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('economic_groups');
  }
};
