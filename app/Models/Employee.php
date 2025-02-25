<?php

namespace App\Models;

//* Importações de tipagem
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//* Importações de libs
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'cpf',
    'unit_id'
  ];

  /** RELATIONSHIPS **/
  public function unit(): BelongsTo
  {
    return $this->belongsTo(Unit::class);
  }
}
