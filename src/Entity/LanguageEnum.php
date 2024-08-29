<?php

namespace App\Entity;

enum LanguageEnum: int
{
  case PT = 1;
  case ES = 2;
  case EN = 3;

  public static function getLanguages(): array
  {
    return [
      'Português' => self::PT->value,
      'Espanhol' => self::ES->value,
      'Inglês' => self::EN->value,
    ];
  }
}