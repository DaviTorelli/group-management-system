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
use App\Models\Log\FlagLog;

class Flag extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'economic_group_id'];

  /** BOOT **/
  // logs
  protected static function boot()
  {
    parent::boot();

    static::created(function ($flag) {
      $auth = Auth::user();

      FlagLog::create([
        'flag_id'    => $flag->id,
        'action'     => LogEnum::CREATED,
        'new_values' => json_encode($flag->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::updated(function ($flag) {
      $auth = Auth::user();

      FlagLog::create([
        'flag_id'    => $flag->id,
        'action'     => LogEnum::UPDATED,
        'old_values' => json_encode($flag->getOriginal()),
        'new_values' => json_encode($flag->getChanges()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::deleted(function ($flag) {
      $auth = Auth::user();

      FlagLog::create([
        'flag_id'    => $flag->id,
        'action'     => LogEnum::DELETED,
        'old_values' => json_encode($flag->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });
  }

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
