<?php

namespace App\Models;

//* Importação de tipagem
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//* Importação de libs
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

//* Importações dos logs
use App\Enum\LogEnum;
use App\Models\Log\UnitLog;

class Unit extends Model
{
  use HasFactory;

  protected $fillable = [
    'fantasy_name',
    'legal_name',
    'cnpj',
    'flag_id'
  ];

  /** BOOT **/
  // logs
  protected static function boot()
  {
    parent::boot();

    static::created(function ($unit) {
      $auth = Auth::user();

      UnitLog::create([
        'unit_id'    => $unit->id,
        'action'     => LogEnum::CREATED,
        'new_values' => json_encode($unit->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::updated(function ($unit) {
      $auth = Auth::user();

      UnitLog::create([
        'unit_id'    => $unit->id,
        'action'     => LogEnum::UPDATED,
        'old_values' => json_encode($unit->getOriginal()),
        'new_values' => json_encode($unit->getChanges()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::deleted(function ($unit) {
      $auth = Auth::user();

      UnitLog::create([
        'unit_id'    => $unit->id,
        'action'     => LogEnum::DELETED,
        'old_values' => json_encode($unit->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });
  }

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
