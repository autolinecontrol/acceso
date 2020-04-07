<?php
require 'db.php';

ob_start();
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
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
        require 'conexion.php';
        $resultoficina=mysqli_query($con,"SELECT oficinas.Nombre FROM funcionarios INNER JOIN oficinas ON oficinas.Numero = funcionarios.oficina WHERE email='$email'");
        while($recorrer = mysqli_fetch_assoc( $resultoficina))
            {
                $nombreoficina=$recorrer['Nombre'];
            }
        //echo $nombreoficina;
        //exit;
        $user = $result->fetch_assoc();
        $activo = $user['activo'];
        //echo $activo;
       
    }
    
}
?>
<head>
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Registrar Visitantes</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	   
        
</head>
 <body>
        <form  method="get" name="ingresodep" id="contFrm" action="">    
            <div class="form">
            <?php
            if($activo<2)
            {
                session_start();
                session_unset();
                session_destroy();
                
            $_SESSION['message']="Ocurrio un Error";
            header("Location: error.php");
            exit();
            }
            if($activo>1){
                
            ?>
           
            <header class="header-two-bars">
            <label>Administrando:<?echo $nombre; ?> Oficina: <? echo $nombreoficina; ?> Perfil: 
                <? 
                    switch ($activo) 
                    {
                        case '5':
                            echo "Super Administrador";
                        break;
                        case '4':
                            echo "Administrador";
                        break;
                        case '3':
                            echo "Funcionarios";
                        break;
                        case '2':
                            echo "Visitantes";
                        break;
                        case '1':
                            echo "Inactivo";
                        break;
                    }
                ?>
            </label>
            <div class="header-first-bar">
                  
                <div class="header-limiter">
                  
                    <h1><a href="#">Centro<span>Andino</span></a></h1>
                     
   
                        <?
                        if($activo==2)
                        {
                           echo 
                           '<nav>
                           <ul class="nav">
                            <li>
                                <a href="perfil.php">Registrar<br>Visitantes</a>
                                <a href="mostrar.php">Mostrar<br>Visitantes</a>
                                <a href="importar2.php">Masivo<br>Visitantes</a>
                            </li>
                           </ul>
                           </nav>';
                           
                        }
                        
                        if($activo==3)
                        {
                           echo 
                           '<nav>
                           <ul class="nav">
                            <li>
                                <a href="perfil.php">Registrar<br>Visitantes</a>
                                
                                <a href="mostrar.php">Mostrar<br>Visitantes</a>
                                <a href="importar2.php">Masivo<br>Visitantes</a>
                                <a href="perfil2.php">Registrar<br>Contratistas</a>
                                <a href="mostrarc.php">Mostrar<br>Contratistas</a>
                                <a href="perfil1.php">Registrar<br>Funcionarios</a>
                                <a href="mostrarf.php">Mostrar<br>Funcionarios</a>
                                
                            </li>
                            
                           </ul>
                           </nav>';
                          
                        }
                        
                        if($activo==4)
                        {
                           echo 
                           '<nav>
                           <ul class="nav">
                            <li>
                                <a href="perfil.php">Registro<br>Visitantes</a>
                                
                                <a href="mostrar.php">Mostrar<br>Visitantes</a>
                                <a href="importar2.php">Masivo<br>Visitantes</a>
                                <a href="perfil2.php">Registrar<br>Contratistas</a>
                                <a href="mostrarc.php">Mostrar<br>Contratistas</a>
                                <a href="perfil1.php">Registro<br>Funcionarios</a>
                                <a href="mostrarf.php">Mostrar<br>Funcionarios</a>
                                <a href="mostrarFuncionarios.php">Buscar<br>Funcionarios Oficina</a>
                                <a href="activarfuncionarios.php">Roles<br>Administradores</a>
                                 
                                <a href="logregistros.php">Log<br>Registros</a>
                            </li>
                            
                           </ul>
                           </nav>';
                          
                        }
                        
                         if($activo==5)
                        {
                            echo 
                           '<nav>
                           <ul class="nav">
                            <li>
                                <a href="perfil.php">Registro<br>Visitantes</a>
                                <a href="importar2.php">Masivo<br>Visitantes</a>
                                <a href="mostrar.php">Mostrar<br>Visitantes</a>
                                
                                <a href="perfil2.php">Registrar<br>Contratistas</a>
                                <a href="mostrarc.php">Mostrar<br>Contratistas</a>
                                <a href="perfil1.php">Registro<br>Funcionarios</a>
                                <a href="mostrarf.php">Mostrar<br>Funcionarios</a>
                                <a href="mostrarFuncionarios.php">Buscar<br>x Oficina</a>
                                
                                <a href="ofice.php">Gestionar<br>Oficinas</a>
                                <a href="activarfuncionarios.php">Roles<br>Administradores</a>
                                <a href="logregistros.php">Log<br>Registros</a>
                                
                            </li>
                            
                           </ul>
                           </nav>';
                       
                        }
                        
                        ?>
                    
                    
                    <a href="logout.php" class="logout-button">Logout</a>
                </div>

            </div>

            <div class="header-second-bar">

                
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                        <input id="busca" name="ingreso" type="search" placeholder="Identificacion" autofocus >
                        
                        <input type="submit" name="consulta" class="btn btn-success" aceptar" value="buscar">
                        
                    </form>
                    
            </div>

        </header>
<?php



if(isset($_GET['nuevo']))
{
$id = $_GET['id'];
//echo $id;
$nactivo="2";

$Consulta = mysqli_query($con,"UPDATE funcionarios SET activo='2' WHERE identificacion='$id'");

$resultado = mysqli_query($con, "select identificacion,nombre,activo "
        . " from funcionarios"
        . " where identificacion = '$id'"
        . "order by nombre"
        );


}


if(isset($_GET['inactiva']))
{
$id = $_GET['id'];
//echo $id;
$nactivo="2";

$Consulta = mysqli_query($con,"UPDATE funcionarios SET activo='1' WHERE identificacion='$id'");

$resultado = mysqli_query($con, "select identificacion,nombre,activo "
        . " from funcionarios"
        . " where identificacion = '$id'"
        . "order by nombre"
        );


}

if(isset($_GET['consulta']))
{
function comprobarc($cedula){ 
   //compruebo que el tamaño del string sea válido. 
   if (strlen($cedula)<4 || strlen($cedula)>11){ 
     // echo $nombre_usuario . " no es válido<br>"; 
      return false; 
   } 

   //compruebo que los caracteres sean los permitidos 
   $permitidos = "0123456789"; 
   for ($i=0; $i<strlen($cedula); $i++){ 
      if (strpos($permitidos, substr($cedula,$i,1))===false){ 
           // echo $nombre_usuario . " no es válido<br>"; 
         return false; 
      } 
   } 
   //echo $nombre_usuario . " es válido<br>"; 
   return true; 
} 

$identificacion = $_GET['ingreso'];

$validac = comprobarc($identificacion);

if($validac < 1)
{
    echo "*Importante: La identifación debe ser un campo numérico mayor 3 y menor de 12 caracteres, sin puntos ni comas ";
}

$resultado = mysqli_query($con, "select identificacion,nombre,correo,Ingreso,Salida,tipo,vehiculo"
        . " from visitantes"
        . " where identificacion = '$identificacion'"
        );
        $resultado1 = mysqli_query($con, "select identificacion,nombre,correo,Ingreso,Salida,tipo,vehiculo"
        . " from visitantes"
        . " where identificacion = '$identificacion'"
        );
$validar=mysqli_num_rows($resultado1);
if($validar!=0){
    $Datosss = mysqli_fetch_array($resultado1);
    $tipo    = $Datosss["tipo"];
    
    if($tipo=="VISITANTE")
        {
        $nuevoIngreso=date("Y-m-d H:i:s");
        $sqlmostrar="select 
            Log.idVisitante,
            visitantes.nombre,
            Log.Fechainicio,
            Log.Fechafin,
            Log.Oficina,
            Log.Administrador,
            Log.Fechahora,
            visitantes.tipo,
            visitantes.estado,
            Log.Accion,
            Log.idAutoriza
            from
            Log,visitantes 
            where
            Log.idVisitante=visitantes.identificacion and
            Log.idVisitante='$identificacion' and
            Log.Fechafin>='$nuevoIngreso' and
            Log.Tipo='VISITANTE'
            limit 1;
            ";
           
            $mostrar = mysqli_query($con,$sqlmostrar);
            echo "<div class = 'container'>
            <table class = 'table table-striped table-bordered'>
            <tr>
                <th>Cedula Usuario</th>
                <th>Nombre Usuario</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Oficina</th>
                <th>Administrador</th>
                <th>Transaccion</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Accion</th>
                <th>Anfitrion</th>
            </tr>";
            while($m = mysqli_fetch_assoc($mostrar))
            {
                
                echo '<tr>';
                echo '<td>' . $m['idVisitante'] . '</td>';
                echo '<td>' . $m['nombre'] . '</td>';
                
                echo '<td>' . $m['Fechainicio'] . '</td>';
                
                echo '<td>' . $m['Fechafin'] . '</td>';
                echo '<td>' . $m['Oficina'] . '</td>';
                echo '<td>'. $m['Administrador']. '</td>';
                echo '<td>'. $m['Fechahora']. '</td>';
                echo '<td>'. $m['tipo']. '</td>';
                echo '<td>'. $m['estado']. '</td>';
                echo '<td>'. $m['Accion']. '</td>';
                if($m['idAutoriza']==1) $autoriza = "masivo";
                else $autoriza = $m['idAutoriza'];
                echo '<td>'. $autoriza. '</td>';
                echo '</tr>';
                
            }
        }    echo "</table>";
    }
else{
    
}
        
    $Datoss = mysqli_fetch_array($resultado);  
    $id      = $Datoss["identificacion"];   
    $nombres = $Datoss["nombre"];   
    $mail    = $Datoss["correo"];

    $ingreso = $Datoss["Ingreso"];      
    $salida  = $Datoss["Salida"]; 
    $tipo    = $Datoss["tipo"]; 
    $carro   = $Datoss["vehiculo"];
    
// llenar combo con funcionarios
$mysql_host    = 'localhost';
$mysql_usuario = 'centrpe8_auto2';
$mysql_clave   = 'acceso2018';
$mysql_BD      = 'centrpe8_andino';


$fecha_actual = date("Y-m-d");

$conexion = new mysqli($mysql_host, $mysql_usuario,$mysql_clave,$mysql_BD);
if ($conexion->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}
if ($oficina == 4 or $oficina == 5 or  $oficina == 6 or $oficina == 8)
{ $sql="SELECT identificacion,nombre from visitantes where tipo = 'FUNCIONARIO' and (Oficina = 4 or Oficina = 5 or Oficina = 6 or Oficina = 8) and Salida > '$fecha_actual' order by nombre ASC";}

if ($oficina != 4 or $oficina != 5 or $oficina != 6 or $oficina != 8)
{ $sql="SELECT identificacion,nombre from visitantes where tipo = 'FUNCIONARIO' and Oficina = '$oficina' and Salida > '$fecha_actual' order by nombre ASC";}

$result = $conexion->query($sql);

if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['identificacion']."'>".$row['nombre']."</option>"; 
    }
}
else
{
    echo "No hubo resultados";
}

    
}


?>

<div class = "container">

            <form action="geninsert.php" method="get" class="contact_form"> 
                <ul>
                <li>
                    <h2>Visitantes</h2>
                    <span class="required_notification">* Datos requeridos</span>
                </li>
                <li>
                <?php if($validac>0){    ?>
                    <label for="name">*Identificacion:</label>
                    <input type="text" name="iden" placeholder="Cedula" id ="nuevaIdentificacionID" value="<?php 
                     echo $identificacion; ?>" readonly/>
               
                </li>
                <li>
                    <label for="name">*Nombre:</label>
                    <input type="text" name="nombres" placeholder="Nombres Apellidos" id ="nuevoUsuarioID" value="<?php echo $nombres; ?>" required />
                </li>
                
                <li>
                    <label for="email">*Email:</label>
                    <input type="email" name="correo" placeholder="centralpointcorreo@gmail.com" id ="nuevoEmailID" value="<?php echo $mail; ?>" required />
                    <span class="form_hint">Formato correcto: "name@something.com"</span>
                </li>
                 
                <li>
                    <? 
                    if($oficina<2){$sqloficina="Select * from oficinas ORDER BY Numero";
                    $resultadooficina = mysqli_query($con,$sqloficina); ?>
                    
                     <label for="sel1">*Oficina:</label>
                    <select name="ofice" class="form-control" id="sel1">
                    <?php
                         while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                             echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }?>
                    </select>
                    <?}?>
                    
                    <? if($oficina>1 ){
                    $sqlmostraroficina="Select * from oficinas where Numero='$oficina'";
                    $resultadooficina = mysqli_query($con,$sqlmostraroficina);?>
                    <label for="oficina">*Oficina:</label>
                
                    <select name="ofice" class="form-control" id="sel1">
                    <?php
                     while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                             echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }?>
                    </select>
                    
                    <?}?>
                     
                </li>
                
                <? if($oficina>1 and $tipo!="FUNCIONARIO"){?>
                 <li>
                     <?php $fecha_actual = date("Y-m-d");
                    //sumo 1 día
                    $fechamax= date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
                    $fechamin =$fecha_actual;
                    echo $ingreso; ?> 
                    <br><label for="Fecha">*Ingreso:</label>
                    <input type="datetime-local" name="ingreso" value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>" min="<?php echo $fechamin.'T'.date('06:00'); ?>"   placeholder="yyyy-MM-hh HH:mm:ss" id="IngresoID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                </li>
                <li>
                     <?php $fecha_actual = date("Y-m-d");
                    //sumo 1 día
                    $fechamax= date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
                    $fechamin =$fecha_actual;
                     echo $salida;?> 
                    <br><label for="Fecha">*Salida:</label>
                    <input type="datetime-local" name="salida" value="<?php echo date('Y-m-d').'T'.date('23:00'); ?>" min="<?php echo $fechamin.'T'.date('23:00'); ?>"  placeholder="yyyy-MM-hh HH:mm:ss" id="SalidaID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                </li>
                <?}?>
                  <? if($oficina>1 and $tipo=="FUNCIONARIO"){?>
                  
                 <li>
                    <br><label for="Fecha">*Ingreso:</label>
                  
                    <input type="text" name="ingreso" id ="IngresoID" value="<?php echo $ingreso; ?>" readonly /
                    
                </li>
                <li>
                    <br><label for="Fecha">*Salida:</label>
                    <input type="text" name="salida" id ="SalidaID" value="<?php echo $salida; ?>" readonly /
                    
                   
                </li>
                <?}?>
                <? if($oficina==1){?>
                <li>
                    <? echo $ingreso;?>
                    <?php $fecha_actual = date("Y-m-d");
                  $fechamin =$fecha_actual;
                  ?>
                    <br><label for="Fecha">*Ingreso:</label>
                    <input type="datetime-local" name="ingreso" min="<?php echo $fechamin.'T'.date('06:00'); ?>" value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>"  placeholder="yyyy-MM-hh HH:mm:ss" id="IngresoID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                </li>
                
                <li>
                    <? echo $salida;?>
                    <br><label for="Fecha">*Salida:</label>
                    <input type="datetime-local" name="salida"  min="<?php echo $fechamin.'T'.date('23:00'); ?>" value="<?php echo date('Y-m-d').'T'.date('23:00')?>" placeholder="yyyy-MM-hh HH:mm:ss" id ="SalidaID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                     
                </li>
                <? }?>
                <? if($activo>=4){?>
                <li>
                    <label> <? echo $tipo; ?></label>
                     <select name="tipo" class="form-control" id="sel1">
                     <option>VISITANTE</option>
                     
                    </select>
                   
                </li>
                
                <li>
                    <label for="sel1">*Vehículo:</label>
                     
                    <select name="carro" class="form-control" id="sel1">
                    <option>NO</option>
                    <option>SI</option>
                    </select>
                </li>
                 <? } ?>
                 <? if($activo<4 ){?>
                <li>
                   
                    <label for="sel1">*Perfil:</label>
                  
                    <input type="text" placeholder="VISITANTE" name="tipo" id ="sel1" value="<?php 
                        if($tipo =="")echo "VISITANTE";
                        else echo $tipo;
                    ?>" readonly />
                </li>
                
                <li>
                    <label for="sel1">*Vehículo:</label>
                  
                    <input type="text" placeholder="NO" name="carro" id ="sel1" value="<?php
                      if($tipo =="")echo "NO";
                      else echo $carro;
                     ?>" readonly />
                </li>
                 <? } ?>
                 
                 
                <li>
                    <label for="autoriza">Autoriza</label>
                    <select name="estado" class="form-control">
                        <?php echo $combobit; ?>
                    </select>
                    <br>
                    
                   
                </li>
               
                <li>
                 <label>Para Finalizar </label>
                 <input type="submit" class="btn btn-success" value= "Guardar">
                </li>
                
                <?php } 
                else echo "Digite la identificacion del visitante y pulse Buscar";
                
                ?>
                </ul>
                <? if($tipo=="FUNCIONARIO")
                {
                echo "<script type=\"text/javascript\">
                alert('Este usuario es Funcionario , registrelo en la pestaña Registrar Funcionarios holaque hace');
                </script>";
                //exit;
                }
                if($tipo=="CONTRATISTA")
                {
                echo "<script type=\"text/javascript\">
                alert('Este usuario es Contratista, registrelo en la pestaña Registrar Contratistas ');
                </script>";
                //exit;
                }?>
                

<?
}

?>
</div>


