<?php

namespace App\Models;

//* Importação de tipagem
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//* Importação de libs
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
  use HasFactory;

  protected $fillable = [
    'fantasy_name',
    'legal_name',
    'cnpj',
    'flag_id'
  ];

  /** RELATIONSHIPS **/
  public function flag(): BelongsTo
  {
    return $this->belongsTo(Flag::class);
  }

  public function employees(): HasMany
  {
    return $this->hasMany(Employee::class);
  }
}
