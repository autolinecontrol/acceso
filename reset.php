<?php
require 'db.php';
session_start();

if(isset($_GET['email'])&& !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email=$mysqli->escape_string($_GET['email']);
    $hash=$mysqli->escape_string($_GET['hash']);
    
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email= '$email' AND hash='$hash'");
    
    if($result->num_rows > 0){
        //echo $email;
    }else{
  
        $_SESSION['message']="Has ingresado a una URL invalida para cambiar contraseña!";
        header("Location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cambiar Contraseña</title>
        <meta charset="UTF-8">
        <?php include 'css/css.html';?>
        
    </head>
    <body>
        <div class="form">
            <h1>Escoge tu nueva contraseña</h1>
            <form action="reset_password.php" method="post">
                <div class="field-wrap">
                    <input type="password" class="form-control" name="nuevopassword" placeholder="Nueva contraseña" required/>
                </div>
                <br/>
                <div class="field-wrap">
                    <input type="password" class="form-control" name="confirmarpassword" placeholder="Confirma password" required/>
                </div>
                
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="hash" value="<?= $hash ?>"> <br/>
                
                <button class="button button-block"/>Actualizar</button>
            </form>
        </div>
    </body>
</html>