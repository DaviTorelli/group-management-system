<?php

namespace App\Models\Log;

//* Importações de libs
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//* Importação do enum para os logs
use App\Enum\LogEnum;

class FlagLog extends Model
{
  use HasFactory;

  protected $table = 'flag_logs';

  protected $fillable = [
    'flag_id',
    'action',
    'old_values',
    'new_values',
    'performer_id',
    'performer_name'
  ];

  protected $casts = [
    'old_values' => 'array',
    'new_values' => 'array',
    'action'     => LogEnum::class,
  ];
}
