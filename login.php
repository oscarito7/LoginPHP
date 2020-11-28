<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $con->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /login");
    } else {
      $message = 'Usuario o Password incorrectos';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body class="login">
    <?php
        require 'partials/header.php'
    ?>
    <h1>Logeate </h1>
    <span class="texto"> o <a href="singup.php">Registrate</a></span>
    <?php 
    if(!empty($message)): ?>
        <p><?= $message ?> </P>
    <?php endif ?>
    <form action="login.php" method="POST">
    <input type="text" name="email" placeholder="favor ingresa tu correo">
    </br>
    <input type="password" name="password" placeholder="ingresa tu contraseña">
    </br>
    <input type="submit"  value="Enviar">
    </form>

    
</body>
</html>