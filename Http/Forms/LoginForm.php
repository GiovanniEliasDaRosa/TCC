<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    if (!Validator::string($attributes['name'])) {
      $this->errors['name'] =  'Por favor informe um nome válido';
    }

    if (!Validator::string($attributes['password'])) {
      $this->errors['password'] =  'Por favor informe uma senha válida';
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);

    return $instance->failed() ? $instance->throw() : $instance;
  }

  public function throw()
  {
    ValidationException::throw($this->errors(), $this->attributes);
  }


  public function failed()
  {
    return count($this->errors);
  }


  public function errors()
  {
    return $this->errors;
  }

  public function error($field, $message)
  {
    $this->errors[$field] = $message;

    return $this;
  }
}
