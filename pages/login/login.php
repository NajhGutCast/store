<!DOCTYPE html>
<html lang="es">

<head>
  <?php include_once '../../components/no-cache.php'; ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./images/logo.svg" type="image/svg+xml">
  <title>Store | Login</title>
  <link rel="stylesheet" href="./pages/login/login.css">
</head>

<body>
  <div id="loader">
    <span></span>
  </div>
  <div id="main">
    <span id="square"></span>
    <span id="triangle"></span>
    <form id="form" class="form" autoComplete="off">
      <div class="form-header">
        <div class="form-img">
          <img id="image" src="./images/logo.svg" alt="Activity de SoDe" />
        </div>
        <h2 id="title" class='form-title'>Store | Login</h2>
        <p id="description" class='form-description'>Inicie sesión para continuar</p>
      </div>
      <div class="form-body">
        <input id="input" type="text" value required />
        <label id="label" for="input">Nombre de usuario</label>
        <input type="checkbox" id="checkbox">
        <label for="checkbox">Recuerdame</label>
        <button id="btn_submit" type="submit">Verificar</button>
      </div>
      <div class="form-footer">
        <button id="btn_forgot" type="button">
          Olvidé mi contraseña
        </button>
      </div>
    </form>
  </div>
  <div></div>

  <script type="text/javascript" src="./gLibraries/gcookie"></script>
  <script type="text/javascript" src="./gLibraries/gnotify"></script>
  <script type="text/javascript" src="./gLibraries/gjson"></script>
  <script type="text/javascript" src="./script/login/<?php echo uniqid(); ?>"></script>
</body>

</html>