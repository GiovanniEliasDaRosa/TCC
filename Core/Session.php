<?php

namespace Core;

class Session
{
  public static function has($key)
  {
    return (bool) static::get($key);
  }

  public static function put($key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }

  public static function get($key, $default = null)
  {
    return $_SESSION[$key] ?? $_SESSION['_flash'][$key] ?? $default;
  }

  public static function flash($key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }

  public static function unflash()
  {
    unset($_SESSION['_flash']);
  }

  public static function flush()
  {
    $_SESSION = [];
  }

  public static function destroy()
  {
    static::flush();
    session_destroy();

    $params = session_get_cookie_params();
    // 3600 = 1hour
    setcookie('PHPSESSID', '', [
      'expires' => time() - 3600,
      'path' => $params['path'],
      'domain' => $params['domain'],
      'secure' => $params['secure'],
      'httponly' => $params['httponly'],
      'samesite' => 'Strict',
    ]);
  }
}
