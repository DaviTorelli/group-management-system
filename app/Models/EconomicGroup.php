<?php

namespace App\Models;

//* Importações de libs.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomicGroup extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  /** RELATIONSHIPS **/
}
