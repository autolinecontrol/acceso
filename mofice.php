
<head>
    <meta http-equiv="refresh" content="1">
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Reporte Salidas</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
        <form  method="get" name="ingresodep" id="contFrm" action="">    
            <div class="form">
            
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                    <h1><a href="#">Central<span>Point</span></a></h1>
                    

            
                
                </div>

            </div>


        </header>
<?php

require 'conexion.php';

$resultado = mysqli_query($con, "select * from pingreso "); 
    
    $Datoss = mysqli_fetch_array($resultado);  

    $num  = $Datoss["oficina"];   
    
//echo $num;

$resultado = mysqli_query($con, "select * from oficinas where Numero = '$num'"); 
    
    $Datoss = mysqli_fetch_array($resultado);  

    $nombre  = $Datoss["Nombre"];   
    $numero  = $Datoss["Numero"];   
    $cupos   = $Datoss["Cupos"];      
                
                


?>
<div class="container-fluid">
  <h1><br></h1>
    
      <style type="text/css">
      h1 {font-size:60px;
          color: black;
        }
     </style>
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="background-color:white;">
    <h1 >Oficina:</h1>
    </div>
    <div class="col-sm-6" style="background-color:white;">
      <h1><?php echo $nombre; ?> </h1>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="background-color:lightgray;">
      <h1 class="text-rigth">Disponibles:</h1>
    </div>
    <div class="col-sm-6" style="background-color:lightgray;">
      <h1><?php echo $cupos-$numero; ?> </h1>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="background-color:white;">
      <h1 class="text-rigth">Cupos:</h1>
    </div>
    <div class="col-sm-6" style="background-color:white;">
      <h1><?php echo $numero; ?> </h1>
    </div>
  </div>
</div>
