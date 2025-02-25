<?php

namespace App\Models;

//* Importação de tipagem
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//* Importação de libs
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'economic_group_id'];

  /** RELATIONSHIPS **/
  public function economicGroup(): BelongsTo
  {
    return $this->belongsTo(EconomicGroup::class);
  }

  public function units(): HasMany
  {
    return $this->hasMany(Unit::class);
  }
}
