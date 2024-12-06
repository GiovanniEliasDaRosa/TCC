<?php

// // [ UNCOMENT THE CODE BELLOW TO CREATE A NEW USER IN THE USERS TABLE ]
// // name: admin | password: 123

// use Core\App;
// use Core\Database;

// $db = App::resolve(Database::class);

// $db->query('INSERT INTO Tb_usuario(nome, senha) VALUES(:name, :password)', [
//   'name' => 'admin',
//   'password' => password_hash('123', PASSWORD_BCRYPT),
// ]);

use Core\Session;

if ($_SESSION['user'] ?? false) {
  redirect('/admin');
}

view('session/create.view.php', [
  'errors' => Session::get('errors'),
  'title' => 'Login',
  'headerSelected' => 'login'
]);
