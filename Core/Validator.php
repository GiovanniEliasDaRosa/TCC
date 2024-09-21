<?php

namespace Core;

class Validator
{
  public static function string($value, $min = 1, $max = INF)
  {
    $value = trim($value);
    return strlen($value) >= $min && strlen($value) <= $max;
  }

  public static function empty($value)
  {
    return trim($value) == "";
  }

  public static function dateIsLessThan($date1, $date2)
  {
    return strtotime($date1) < strtotime($date2);
  }
}
