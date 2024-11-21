<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

date_default_timezone_set('America/Sao_Paulo');

class WarnForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    if (!Validator::string($attributes['titulo'], 1, 40)) {
      $this->errors['titulo'] =  'Um título com mais de 40 caracteres não é necessário';
    }
    if (Validator::empty($attributes['titulo'])) {
      $this->errors['titulo'] =  'Adicione um título';
    }

    $invalidStartDate = false;

    if (empty($attributes['updating'])) {
      // Creating warning
      if (Validator::dateIsLessThan($attributes['dt_inicio'], date('Y-m-d'))) {
        $this->errors['dt_inicio'] =  'A data de postagem não pode ser no passado. Selecione uma data de hoje ou futura';
      }

      $invalidStartDate = Validator::empty($attributes['dt_inicio']);
    }

    $invalidEndDate = Validator::empty($attributes['dt_fim']);

    if (!$invalidStartDate && !$invalidEndDate) {
      if (Validator::dateIsLessThan($attributes['dt_fim'], $attributes['dt_inicio'])) {
        $this->errors['dt_fim'] =  'A data de expiração deve ser após a data de postagem. Selecione uma data válida';
      }
    }

    if ($invalidStartDate) {
      $this->errors['dt_inicio'] =  'Adicione a data de postagem';
    }

    if ($invalidEndDate) {
      $this->errors['dt_fim'] =  'Adicione a data de expiração';
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
