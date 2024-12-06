<!DOCTYPE html>
<html lang="pt-br" data-theme="<?= getTheme() ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? '' ?></title>

  <link rel="shortcut icon" href="/img/icons/icon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/icons.css">

  <script src="/js/main.js" defer="true"></script>
  <script>
    let FF_FOUC_FIX; // to prevent Firefox FOUC, this must be here
  </script>