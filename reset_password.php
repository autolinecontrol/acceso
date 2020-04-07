<?php
require 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['nuevopassword']===$_POST['confirmarpassword']){
        $nuevo_password = $_POST['nuevopassword'];
        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);
         
        
        $sql = "UPDATE funcionarios SET password= '$nuevo_password', hash= '$hash' WHERE email= '$email'";
        
        if($mysqli->query($sql)){
            
            echo "<a href='http://centralpointacceso.com/acceso/LOGIN/index.php'>INICIO</a>";
            $_SESSION['message']="tu contraseña ha sido  actualizada";
            header("Location: success.php");
            exit();
            
        }else{    
            $_SESSION['message']="Error en la actualizacion!";
            header("Location: error.php!;");
            exit();
        }
        
    }

    
}

else{
     $_SESSION['message']="Las dos contraseñas que ingresaste no coinciden!";
     header("Location: error.php");
     exit();
}

?>