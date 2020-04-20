<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
         $user = $result->fetch_assoc();
         $activo = $user['activo'];
         //echo $activo;
      
     }
    
 }
?>
<head>
     <link href="/StyleSheet.css" rel="stylesheet" />
     <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
     <title>Subir Masivos</title>
     <link rel="stylesheet" href="assets/demo.css">
     <link rel="stylesheet" href="assets/header-second-bar.css">
     <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
<form method="post" action="subirv.php" enctype="multipart/form-data" id="testform">
     <div class="form">
     <?php
      if($activo<2)
      {
          session_start();
          session_unset();
          session_destroy();
      echo '<h1>No tienes el Perfil para Activar Funcionarios </h1>';
      echo '<a href="index.php">Inicio</a>';
      }
     
     include 'banner.php';
     ?>
     <br><br>
     <ol>
          <li>
               <label>Administrador:</label><br>
               <input type="text" name="admin" placeholder="Nombres Apellidos" id ="nuevoUsuarioID" value="<?php echo $nombre; ?>"  readonly />
          </li>
          <br>
          
          <label >Grupo Acceso</label>
                    <select name="grupoacceso" class="form-control">
                    <?php
                    $sqlgrupoacceso="SELECT * FROM grupo_acceso";
                    $resultadoogrupoacceso = mysqli_query($con,$sqlgrupoacceso);
                    while($recorrergrupoacceso = mysqli_fetch_assoc($resultadoogrupoacceso))
                    {
                        echo '<option value="'.$recorrergrupoacceso['id'].'">'.$recorrergrupoacceso['nombre'].'</option>';
                    }
                    ?>
                    </select>
                    <br>
          <label >*Grupo Horario</label>
                    <select name="grupohorario" class="form-control">
                    <?php
                    $sqlgrupoacceso="SELECT * FROM grupo_horario";
                    $resultadoogrupoacceso = mysqli_query($con,$sqlgrupoacceso);
                    while($recorrergrupoacceso = mysqli_fetch_assoc($resultadoogrupoacceso))
                    {
                        echo '<option value="'.$recorrergrupoacceso['idhorario'].'">'.$recorrergrupoacceso['nombre'].'</option>';
                    }
                    ?>
                    </select>
                    <br>
                    <label for="autoriza">*Grupo Dias</label>
                    <select name="grupodias" class="form-control">
                    <?php
                    $sqlgrupoacceso="SELECT * FROM grupo_dia";
                    $resultadoogrupoacceso = mysqli_query($con,$sqlgrupoacceso);
                    while($recorrergrupoacceso = mysqli_fetch_assoc($resultadoogrupoacceso))
                    {
                        echo '<option value="'.$recorrergrupoacceso['iddia'].'">'.$recorrergrupoacceso['numero'].'</option>';
                    }
                    ?>
                    </select>
                    <br>
          <label for="Fecha">Oficina:</label>
          <?php 
               $sqloficina="Select * from oficinas ORDER BY Numero";
               $resultadooficina = mysqli_query($con,$sqloficina);?>
               <select name="ofice" class="form-control" id="sel1">
                    <?php
                         while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                             echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }?>
               </select>
              
               <?php $fecha_actual = date("Y-m-d");
               //sumo 1 día
               $fechamax= date("Y-m-d",strtotime($fecha_actual."+ 31 days"));
               $fechamin =$fecha_actual;
               echo $ingreso; ?> 
               <br><label for="Fecha">Inicia :</label><br>
               <input type="datetime-local" name="ingreso" value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>"  min="<?php echo $fechamin.'T'.date('06:00'); ?>" max = "<?php echo $fechamax.'T'.date('06:00'); ?>" placeholder="yyyy-MM-hh HH:mm:ss" id="IngresoID" required  />
               <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
               <?php $fecha_actual = date("Y-m-d");
               //sumo 1 día
               $fechamax= date("Y-m-d",strtotime($fecha_actual."+ 31 days"));
               $fechamin =$fecha_actual;
               echo $salida;?> 
               <br><br> 
               <label for="Fecha">Expira </label><br>
               <input type="datetime-local" name="salida" value="<?php echo date('Y-m-d').'T'.date('23:00'); ?>"  min="<?php echo $fechamin.'T'.date('06:00'); ?>" placeholder="yyyy-MM-hh HH:mm:ss" id="SalidaID" required  />
               <br>
              
                
               
    <br><br>
    <input name="archivo" type="file" id="archivo">
    <br>
    <input name="boton" type="submit" id="boton" value="Subir" />
    </ol>
    <br><br><br><br>
  </p>
  </div>
</form>

</body>
<?
//}
?>
</table>

