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
    <title>Grupos de Dias</title>
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
    $sql="select * from grupo_dia order by numero";
    if(isset($_POST['crear']))
    {
        // $torre=$_POST['torre'];
        $contador=0;
        $numero=$_POST['numero'];
        $sqlinsertar="INSERT INTO grupo_dia 
        (iddia,numero";
        if(isset($_POST['cbox5'])){
            $sqlinsertar.=',Lunes';
            $contador++;
        }
        if(isset($_POST['cbox6'])){
            $sqlinsertar.=',Martes';
            $contador++;
        }
        if(isset($_POST['cbox7'])){
            $sqlinsertar.=',Miercoles';
            $contador++;
        }
        if(isset($_POST['cbox8'])){
            $sqlinsertar.=',Jueves';
            $contador++;
        }
        if(isset($_POST['cbox9'])){
            $sqlinsertar.=',Viernes';
            $contador++;
        }
        if(isset($_POST['cbox10'])){
            $sqlinsertar.=',Sabado';
            $contador++;
        }
        if(isset($_POST['cbox11'])){
            $sqlinsertar.=',Domingo';
            $contador++;
        }
        
        $sqlinsertar.=") VALUES(NULL,$numero";
        for($i=0;$i<$contador;$i++){
            $sqlinsertar.=",1";
        }
        $sqlinsertar.=")";
        //echo $sqlinsertar;  
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
    }
    if(isset($_GET['traer']))
    {
        $idtraer=$_GET['id'];
        $sql="SELECT * FROM grupo_dia WHERE iddia =$idtraer";
        $validar=1;
    }
    if(isset($_POST['actualizar']))
    {
        $idactualizar=$_POST['idactualizar'];
        $numero=$_POST['numero'];
        
        $contador=0;
        $sqlinsertar="UPDATE grupo_dia 
        SET numero=$numero";
        if(isset($_POST['cbox5']))$sqlinsertar.=",Lunes='1'";
        else $sqlinsertar.=",Lunes='0'";
        if(isset($_POST['cbox6']))$sqlinsertar.=",Martes='1'";
        else $sqlinsertar.=",Martes='0'";
        if(isset($_POST['cbox7']))$sqlinsertar.=",Miercoles='1'";
        else $sqlinsertar.=",Miercoles='0'";
        if(isset($_POST['cbox8']))$sqlinsertar.=",Jueves='1'";
        else $sqlinsertar.=",Jueves='0'";
        if(isset($_POST['cbox9']))$sqlinsertar.=",Viernes='1'";
        else $sqlinsertar.=",Viernes='0'";
        if(isset($_POST['cbox10']))$sqlinsertar.=",Sabado='1'";
        else $sqlinsertar.=",Sabado='0'";
        if(isset($_POST['cbox11']))$sqlinsertar.=",Domingo='1'";
        else $sqlinsertar.=",Domingo='0'";
        $sqlinsertar.=" WHERE iddia='$idactualizar'";
        echo $sqlinsertar;
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
    }
    if(isset($_GET['borrar']))
    {
        $id=$_GET['id'];
        $sqlborrar="DELETE FROM grupo_dia WHERE iddia =$id";
        $resultadoborrar = mysqli_query($con,$sqlborrar);
    }  
    //echo $sql;
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
                    <input type='number' name='numero' required><br><br>";
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
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                    </tr>
                    <tr>
                        <td><input type='checkbox' name='cbox5' value='5'></td>
                        <td><input type='checkbox' name='cbox6' value='6'></td>
                        <td><input type='checkbox' name='cbox7' value='7'></td>
                        <td><input type='checkbox' name='cbox8' value='8'></td>
                        <td><input type='checkbox' name='cbox9' value='9'></td>
                        <td><input type='checkbox' name='cbox10' value='10'></td>
                        <td><input type='checkbox' name='cbox11' value='11'></td>
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
                        $id=$fila['iddia'];
                        $numero=$fila['numero'];
                        $p5=$fila['Lunes'];
                        $p6=$fila['Martes'];
                        $p7=$fila['Miercoles'];
                        $p8=$fila['Jueves'];
                        $p9=$fila['Viernes'];
                        $p10=$fila['Sabado'];
                        $p11=$fila['Domingo'];
                    echo "
                        <br>
                        <input type='hidden' name='idactualizar' value='$id' ><br><br>
                        <input type='text' name='numero' value='$numero' ><br><br>
                    
                        <br><br>                   
                        <br>
                        <table class = 'table table-striped table-bordered'>
                        <tr>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sabado</th>
                            <th>Domingo</th>
                        </tr>
                        <tr>";
                        echo"<td><input type='checkbox' name='cbox5' value='5'";
                        if($p5==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox6' value='6'";
                        if($p6==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox7' value='7'";
                        if($p7==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox8' value='8'";
                        if($p8==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox9' value='9'";
                        if($p9==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox10' value='10'";
                        if($p10==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox11' value='11'";
                        if($p11==1)echo "checked";
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
            
            <th>numero</th>
            <th colspan="7" style="text-align: center">Dias</th>
            <th>Editar</th>
            <th>Eliminar</th>          
        </tr>
           <?php
            
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $mostrador=0;
                echo '<tr>';
                $id= $fila['iddia'];
                
                echo '<td>' . $fila['numero'] . '</td>';
                
                if($fila['Lunes']==1)
                {
                    echo "<td>Lunes</td>";
                }
                else{
                    $mostrador++;
                }
                if($fila['Martes']==1)
                {
                    echo "<td>Martes</td>";
                }else{
                    $mostrador++;
                }
                if($fila['Miercoles']==1)
                {
                    echo "<td>Miercoles</td>";
                }else{
                    $mostrador++;
                }
                if($fila['Jueves']==1)
                {
                    echo "<td>Jueves</td>";
                }else{
                    $mostrador++;
                }
                if($fila['Viernes']==1)
                {
                    echo "<td>Viernes</td>";
                }else{
                    $mostrador++;
                }
                if($fila['Sabado']==1)
                {
                    echo "<td>Sabado</td>";
                }else{
                    $mostrador++;
                }
                if($fila['Domingo']==1)
                {
                    echo "<td>Domingo</td>";
                }else{
                    $mostrador++;
                }
                
                
                if($mostrador!=0){
                    echo "<td colspan='$mostrador'>&nbsp;</td>";
                    }
                echo "<td><a class='btn btn-success' href='grupo_dia.php?traer=1&id=$id'>Editar</a></td>";
                echo "<td><a class='btn btn-danger' href='grupo_dia.php?borrar=1&id=$id'>Borrar</a></td>";

            }
    }   
    ?> 
        
    </form>
</div>
</body>

