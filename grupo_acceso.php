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
    $sql="select * from grupo_acceso order by id";
    if(isset($_POST['crear']))
    {
        $torre=$_POST['torre'];
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
        if(isset($_POST['cboxpv'])){
            $sqlinsertar.=',pv';
            $contador++;
        }
        if(isset($_POST['cboxpf'])){
            $sqlinsertar.=',pf';
            $contador++;
        }
        $sqlinsertar.=",torre) VALUES(NULL,'$nombre'";
        for($i=0;$i<$contador;$i++){
            $sqlinsertar.=",1";
        }
        $sqlinsertar.=",'$torre')";
        //echo $sqlinsertar;  
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
    }
    if(isset($_GET['traer']))
    {
        $idtraer=$_GET['id'];
        $sql="SELECT * FROM grupo_acceso WHERE id =$idtraer";
        $validar=1;
    }
    if(isset($_POST['actualizar']))
    {
        $idactualizar=$_POST['idactualizar'];
        $torre=$_POST['torre'];
        $contador=0;
        $nombre=$_POST['nombre'];
        $sqlinsertar="UPDATE grupo_acceso 
        SET nombre='$nombre'";
        if(isset($_POST['cbox5']))$sqlinsertar.=",p5='1'";
        else $sqlinsertar.=",p5='0'";
        if(isset($_POST['cbox6']))$sqlinsertar.=",p6='1'";
        else $sqlinsertar.=",p6='0'";
        if(isset($_POST['cbox7']))$sqlinsertar.=",p7='1'";
        else $sqlinsertar.=",p7='0'";
        if(isset($_POST['cbox8']))$sqlinsertar.=",p8='1'";
        else $sqlinsertar.=",p8='0'";
        if(isset($_POST['cbox9']))$sqlinsertar.=",p9='1'";
        else $sqlinsertar.=",p9='0'";
        if(isset($_POST['cbox10']))$sqlinsertar.=",p10='1'";
        else $sqlinsertar.=",p10='0'";
        if(isset($_POST['cbox11']))$sqlinsertar.=",p11='1'";
        else $sqlinsertar.=",p11='0'";
        if(isset($_POST['cbox12']))$sqlinsertar.=",p12='1'";
        else $sqlinsertar.=",p12='0'";
        if(isset($_POST['cbox14']))$sqlinsertar.=",p14='1'";
        else $sqlinsertar.=",p14='0'";
        if(isset($_POST['cbox15']))$sqlinsertar.=",p15='1'";
        else $sqlinsertar.=",p15='0'";
        if(isset($_POST['cboxsotanos']))$sqlinsertar.=",sotanos='1'";
        else $sqlinsertar.=",sotanos='0'";
        if(isset($_POST['cboxlooby']))$sqlinsertar.=",looby='1'";
        else $sqlinsertar.=",looby='0'";
        if(isset($_POST['cboxpv']))$sqlinsertar.=",pv='1'";
        else $sqlinsertar.=",pv='0'";
        if(isset($_POST['cboxpf']))$sqlinsertar.=",pf='1'";
        else $sqlinsertar.=",pf='0'";
        $sqlinsertar.=",torre='$torre' WHERE id='$idactualizar'";
       //echo $sqlinsertar;
        $resultadoinsert = mysqli_query($con,$sqlinsertar);
    }
    if(isset($_GET['borrar']))
    {
        $id=$_GET['id'];
        $sqlborrar="DELETE FROM grupo_acceso WHERE id =$id";
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
                    <input type='text' name='nombre'  placeholder='Nombre Grupo Acceso' required><br><br>
                    <select name='torre'>
                        <option value='1' selected>Torre A</option> 
                        <option value='2' >Torre B</option>
                        <option value='3'>Torre A y B</option>
                    </select>
                    <br><br>                   
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
                        <th>Parqueadero Visitantes</th>
                        <th>Parqueadero Funcionarios</th>
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
                        <td><input type='checkbox' name='cboxpv' value='pv'></td>
                        <td><input type='checkbox' name='cboxpf' value='pf'></td>
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
                        $id=  $fila['id'];
                        $nombre= $fila['nombre'];
                        $p5=$fila['p5'];
                        $p6=$fila['p6'];
                        $p7=$fila['p7'];
                        $p8=$fila['p8'];
                        $p9=$fila['p9'];
                        $p10=$fila['p10'];
                        $p11=$fila['p11'];
                        $p12=$fila['p12'];
                        $p14=$fila['p14'];
                        $p15=$fila['p15'];
                        $sotanos=$fila['sotanos'];
                        $looby=$fila['looby'];
                        $pv=$fila['pv'];
                        $pf=$fila['pf'];
                        $torretraer=$fila['torre'];
                        echo "
                        <br>
                        <input type='hidden' name='idactualizar' value='$id' ><br><br>
                        <input type='text' name='nombre'  placeholder='Nombre Grupo Acceso' required value='$nombre'><br><br>
                        
                        <select name='torre'>";
                        
                        if($torretraer=='1'){
                            echo"<option value='1' selected>Torre A</option>";
                        }
                        else
                        {
                            echo "<option value='1'>Torre A</option>";
                        }
                        if($torretraer=='2'){
                            echo"<option value='2' selected>Torre B</option>";
                        }
                        else
                        {
                            echo "<option value='2'>Torre B</option>";
                        }
                        if($torretraer=='3'){
                            echo"<option value='3' selected>Torre A y B</option>";
                        }
                        else
                        {
                            echo "<option value='3'>Torre A y B</option>";
                        }
                        echo "    
                        </select>
                        <br><br>                   
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
                            <th>Parqueadero Visitantes</th>
                            <th>Parqueadero Funcionarios</th>
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
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox12' value='12'";
                        if($p12==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox14' value='14'";
                        if($p14==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cbox15' value='15'";
                        if($p15==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cboxsotanos' value='sotanos'";
                        if($sotanos==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cboxlooby' value='looby'";
                        if($looby==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cboxpv' value='pv'";
                        if($pv==1)echo "checked";
                        echo "></td>";
                        echo"<td><input type='checkbox' name='cboxpf' value='pf'";
                        if($pf==1)echo "checked";
                        echo "></td>";echo "
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
            <th colspan="14" style="text-align: center">Pisos</th>
            <th >Torre</th>
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
                if($fila['p5']==1)
                {
                    echo "<td>Piso 5</td>";
                }
                else{
                    $mostrador++;
                }
                if($fila['p6']==1)
                {
                    echo "<td>Piso 6</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p7']==1)
                {
                    echo "<td>Piso 7</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p8']==1)
                {
                    echo "<td>Piso 8</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p9']==1)
                {
                    echo "<td>Piso 9</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p10']==1)
                {
                    echo "<td>Piso 10</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p11']==1)
                {
                    echo "<td>Piso 11</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p12']==1)
                {
                    echo "<td>Piso 12</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p14']==1)
                {
                    echo "<td>Piso 14</td>";
                }else{
                    $mostrador++;
                }
                if($fila['p15']==1)
                {
                    echo "<td>Piso 15</td>";
                }else{
                    $mostrador++;
                }
                if($fila['sotanos']==1)
                {
                    echo "<td>Sot.</td>";
                }else{
                    $mostrador++;
                }
                if($fila['looby']==1)
                {
                    echo "<td>Looby</td>";
                }else{
                    $mostrador++;
                }
                if($fila['pv']==1)
                {
                    echo "<td>Parq. Visi.</td>";
                }else{
                    $mostrador++;
                }
                if($fila['pf']==1)
                {
                    echo "<td>Parq. Func.</td>";
                }else{
                    $mostrador++;
                }
                $torremostrar=$fila['torre'];
                if($mostrador!=0){
                    echo "<td colspan='$mostrador'>&nbsp;</td>";
                    }
                if($torremostrar=='3')
                $torremostrar='A y B';
                if($torremostrar=='1')
                $torremostrar='A';
                if($torremostrar=='2')
                $torremostrar='B';
                echo "<td>$torremostrar</td>";
                echo "<td><a class='btn btn-success' href='grupo_acceso.php?traer=1&id=$id'>Editar</a></td>";
                if($id!=1)
                echo "<td><a class='btn btn-danger' href='grupo_acceso.php?borrar=1&id=$id'>Borrar</a></td>";

            }
    }   
    ?> 
        
    </form>
</div>
</body>

