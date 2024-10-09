<?php

if (isset($_POST['selectedClass'])) {
  // Loaded from POST
  if ($_POST['selectedClass'] != null) {
    $selectedClass = $_POST['selectedClass'];
  }

  // Save selected class
  $days = time() + 60 * 60 * 24 * 30; // 30 days
  $params = session_get_cookie_params();
  setcookie('selectedClass', $selectedClass, [
    'expires' => $days,
    'path' => $params['path'],
    'domain' => $params['domain'],
    'secure' => $params['secure'],
    'httponly' => $params['httponly'],
    'samesite' => 'Strict',
  ]);
}

header('location: /');
