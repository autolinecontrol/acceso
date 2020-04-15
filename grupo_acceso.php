<?php
require 'conexion.php';
require 'db.php';
//ob_start();
$validar=0;

ob_start();
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
}
if($result-> num_rows === 0)
{
    unset($_SESSION['logged_in']);
    $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
    header("Location: error.php");
    exit();
}
else
{
    $user = $result->fetch_assoc();
    $activo = $user['activo'];
    $documento=$user['identificacion'];
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
    <title>Grupos de Acceso</title>
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/header-second-bar.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
    input[type="checkbox"]  
    {
        display:inline-block;
        width:19px;
        height:19px;
        margin:-2px 10px 0 0;
        vertical-align:middle;
        cursor:pointer;
    }
    </style>
</head>
<body>
    <div class="form">
    <?php
    // if(!$activo)
    // {
    //     echo "<div class = 'alert alert-info'>
    //     Tu cuenta fue creada! Te acabamos de enviar un correo, 
    //     por favor confirma tu cuenta haciendo click en el link enviado, gracias.
    //     </div>";
    // }

    $sql="select * from grupo_acceso order by id";
    if(isset($_POST['crear']))
    {
        $contador=0;
        $nombre=$_POST['nombre'];
        $sqlinsertar="INSERT INTO grupo_acceso 
        (id,nombre";
        if(isset($_POST['cbox5'])){
            $sqlinsertar.=',p5';
            $contador++;
        }
        if(isset($_POST['cbox6'])){
            $sqlinsertar.=',p6';
            $contador++;
        }
        if(isset($_POST['cbox7'])){
            $sqlinsertar.=',p7';
            $contador++;
        }
        if(isset($_POST['cbox8'])){
            $sqlinsertar.=',p8';
            $contador++;
        }
        if(isset($_POST['cbox9'])){
            $sqlinsertar.=',p9';
            $contador++;
        }
        if(isset($_POST['cbox10'])){
            $sqlinsertar.=',p10';
            $contador++;
        }
        if(isset($_POST['cbox11'])){
            $sqlinsertar.=',p11';
            $contador++;
        }
        if(isset($_POST['cbox12'])){
            $sqlinsertar.=',p12';
            $contador++;
        }
        if(isset($_POST['cbox14'])){
            $sqlinsertar.=',p14';
            $contador++;
        }
        if(isset($_POST['cbox15'])){
            $sqlinsertar.=',p15';
            $contador++;
        }
        if(isset($_POST['cboxsotanos'])){
            $sqlinsertar.=',sotanos';
            $contador++;
        }
        if(isset($_POST['cboxlooby'])){
            $sqlinsertar.=',looby';
            $contador++;
        }
        $sqlinsertar.=") VALUES(NULL,'$nombre'";
        for($i=0;$i<$contador;$i++){
            $sqlinsertar.=",'SI'";
        }
        $sqlinsertar.=')';
        //echo $sqlinsertar;  
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
    }
    if(isset($_GET['traer']))
    {
        $idcontroladora=$_GET['idcontroladora'];
        $sql="SELECT * FROM controladoras WHERE idcontroladora =$idcontroladora";
        $validar=1;
    }
    if(isset($_POST['actualizar']))
    {
        $idcontroladora=$_POST['idcontroladora'];
        $nombre=$_POST['nombre'];
        $direccion=$_POST['direccion'];
        $estado=$_POST['estado'];
        $grupo=$_POST['grupo'];
        $sqlactualizar="REPLACE INTO controladoras (idcontroladora,nombrecontroladora, direccionipcontroladora, estado, Grupo) 
        VALUES ('$idcontroladora','$nombre','$direccion','$estado','$grupo')";
        $resultadoactualizar = mysqli_query($con,$sqlactualizar);
    }
    if(isset($_GET['borrar']))
    {
        $idcontroladora=$_GET['idcontroladora'];
        $sqlborrar="DELETE FROM controladoras WHERE idcontroladora =$idcontroladora";
        $resultadoborrar = mysqli_query($con,$sqlborrar);
    }  
    $resultado = mysqli_query($con,$sql);
    include'banner.php';
    
    ?>           
   
        <header class="header-two-bars">
        <div class="header-second-bar" style="text-align:center">             
            <br>
            <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">               
                <?php
                
                if($validar==0)
                {
                    echo "
                    <br>
                    <input type='text' name='nombre'  placeholder='Nombre Grupo Acceso' required><br><br>                   
                    <br>
                    <table class = 'table table-striped table-bordered'>
                    <tr>
                        <th>Piso 5</th>
                        <th>Piso 6</th>
                        <th>Piso 7</th>
                        <th>Piso 8</th>
                        <th>Piso 9</th>
                        <th>Piso 10</th>
                        <th>Piso 11</th>
                        <th>Piso 12</th>
                        <th>Piso 14</th>
                        <th>Piso 15</th>
                        <th>Sotanos</th>
                        <th>Looby</th>
                    </tr>
                    <tr>
                        <td><input type='checkbox' name='cbox5' value='5'></td>
                        <td><input type='checkbox' name='cbox6' value='6'></td>
                        <td><input type='checkbox' name='cbox7' value='7'></td>
                        <td><input type='checkbox' name='cbox8' value='8'></td>
                        <td><input type='checkbox' name='cbox9' value='9'></td>
                        <td><input type='checkbox' name='cbox10' value='10'></td>
                        <td><input type='checkbox' name='cbox11' value='11'></td>
                        <td><input type='checkbox' name='cbox12' value='12'></td>
                        <td><input type='checkbox' name='cbox14' value='14'></td>
                        <td><input type='checkbox' name='cbox15' value='15'></td>
                        <td><input type='checkbox' name='cboxsotanos' value='sotanos'></td>
                        <td><input type='checkbox' name='cboxlooby' value='looby'></td>
                    </tr>
                    </table>
                    <br>
                    <input type='submit' name='crear' class='btn btn-success' value='Guardar'>
                    <br><br><br>
                    ";
                }        
                if($validar==1)
                {
                    while($fila = mysqli_fetch_assoc($resultado))
                    {
                        $id=  $fila['idcontroladora'];
                        $nombre= $fila['nombrecontroladora'];
                        $direccion= $fila['direccionipcontroladora'];
                        $estado= $fila['estado'];
                        $grupo= $fila['Grupo'];
                        echo "
                        <input type='text' name='idcontroladora'  placeholder='Id Controladora' value='$id'><br><br>
                        <input type='text' name='nombre'  placeholder='Nombre Controladora' value='$nombre'><br><br>
                        <input type='text' name='direccion'  placeholder='Direccion Controladora' value='$direccion'><br><br>
                        <input type='text' name='estado'  placeholder='Estado Controladora' value='$estado'><br><br>
                        <input type='text' name='grupo'  placeholder='Grupo Controladora' value='$grupo'><br><br>
                        <input type='submit' name='actualizar' class='btn btn-success' value='Guardar'>"; 
                    }  
                }
                   
         echo "</div>

    </header>";
    ?>
    <?php
    if($validar==0)
    {
    ?>
    
    <div class = "container">
        <table class = "table table-striped table-bordered">
        <tr>
            <th>Id</th>
            <th>Nombre</th> 
            <th colspan="12" style="text-align: center">Pisos</th>
            <th>Editar</th>
            <th>Eliminar</th>          
        </tr>
           <?php
            
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $mostrador=0;
                echo '<tr>';
                $id= $fila['id'];
                echo '<td>' . $fila['id'] . '</td>';
                echo '<td>' . $fila['nombre'] . '</td>';
                if($fila['p5']=='SI')
                {
                    echo "<td>Piso 5</td>";
                }
                else{
                    $mostrador++;
                }
                if($fila['p6']=='SI')
                {
                    echo "<td>Piso 6</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p7']=='SI')
                {
                    echo "<td>Piso 7</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p8']=='SI')
                {
                    echo "<td>Piso 8</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p9']=='SI')
                {
                    echo "<td>Piso 9</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p10']=='SI')
                {
                    echo "<td>Piso 10</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p11']=='SI')
                {
                    echo "<td>Piso 11</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p12']=='SI')
                {
                    echo "<td>Piso 12</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p14']=='SI')
                {
                    echo "<td>Piso 14</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p15']=='SI')
                {
                    echo "<td>Piso 15</td>";
                }else{
                    $mostrador++;
                }
                if($fila['sotanos']=='SI')
                {
                    echo "<td>Sotanos</td>";
                }else{
                    $mostrador++;
                }
                if($fila['looby']=='SI')
                {
                    echo "<td>Looby</td>";
                }else{
                    $mostrador++;
                }
                if($mostrador!=0){
                echo "<td colspan='$mostrador'>&nbsp;</td>";
                }

                // }
                // for($k=0;$k<$mostrador;$k++){
                //     echo "<td></td>";
                // }
                
                echo "<td><a class='btn btn-success' href='grupo_acceso.php?traer=1&id=$id'>Editar</a></td>";
                echo "<td><a class='btn btn-danger' href='grupo_acceso.php?borrar=1&id=$id'>Borrar</a></td>";

            }
    }
    //     echo "<th>Algo</th>";
    //     while($fila = mysqli_fetch_assoc($resultado))
    //     {
    //         echo '<tr>';
    //         $id= $fila['idcontroladora'];
    //         echo '<td>' . $fila['idcontroladora'] . '</td>';
    //         echo '<td>' . $fila['nombrecontroladora'] . '</td>';
    //         echo '<td>' . $fila['direccionipcontroladora'] . '</td>';
    //         echo '<td>' . $fila['estado'] . '</td>';
    //         echo '<td>' . $fila['Grupo'] . '</td>';
    //         echo "<input type='hidden' name='idcontroladora' value='$id'>";
            
    //         echo "<td><a class='btn btn-success' href='controladoras.php?traer=1&idcontroladora=$id'>Actualizar</a></td>";
    //         echo "<td><a class='btn btn-danger' href='controladoras.php?borrar=1&idcontroladora=$id'>Borrar</a></td>";
    //     }
    //     mysqli_close($con);
    //     echo "</table>"; 
        // }   
    ?> 
        
    </form>
</div>
</body>

