<?php

namespace App\Models;

//* Importações de tipagem
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//* Importações de libs
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

//* Importações dos logs
use App\Enum\LogEnum;
use App\Models\Log\EmployeeLog;

class Employee extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'cpf',
    'unit_id'
  ];

  /** BOOT **/
  // logs
  protected static function boot()
  {
    parent::boot();

    static::created(function ($employee) {
      $auth = Auth::user();

      EmployeeLog::create([
        'employee_id' => $employee->id,
        'action'      => LogEnum::CREATED,
        'new_values'  => json_encode($employee->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::updated(function ($employee) {
      $auth = Auth::user();

      EmployeeLog::create([
        'employee_id' => $employee->id,
        'action'      => LogEnum::UPDATED,
        'old_values'  => json_encode($employee->getOriginal()),
        'new_values'  => json_encode($employee->getChanges()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });

    static::deleted(function ($employee) {
      $auth = Auth::user();

      EmployeeLog::create([
        'employee_id' => $employee->id,
        'action'      => LogEnum::DELETED,
        'old_values'  => json_encode($employee->toArray()),

        'performer_id'   => $auth->id,
        'performer_name' => $auth->name,
      ]);
    });
  }

  /** RELATIONSHIPS **/
  public function unit(): BelongsTo
  {
    return $this->belongsTo(Unit::class);
  }
}
