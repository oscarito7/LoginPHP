<?php
require 'database.php';
$message = '';
if(!empty($_POST['email'])&& !empty($_POST['password'])){
    $sql = "INSERT INTO users (email, password) VALUES (:email,:password)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if($stmt->execute()){
        $message = 'Nuevo usuario creado satisfactoriamente ';


    }else{
        $message= 'no se pudo crear un usuario ';
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
<body class="registro">
        <?php
        require 'partials/header.php'
            ?>
            <?php
        if(!empty($message)): ?>
        <p>
            <?= $message?>
        </p>
                <?php endif?>
        <h1>Registrate</h1>
        <span> o <a href="login.php">Logeate</a></span>

        <form action="singup.php" method="POST">
    <input type="text" name="email" placeholder="favor ingresa tu correo">
        </br>
    <input type="password" name="password" placeholder="ingresa tu contraseña">
    </br>
    <input type="password" name="confirma" placeholder="confirma tu contraseña">
    </br>

    <input type="submit"  value="Enviar">
    </form>
</body>
</html>