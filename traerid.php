<?php
require 'conexion.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sqlupdate="UPDATE visitantes SET estado='L' WHERE identificacion='$id'";
    //echo $sqlupdate;
    $resultado=mysqli_query($con,$sqlupdate);
}
if(isset($_GET['correo'])){
    $email=$_GET['correo'];
    //echo $email;
    $sqltraer="SELECT * FROM visitantes WHERE correo LIKE '%$email%'";
    //echo $sqltraer;
    $resultado=mysqli_query($con,$sqltraer);
    $validainsert=0;
    if(mysqli_num_rows($resultado)>0){
    while($fila = mysqli_fetch_assoc($resultado))
    {
        $nombre=$fila['nombre'];
        $identificacion=$fila['identificacion'];
        $correo=$fila['correo'];
        $estado=$fila['estado'];
        echo $nombre."<br>";
        echo $identificacion ."<br>";
        echo $correo."<br>";
        echo $estado."<br>";
        echo "<a class='btn btn-success' href='traerid.php?id=$identificacion'>Enviar Correo</a>";
    }}
    else{
        echo "este correo $email no existe";
    }
}

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>">
<input  name="correo" type="email" placeholder="Ingrese un Correo" autofocus >
<input type="submit" class="btn btn-success"value="Buscar">

</form>