<?php
$router->get('/', 'controllers/user/index.php');
$router->post('/', 'controllers/user/index.php');
$router->get('/avisos', 'controllers/user/avisos.php');

$router->get('/login', 'controllers/admin/session/create.php');
$router->post('/session', 'controllers/admin/session/store.php')->only('guest');
$router->post('/admin/logout', 'controllers/admin/session/destroy.php')->only('auth');

$router->get('/admin', 'controllers/admin/cronograma/index.php')->only('auth');
$router->get('/admin/new', 'controllers/admin/cronograma/store.php')->only('auth');
$router->get('/admin/update', 'controllers/admin/cronograma/update.php')->only('auth');

$router->get('/admin/avisos', 'controllers/admin/avisos/index.php')->only('auth');
$router->get('/admin/avisos/new', 'controllers/admin/avisos/create.php')->only('auth');
$router->post('/admin/avisos/new', 'controllers/admin/avisos/store.php')->only('auth');

$router->get('/admin/avisos/edit', 'controllers/admin/avisos/edit.php')->only('auth');
$router->patch('/admin/avisos/update', 'controllers/admin/avisos/update.php')->only('auth');
$router->delete('/admin/avisos/delete', 'controllers/admin/avisos/destroy.php')->only('auth');
