<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Session;

class Authenticator
{
  public function attempt($name, $password)
  {
    $user = (App::resolve(Database::class))->query('select * from Tb_usuario where nome = :nome', [
      ':nome' => $name,
    ])->find();

    // See if normal password is equals to hashed password on database
    if ($user && password_verify($password, $user['senha'])) {
      $this->login([
        'name' => $name
      ]);

      return true;
    }

    return false;
  }


  public function login($user)
  {
    $_SESSION['user'] = [
      'name' => $user['nome']
    ];

    session_regenerate_id(true);
  }

  public function logout()
  {
    Session::destroy();
  }
}
