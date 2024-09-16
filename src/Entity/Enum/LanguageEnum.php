<?php

namespace App\Entity\Enum;

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

  public static function getLanguagesAbbreviated(): array
  {
    return [
      'pt' => self::PT->value,
      'es' => self::ES->value,
      'en' => self::EN->value,
    ];
  }


  public static function getLanguageId($index): string
  {
    $value = [
      'pt' => self::PT->value,
      'es' => self::ES->value,
      'en' => self::EN->value,
      "" => ''
    ];

    return $value[$index];
  }

  public static function getLanguageName($index): string
  {
    $value = [
      self::PT->value => 'Português',
      self::ES->value => 'Espanhol',
      self::EN->value => 'Inglês',
      "" => ''
    ];

    return $value[$index];
  }

  public static function getFlag($index): string
  {
    $value = [
      self::PT->value => '<div class="d-none"> pt </div> <img src="/assets/images/flags/Flag_of_Brazil.svg" alt="Bandeira do Brasil" width="20"/> Português',
      self::ES->value => '<div class="d-none"> sp </div> <img src="/assets/images/flags/Flag_of_Spain.svg" alt="Bandeira do Spain" width="20"/> Espanhol',
      self::EN->value => '<div class="d-none"> en </div> <img src="/assets/images/flags/Flag_of_the_United_Kingdom.svg" alt="Bandeira do Reino Unido" width="20"/> Inglês',
      "" => ''
    ];

    return $value[$index];
  }
}