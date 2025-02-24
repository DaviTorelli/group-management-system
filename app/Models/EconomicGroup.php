<?php

namespace App\Models;

//* Importações de tipagem
use Illuminate\Database\Eloquent\Relations\HasMany;

//* Importações de libs.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomicGroup extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  /** RELATIONSHIPS **/
  public function flags(): HasMany
  {
    return $this->hasMany(Flag::class);
  }
}
