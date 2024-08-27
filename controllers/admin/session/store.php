<?php

use Core\App;
use Core\Database;
use Core\Validator;

$name = $_POST['name'];
$password = $_POST['password'];

$errors = [];
if (!Validator::string($name)) {
  $errors['name'] =  'Por favor informe um nome válido';
}

if (!Validator::string($password)) {
  $errors['password'] =  'Por favor informe uma senha válida';
}

if (!empty($errors)) {
  return view('session/create.view.php', [
    'errors' => $errors
  ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where name = :name', [
  ':name' => $name,
])->find();


// See if normal password is equals to hashed password on database
if ($user && password_verify($password, $user['password'])) {
  login([
    'name' => $name
  ]);

  header('location: /admin');
  exit();
}

// No user OR user with wrong password hit this point

return view('session/create.view.php', [
  'errors' => [
    'general' => 'Senha ou nome incorretos.'
  ]
]);
