<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Session;

class Authenticator
{
  public function attempt($name, $password)
  {
    $user = (App::resolve(Database::class))->query('select * from users where name = :name', [
      ':name' => $name,
    ])->find();

    // See if normal password is equals to hashed password on database
    if ($user && password_verify($password, $user['password'])) {
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
      'email' => $user['email']
    ];

    session_regenerate_id(true);
  }

  public function logout()
  {
    Session::destroy();
  }
}
