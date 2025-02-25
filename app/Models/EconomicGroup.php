<?php

namespace App\Models;

//* Importações de tipagem
use Illuminate\Database\Eloquent\Relations\HasMany;

//* Importações de libs.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

//* Importações dos logs
use App\Enum\LogEnum;
use App\Models\Log\EconomicGroupLog;

class EconomicGroup extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  /** BOOT **/
  // logs
  protected static function boot()
  {
    parent::boot();

    static::created(function ($economicGroup) {
      $auth = Auth::user();

      EconomicGroupLog::create([
        'economic_group_id' => $economicGroup->id,
        'action'     => LogEnum::CREATED,
        'new_values' => json_encode($economicGroup->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::updated(function ($economicGroup) {
      $auth = Auth::user();

      EconomicGroupLog::create([
        'economic_group_id' => $economicGroup->id,
        'action'     => LogEnum::UPDATED,
        'old_values' => json_encode($economicGroup->getOriginal()),
        'new_values' => json_encode($economicGroup->getChanges()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::deleted(function ($economicGroup) {
      $auth = Auth::user();

      EconomicGroupLog::create([
        'economic_group_id' => $economicGroup->id,
        'action'     => LogEnum::DELETED,
        'old_values' => json_encode($economicGroup->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });
  }

  /** RELATIONSHIPS **/
  public function flags(): HasMany
  {
    return $this->hasMany(Flag::class);
  }
}
