<?php
$router->get('/', 'user/index.php');
$router->post('/search', 'user/search.php');
$router->get('/avisos', 'user/avisos.php');

$router->get('/login', 'admin/session/create.php');
$router->post('/login', 'admin/session/store.php')->only('guest');
$router->post('/logout', 'admin/session/destroy.php')->only('auth');

$router->get('/admin', 'admin/cronograma/index.php')->only('auth');
$router->post('/admin/new', 'admin/cronograma/store.php')->only('auth');
$router->patch('/admin/update', 'admin/cronograma/update.php')->only('auth');

$router->get('/admin/avisos', 'admin/avisos/index.php')->only('auth');
$router->get('/admin/avisos/new', 'admin/avisos/create.php')->only('auth');
$router->post('/admin/avisos/new', 'admin/avisos/store.php')->only('auth');

$router->get('/admin/avisos/edit', 'admin/avisos/edit.php')->only('auth');
$router->patch('/admin/avisos/update', 'admin/avisos/update.php')->only('auth');
$router->delete('/admin/avisos/delete', 'admin/avisos/destroy.php')->only('auth');
