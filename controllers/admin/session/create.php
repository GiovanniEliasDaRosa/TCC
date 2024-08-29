<?php

// use Core\App;
// use Core\Database;

// $db = App::resolve(Database::class);

// $db->query('INSERT INTO users(name, password) VALUES(:name, :password)', [
//   'name' => 'admin',
//   'password' => password_hash('123', PASSWORD_BCRYPT),
// ]);


if ($_SESSION['user'] ?? false) {
  header('location: /admin');
  exit();
}

view('session/create.view.php');
