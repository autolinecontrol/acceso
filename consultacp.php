<?php

$codigo = filter_input ( INPUT_GET , 'codigo' , FILTER_SANITIZE_ENCODED ); 

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_CAP","mgeiqybt_autoline","acceso2018");
$res=$cnx->query("select * from visitantes where  codigo='$codigo'");

$datos = array();

foreach ($res as $row){
    array_push($datos, array(
        'nombre'=>$row['nombre'],
        'identificacion'=>$row['identificacion'],
        'codigo'=>$row['codigo'],
        
    ));
}    
echo utf8_encode(json_encode($datos));

?>