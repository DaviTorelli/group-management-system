<?php

namespace App\Enum;

enum LogEnum: string
{
  case CREATED = 'created';
  case UPDATED = 'updated';
  case DELETED = 'deleted';
}
