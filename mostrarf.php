<?php
require 'db.php';
require 'conexion.php';

ob_start();
session_start();




if($_SESSION['logged_in']!== true){
    header("Location: index.php");
    exit();
}else{
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");

    if($result-> num_rows === 0){
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else{
        $resultoficina=mysqli_query($con,"SELECT oficinas.Nombre FROM funcionarios INNER JOIN oficinas ON oficinas.Numero = funcionarios.oficina WHERE email='$email'");
        while($recorrer = mysqli_fetch_assoc( $resultoficina))
            {
                $nombreoficina=$recorrer['Nombre'];
            }
        $user = $result->fetch_assoc();
        $activo = $user['activo'];
        
       
    }
    
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
       <title>Funcionarios</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	</head>
    
        <body>
            
            <div class="form">
            <?php
            if(!$activo){
                echo "<div class = 'alert alert-info'>
                    Tu cuenta fue creada! Te acabamos de enviar un correo, 
                    por favor confirma tu cuenta haciendo click en el link enviado, gracias.
                    </div>";
            }
            require_once 'banner.php';
            ?>
           
		
			<br>

            <div class="header-second-bar">

                <div class="header-limiter">
                </div>

            </div>

        </header>
            <div id="wrapper">
            <div id="info"></div>
        </div>
        <script type="text/javascript">
            var resultado = document.getElementById("info");
            
            function mostrarUsuarios()
            {
                var xmlhttp; 
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest;
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState===4 && xmlhttp.status === 200)
                    {
                        resultado.innerHTML = xmlhttp.responseText;
                    }
                }
                
                xmlhttp.open("GET","servidorf.php?personas=" + "personas", true)
                
                xmlhttp.send();
                
            }
            mostrarUsuarios();
            function editarUsuario(usuarioID) 
            {
                var nombreID        = "nombreID" + usuarioID;
                var emailID         = "emailID" + usuarioID;
                var borrar          = "borrar" + usuarioID;
                var actualizar      = "actualizar" + usuarioID;
                var ingresoID       = "ingresoID" + usuarioID;
                var salidaID       = "salidaID" + usuarioID;
                var editarIngresoID  = ingresoID + "-editar";
                var editarSalidaID  = salidaID + "-editar";
                
                var ingresoDelUsuario= document.getElementById(ingresoID).innerHTML;
                var salidaDelUsuario= document.getElementById(salidaID).innerHTML;
                var parent = document.querySelector("#" + ingresoID);
                
                
                if(parent.querySelector("#" + editarIngresoID)=== null){
                    document.getElementById(ingresoID).innerHTML = '<input type = "text" id = "' + editarIngresoID + '" value="'+ingresoDelUsuario+'">';
                    document.getElementById(salidaID).innerHTML = '<input type = "text" id = "' + editarSalidaID + '" value="'+salidaDelUsuario+'">';
                    document.getElementById(borrar).disabled = "true";
                    document.getElementById(actualizar).style.display= "block";
                }
            }
            function actualizarUsuario(usuarioID)
            {
                var xmlhttp; 
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest;
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                var ingresoActualizado = document.getElementById("ingresoID" + usuarioID + "-editar").value;
                var salidaActualizado = document.getElementById("salidaID" + usuarioID + "-editar").value;
                
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState===4 && this.status === 200)
                    {
                        mostrarUsuarios();
                    }
                }
                
                xmlhttp.open("GET","servidorf.php?usuarioIDActualizado="+ usuarioID + "&ingresoActualizado=" + ingresoActualizado + "&salidaActualizado=" + salidaActualizado, true);
                xmlhttp.send();
                
            }
            function borrarUsuario(usuarioID)
            {
                var respuesta = confirm("Estas Seguro de borrar este usuario?");
                
                if(respuesta===true)
                {
                    if(window.XMLHttpRequest){
                        xmlhttp = new XMLHttpRequest;
                    }else{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                
                   
                    xmlhttp.onreadystatechange = function()
                    {
                        if(this.readyState===4 && this.status === 200)
                        {
                            mostrarUsuarios();
                        }
                    }
                    
                    xmlhttp.open("GET","servidorf.php?usuarioIDEliminado="+usuarioID);
                    xmlhttp.send();
                }
            }
            
            var overlay = document.getElementById("overlay");
            var nuevaVentana = document.getElementById("nuevaVentana");
            
            function ejecutarNuevaVentana()
            {
                overlay.style.opacity = .5;
                
                 if(overlay.style.display === "block"){
                    overlay.style.display = "none";
                    nuevaVentana.style.display = "none";
                }else{
                    overlay.style.display = "block";
                    nuevaVentana.style.display = "block";
                }
                
                document.getElementById("nuevoUsuarioID").value ="";
                document.getElementById("nuevoEmailID").value ="";
                
            }
            
            function agregarUsuario()
            {
                overlay.style.display = "none";
                nuevaVentana.style.display = "none";
                
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest;
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                var nuevaOficina = document.getElementById("nuevaOficina").value;
                
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState===4 && this.status === 200)
                    {
                        mostrarUsuarios();
                    }
                }
                xmlhttp.open("GET","servidorf.php?personas=" + "personas"+
                        "&nuevaOficina="+nuevaOficina,true);
                xmlhttp.send();
            }
        </script>    
         
        </body>    
</html>