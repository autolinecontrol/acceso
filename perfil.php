<?php
$tipoglobal="VISITANTE";
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';
require 'conexion.php';
ob_start();
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
session_start();
if($_SESSION['logged_in']!== true)
{
    header("Location: index.php");
    exit();
}
else
{
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
    if($result-> num_rows === 0)
    {
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }
    else
    {
        $sqlmostrardatos="SELECT oficinas.Nombre FROM funcionarios INNER JOIN oficinas ON oficinas.Numero = funcionarios.oficina WHERE email='$email'";
        $resultoficina=mysqli_query($con,$sqlmostrardatos);
        //echo $sqlmostrardatos;
        while($recorrer = mysqli_fetch_assoc( $resultoficina))
        {
            $nombreoficina=$recorrer['Nombre'];
        }
        $user = $result->fetch_assoc();
        $activo = $user['activo'];
        $perfil=$user['perfil'];
	    $documento=$user['Identificacion'];
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
<title>Registrar <?php echo $bar = ucfirst(strtolower($tipoglobal));?></title>
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
    if($activo>1)
    {
        include 'banner.php';
    }      
    ?>
    <header class="header-two-bars">
    <div class="header-second-bar">
        <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
        <input id="busca" name="ingreso" type="search" placeholder="Identificacion" autofocus >
        <input type="submit" name="consulta" class="btn btn-success" aceptar value="buscar">
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
    function comprobarc($cedula)
    { 
   //compruebo que el tamaño del string sea válido. 
    if (strlen($cedula)<4 || strlen($cedula)>11)
    { 
        // echo $nombre_usuario . " no es válido<br>"; 
        return false; 
    } 
   //compruebo que los caracteres sean los permitidos 
    $permitidos = "0123456789"; 
    for ($i=0; $i<strlen($cedula); $i++)
    { 
      if (strpos($permitidos, substr($cedula,$i,1))===false)
      { 
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
. " from visitantes  where identificacion = '$identificacion'");
$sqltraer="select identificacion,nombre,correo,Ingreso,Salida,tipo,vehiculo"
. " from visitantes where identificacion = '$identificacion'";

$resultado1 = mysqli_query($con,$sqltraer);
$validar=mysqli_num_rows($resultado1);


if($validar!=0)
{
    $Datosss = mysqli_fetch_array($resultado1);
    $tipo    = $Datosss["tipo"];
    if($tipo==$tipoglobal)
    {
        $nuevoIngreso=date("Y-m-d H:i:s");
        $sqlmostrar=" SELECT 
        logregistros.idVisitante,
        visitantes.nombre,
        logregistros.Fechainicio,
        logregistros.Fechafin,
        logregistros.Oficina,
        logregistros.Administrador,
        logregistros.Fechahora,
        visitantes.tipo,
        visitantes.estado,
        logregistros.Accion,
        logregistros.idAutoriza,
        visitantes.vehiculo
        FROM
        logregistros,visitantes 
        WHERE
        logregistros.idVisitante=visitantes.identificacion and
        logregistros.idVisitante='$identificacion' and
        logregistros.Fechafin>='$nuevoIngreso' and
        visitantes.tipo='$tipoglobal'
        ORDER BY logregistros.Fechahora DESC LIMIT 1
        ";
        //echo $sqlmostrar;
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
$Datoss = mysqli_fetch_array($resultado);  
$id      = $Datoss["identificacion"];   
$nombres = $Datoss["nombre"];   
$mail    = $Datoss["correo"];
$ingreso = $Datoss["Ingreso"];      
$salida  = $Datoss["Salida"]; 
$tipo    = $Datoss["tipo"]; 
$carro   = $Datoss["vehiculo"];
// llenar combo con funcionarios
$fecha_actual = date("Y-m-d");
$sql="SELECT Identificacion,nombre FROM funcionarios WHERE Oficina = '$oficina' order by nombre ASC";
$result = $con->query($sql);
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['identificacion']."'>".$row['nombre']."</option>"; 
    }
}

}
?>
<div class = "container">
    <form action="geninsert2.php" method="get" class="contact_form"> 
    <ul>
        <li>
            <h2><?php echo $tipoglobal?></h2>
            <span class="required_notification">* Datos requeridos</span>
        </li>
        <li>
            <?php 
            if($validac>0)
            {?>
                <label for="name">*Identificacion:</label>
                <input type="text" name="iden" placeholder="Cedula" id ="nuevaIdentificacionID" 
                value="<?php echo $identificacion; ?>" readonly/>
                </li>
                <li>
                    <label for="name">*Nombre:</label>
                    <input type="text" name="nombres" placeholder="Nombres Apellidos" 
                    id ="nuevoUsuarioID" value="<?php echo $nombres; ?>" required />
                </li>
                <li>
                    <label for="email">*Email:</label>
                    <input type="email" name="correo" placeholder="correo@gmail.com" 
                    id ="nuevoEmailID" value="<?php echo $mail; ?>" required />
                    <span class="form_hint">Formato correcto: "name@something.com"</span>
                </li>
                <li>
                    <?php 
                    if($oficina<2)
                    {
                        $sqloficina="Select * from oficinas ORDER BY Numero";
                        $resultadooficina = mysqli_query($con,$sqloficina); 
                        ?>
                        <label for="sel1">*Oficina:</label>
                        <select name="ofice" class="form-control" id="sel1">
                        <?php
                        while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                            echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }
                        ?>
                        </select>
                    <?php
                    } 
                    if($oficina>1)
                    {
                        $sqlmostraroficina="Select * from oficinas  ORDER BY Numero";
                        $resultadooficina = mysqli_query($con,$sqlmostraroficina);
                        ?>
                        <label for="oficina">*Oficina:</label>
                        <select name="ofice" class="form-control" id="sel1">
                        <?php
                        while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                            echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }
                        ?>
                        </select>
                    <?php
                    }
                    ?> 
                </li>
                
                    <li>
                        <?php echo $ingreso;
                        $fecha_actual = date("Y-m-d");
                        $fechamin =$fecha_actual;
                        ?>
                        <br><label for="Fecha">*Ingreso:</label>
                        <input type="datetime-local" name="ingreso" min="<?php echo $fechamin.'T'.date('06:00'); ?>" value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>"  placeholder="yyyy-MM-hh HH:mm:ss" id="IngresoID" required  />
                        <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                    </li>
                    <li>
                        <?php echo $salida;?>
                        <br><label for="Fecha">*Salida:</label>
                        <input type="datetime-local" name="salida"  min="<?php echo $fechamin.'T'.date('23:00'); ?>" value="<?php echo date('Y-m-d').'T'.date('23:00')?>" placeholder="yyyy-MM-hh HH:mm:ss" id ="SalidaID" required  />
                        <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                    </li>
                <?php 
                
                ?>
                <?php 
                if($activo>=4)
                {
                ?>
                    <li>
                    <label> <?php echo $tipoglobal; ?></label>
                    <select name="tipo" class="form-control" id="sel1">
                    <option><?php echo $tipoglobal; ?></option>
                    </select>
                    </li>
                <?php 
                } 
                ?>
                <?php 
                if($activo<4)
                {
                ?>
                    <li>
                        <label for="sel1">*Perfil:</label>
                        <input type="text" placeholder="<?php echo $tipoglobal; ?>" name="tipo" id ="sel1" value="<?php 
                        if($tipo =="")echo $tipoglobal;else echo $tipo;?>" readonly />
                    </li>
                <?php 
                }
                ?>
                  <li>
                    <label >*Grupo Acceso</label>
                    <select name="grupoacceso" class="form-control">
                   <option value="3" >Torre A</option>
                   <option value="4" >Torre B</option>
                   <option value="5" >Torre A y B</option>
                    </select>
                    <br>
                </li>
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
		            <input type="hidden" name ="documento" value="<?php echo $documento?>"/>
                </li>
            <?php 
            } 
            else
            { 
            echo "Digite la identificacion del visitante y pulse Buscar";
            }
            ?></ul>
            <?php 
            if($tipo=="VISITANTE")
            {
                echo "<script type='text/javascript'>
                alert('Este usuario es Visitante , registrelo en la pestaña Registrar Visitantes');
                </script>";
                //exit;
            }
            if($tipo=="CONTRATISTA")
            {
                echo "<script type='text/javascript'>
                alert('Este usuario es Contratista , registrelo en la pestaña Registrar Contratista');
                </script>";
            }?>              


</div>



<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>