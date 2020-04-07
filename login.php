<?php
$email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
    
    if($result->num_rows === 0){
        $_SESSION['message']='No existe cuenta registrado con este correo';
        header("Location: error.php"); 
        exit();
    }else{
        $user = $result->fetch_assoc();
        if($_POST['password']===$user['password']){
            $_SESSION['email'] = $user['email'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['oficina'] = $user['oficina'];
            $_SESSION['logged_in']=true;
            header("Location:perfil.php");
            exit();
        }else{
            //echo $_POST['password']." ".$user['password'];
            echo "Entro con exito 1";
            $_SESSION['message']='La contraseña es incorrecta!';
            header("Location: error.php");
            exit();
        }
    }
?>

