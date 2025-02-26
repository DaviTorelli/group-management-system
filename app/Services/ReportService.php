<?php

namespace App\Services;

// serviços para controle de relatórios

class ReportService
{
  public static function getRandomColor(String $name)
  {
    // Armazena as cores geradas para manter consistência
    static $colors = [];

    if (!isset($colors[$name])) {
      // Gera uma cor aleatória
      $colors[$name] = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
    }

    return $colors[$name];
  }
}
