<?php

namespace Core;

use Exception;

class Container
{
  protected $bindings = [];

  public function bind($key, $resolver)
  {
    // add
    $this->bindings[$key] = $resolver;
  }

  public function resolve($key)
  {
    // remove
    if (!array_key_exists($key, $this->bindings)) {
      throw new \Exception("No matching binding found for {$key}");
    }

    $resolver = $this->bindings[$key];

    return call_user_func($resolver);
  }
}
