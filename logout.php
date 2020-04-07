<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cerrar Sesion</title>
        <link rel= "stylesheet" type="text/css" href= "css/style.css"/>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <?php include '/css/style.css';?>
    </head>
    <body>
        <div class="form">
            <h1>Haz cerrado tu Sesión </h1>
            <a href="index.php"><button class="button button-block"> HOME </button></a>
        </div>
    </body>
</html>

