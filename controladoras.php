<?php
require 'db.php';
require 'conexion.php';
//ob_start();
$validar=0;

?>
<head>
	<link href="StyleSheet.css" rel="stylesheet" />
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>    
    <title>Controladoras</title>
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
    
    $sql="select * from controladoras order by direccionipcontroladora";
    if(isset($_POST['crear']))
    {
        $nombre=$_POST['nombre'];
        $direccion=$_POST['direccion'];
        $estado=$_POST['estado'];
        $grupo=$_POST['grupo'];
        $torre=$_POST['torre'];
        $sqlinsertar="INSERT INTO controladoras (nombrecontroladora, direccionipcontroladora, estado, Grupo,torre) 
        VALUES ('$nombre','$direccion','$estado','$grupo','$torre')";
        echo $sqlinsertar;
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
        $torre=$_POST['torre'];
        $sqlactualizar="REPLACE INTO controladoras (idcontroladora,nombrecontroladora, direccionipcontroladora, estado, Grupo,torre)
        VALUES ('$idcontroladora','$nombre','$direccion','$estado','$grupo','$torre')";
        $resultadoactualizar = mysqli_query($con,$sqlactualizar);
    }
    if(isset($_GET['borrar']))
    {
        $idcontroladora=$_GET['idcontroladora'];
        $sqlborrar="DELETE FROM controladoras WHERE idcontroladora =$idcontroladora";
        $resultadoborrar = mysqli_query($con,$sqlborrar);
    }  
    $resultado = mysqli_query($con,$sql);
    ?>           
    <header class="header-two-bars">
        <div class="header-first-bar">
            <div class="header-limiter">
                <h1><a href="perfil.php">Teleport<span>Business<span>Park</span></a></h1>                 
                <nav>
                    <a href="perfil.php">Inicio</a>
                   
                </nav>
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
        </div>
        <div class="header-second-bar" style="text-align:center">             
            <br>
            <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">               
                <?php
                
                if($validar==0)
                {
                    echo "
                    <input type='text' name='nombre'  placeholder='Nombre Controladora'><br><br>
                    <input type='text' name='direccion'  placeholder='Direccion Controladora'><br><br>
                    <input type='text' name='estado'  placeholder='Estado Controladora'><br><br>
                    <input type='text' name='grupo'  placeholder='Grupo Controladora'><br><br>
                    <select name='torre'>
                        <option value='1' selected>Torre A</option> 
                        <option value='2' >Torre B</option>
                    </select><br><br>
                    <input type='submit' name='crear' class='btn btn-success' value='Guardar'>";
                }        
                if($validar==1)
                {
                    while($fila = mysqli_fetch_assoc($resultado))
                    {
                        $id=  $fila['idcontroladora'];
                        $nombre= $fila['nombrecontroladora'];
                        $direccion= $fila['direccionipcontroladora'];
                        $estado= $fila['estado'];
                        $grupo= $fila['grupo'];
                        $torre = $fila['torre'];
                        echo "
                        <input type='text' name='idcontroladora'  placeholder='Id Controladora' value='$id'><br><br>
                        <input type='text' name='nombre'  placeholder='Nombre Controladora' value='$nombre'><br><br>
                        <input type='text' name='direccion'  placeholder='Direccion Controladora' value='$direccion'><br><br>
                        <input type='text' name='estado'  placeholder='Estado Controladora' value='$estado'><br><br>
                        <input type='text' name='grupo'  placeholder='Grupo Controladora' value='$grupo'><br><br>
                         <input type='text' name='torre'  placeholder='torre' value='$torre'><br><br>
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
            <th>Direccion</th>
            <th>Estado</th>
            <th>Grupo</th>
            <th>Torre</th>
            <th>Actualizar</th>
            <th>Borrar</th>
        </tr>
        <?php
        while($fila = mysqli_fetch_assoc($resultado))
        {
            echo '<tr>';
            $id= $fila['idcontroladora'];
            echo '<td>' . $fila['idcontroladora'] . '</td>';
            echo '<td>' . $fila['nombrecontroladora'] . '</td>';
            echo '<td>' . $fila['direccionipcontroladora'] . '</td>';
            echo '<td>' . $fila['estado'] . '</td>';
            echo '<td>' . $fila['grupo'] . '</td>';
            if($fila['torre']==1)$ntorre="A";
            if($fila['torre']==2)$ntorre="B";
            if($fila['torre']==3)$ntorre="A y B";
            echo '<td>' . $ntorre .'</td>' ;
            echo "<input type='hidden' name='idcontroladora' value='$id'>";
            
            echo "<td><a class='btn btn-success' href='controladoras.php?traer=1&idcontroladora=$id'>Actualizar</a></td>";
            echo "<td><a class='btn btn-danger' href='controladoras.php?borrar=1&idcontroladora=$id'>Borrar</a></td>";
        }
        mysqli_close($con);
        echo "</table>";
    }   
    ?>
        
    </form>
</div>
</body>

