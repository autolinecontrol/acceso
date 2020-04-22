<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
    $documento=$user['Identificacion'];
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
    <title>Grupos de Horario</title>
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
    $sql="select * from grupo_horario order by idhorario";
    if(isset($_POST['crear']))
    {
        $contador=0;
        //var_dump($_POST);
        $hora=$_POST['hora'];
        $horaf=$_POST['horaf'];
        $nombre=$_POST['nombre'];
        $sqlinsertar="INSERT INTO grupo_horario 
        (idhorario,nombre";
        if(isset($_POST['hora'])){
            $sqlinsertar.=',horainicio';
            $contador++;
        }
        if(isset($_POST['horaf'])){
            $sqlinsertar.=',horafin';
            $contador++;
        }

        //validacion hora inicio y hora fin

        

        }
        $sqlinsertar.=") VALUES(NULL,'$nombre','$hora','$horaf'";
        
        $sqlinsertar.=")";
        echo $sqlinsertar;  
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
 
    if(isset($_GET['traer']))
    {
        $idtraer=$_GET['id'];
        $sql="SELECT * FROM grupo_horario WHERE idhorario =$idtraer";
        $validar=1;
    }
    if(isset($_POST['actualizar']))
    {
        $idactualizar=$_POST['idactualizar'];
        $nombre=$_POST['nombre'];
        $hora=$_POST['hora'];
        $horaf=$_POST['horaf'];
        $sqlactualizar="UPDATE grupo_horario 
        SET nombre='$nombre',
        horainicio='$hora',
        horafin='$horaf'
        ";

        $sqlinsertar.=" WHERE idhorario='$idactualizar'";
       //echo $sqlinsertar;
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
    }
    if(isset($_GET['borrar']))
    {
        $id=$_GET['id'];
        $sqlborrar="DELETE FROM grupo_horario WHERE idhorario =$id";
        $resultadoborrar = mysqli_query($con,$sqlborrar);
    }  
    echo $sql;
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
                    <input type='nombre' name='nombre' placeholder='Digite el nombre del grupo de horario'required><br><br>";
                    /*
                    <select name='torre'>
                        <option value='1' selected>Torre A</option> 
                        <option value='2' >Torre B</option>
                        <option value='3'>Torre A y B</option>
                    </select>*/
                    echo"
                    <br><br>                   
                    <br>
                    <table class = 'table table-striped table-bordered'>
                    <tr>
                    <th>Hora Inicio </th> <td><input type='time' name='hora' max='23:59' min='00:01' ></td>
                    </tr>
                    <tr>    
                    <th>Hora Fin</th> <td><input type='time' name='horaf' max='23:59' min='00:01'  ></td>
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
                        $id=  $fila['idhorario'];
                        $nombre= $fila['nombre'];
                        $hora=$fila['horainicio'];
                        $horaf=$fila['horafin'];
                        echo "
                        <br>
                        <input type='hidden' name='idactualizar' value='$id' ><br><br>
                        <input type='text' name='nombre'  placeholder='Nombre Grupo Horario' required value='$nombre'><br><br>
                        
                        </select>
                        <br><br>                   
                        <br>
                        <table class = 'table table-striped table-bordered'>
                        <tr>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                        </tr>
                        <tr>";
                        echo"<td><input type='time' name='hora' value='$hora'";
                        echo "></td>";
                        echo"<td><input type='time' name='horaf' value='$horaf'";
                        echo "></td>
                        </tr>
                        </table>
                        <br>
                        <input type='submit' name='actualizar' class='btn btn-success' value='Guardar'>
                        <br><br><br>"; 
                    }  
                }
         echo "</div>
    </header>";
    ?>
    <?php
    if($validar==0)
    {
    ?> 
        <table class = "table table-striped table-bordered">
        <tr>
            <th>Id</th>
            <th>Nombre</th> 
            <th colspan="2" style="text-align: center">Horarios</th>
            
            <th>Editar</th>
            <th>Eliminar</th>          
        </tr>
           <?php
            
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $mostrador=0;
                echo '<tr>';
                $id= $fila['idhorario'];
                echo '<td>' . $id . '</td>';
                echo '<td>' . $fila['nombre'] . '</td>';
                echo '<td>' . $fila['horainicio'] . '</td>';
                echo '<td>' . $fila['horafin'] . '</td>';
                echo "<td><a class='btn btn-success' href='grupo_horario.php?traer=1&id=$id'>Editar</a></td>";
                if($id!=1)
                echo "<td><a class='btn btn-danger' href='grupo_horario.php?borrar=1&id=$id'>Borrar</a></td>";

            }
    }   
    ?> 
        
    </form>
</div>
</body>

