<?php 
session_start();
require 'database.php';

if(isset($_SESSION['user_id'])){

    $records = $con->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records-> execute();
    $results= $records->fetch(PDO::FETCH_ASSOC);

    $user = null;
    if(count($results)>0){
            $user = $results;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

</head>
<body class="inicio"> 
        <?php
        require 'partials/header.php'
        ?>
        <?php  if(!empty($user)):?>
            <br>Bienvenido. <?= $user['email'];?>
            <br> Logeado satisfactoriamente
            <a href="logout.php">Cerrar Sesion</a>
        <?php else: ?>
    <h1>Por favor Inicia Sesion o crea un usuario </h1>
    
    <a href="login.php"> Login</a> or
    <a href="singup.php">Registro</a>
    <?php endif ?>
</body>
</html>