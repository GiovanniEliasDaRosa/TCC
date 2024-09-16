<?php

use Http\Forms\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
  'name' => $_POST['name'],
  'password' => $_POST['password']
]);

$signedIn = (new Authenticator())->attempt($attributes['name'], $attributes['password']);

if (!$signedIn) {
  $form->error('general', 'Senha ou nome incorretos.')->throw();
}

redirect('/admin');
