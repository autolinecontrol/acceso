<html>
    <head>
       <meta charset="UTF-8" />
       <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Bienvenido <?= $nombre ?></title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
        
        
       <meta charset="UTF-8">
       <link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        <title>Inventario</title>
         
    </head>
    
    <body>
        <div class="codrops-top clearfix">
				<a class="codrops-icon codrops-icon-prev" href="http://localhost/sinplantilla/"><span>Volver</span></a>
				<span class="right"><a class="codrops-icon codrops-icon-drop" href="http://localhost/sinplantilla/"><span>Home</span></a></span>
		</div>
		
        <br/><br/>
        <div id="overlay"></div>
        <div id="nuevaVentana">
            <div id="box-header"></div>
            <form  class="contact_form">
            
                <ul>
                <li>
                    <h2>Usuarios</h2>
                    <span class="required_notification">* Datos requeridos</span>
                </li>
                <li>
                    <label for="name">*Identificacion:</label>
                    <input type="text" placeholder="Cedula" id ="nuevaIdentificacionID" required />
                </li>
                <li>
                    <label for="name">*Nombre:</label>
                    <input type="text" placeholder="Nombres Apellidos" id ="nuevoUsuarioID" required />
                </li>
                <li>
                    <label for="email">*Email:</label>
                    <input type="email" name="email" placeholder="soporte@gmail.com" id ="nuevoEmailID" required />
                    <span class="form_hint">Formato correcto: "name@something.com"</span>
                </li>
                <li>
                    <label for="name">*Oficina:</label>
                    <select id ="nuevaOficinaID" required>
                        <option value="0" >Escoja una Oficina: </option>
                        <?php
                        $mysql_host    = 'localhost';
                        $mysql_usuario = 'mgeiqybt_autoline';
                        $mysql_clave   = 'acceso2018';
                        $mysql_BD      = 'mgeiqybt_CAP';
                        $mysqli = new mysqli($mysql_host, $mysql_usuario,$mysql_clave,$mysql_BD);
                        $query = $mysqli -> query ("SELECT * FROM oficinas");
                        while ($valores = mysqli_fetch_array($query)) {?>
                        <option value="<?php echo $valores['Numero']; ?>"><?php echo $valores['Nombre']; ?></option>
				<?php } ?>
                    
                    </select>
                    
                </li>
                <li>
                    <label for="Fecha">*Ingreso:</label>
                    <input type="datetime-local" name="IngresoID" value="<?php echo date('Y-m-d').'T'.date('08:00'); ?>" placeholder="yyyy-MM-hh HH:mm:ss" id="IngresoID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                </li>
                <li>
                    <label for="Fecha">*Salida:</label>
                    <input type="datetime-local" name="IngresoID" value="<?php echo date('Y-m-d').'T'.date('18:00'); ?>" placeholder="yyyy-MM-hh HH:mm:ss" id ="SalidaID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                </li>
                
                <li>
                    <button onmousedown="ejecutarNuevaVentana()" id="botonCerrar" class="btn btn-primary" > Mostrar Usuarios </button>
                   <button onmousedown="agregarUsuario()" style="margin-left: 2%;" class="btn btn-success"> Agregar Usuario </button>
                   <br/><br/><br/>
                </li>
            </ul>
            </form>
        </div>     
        <div id="wrapper">
            <div id="info"></div>
        </div>
        <script type="text/javascript">
            var resultado = document.getElementById("info");
            
            function mostrarUsuarios()
            {
                var xmlhttp; 
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest;
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState===4 && xmlhttp.status === 200)
                    {
                        resultado.innerHTML = xmlhttp.responseText;
                    }
                }
                
                xmlhttp.open("GET","servidor1.php?personas=" + "personas", true)
                xmlhttp.send();
                
            }
            //mostrarUsuarios();
            
            
            function ejecutarNuevaVentana()
            {
                overlay.style.opacity = .5;
                
                 if(overlay.style.display === "block"){
                    overlay.style.display = "none";
                    nuevaVentana.style.display = "none";
                }else{
                    overlay.style.display = "block";
                    nuevaVentana.style.display = "block";
                }
                
                document.getElementById("nuevoUsuarioID").value ="";
                document.getElementById("nuevoEmailID").value ="";
                
                mostrarUsuarios();
            }
            
            function agregarUsuario()
            {
                overlay.style.display = "none";
                nuevaVentana.style.display = "none";
                
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest;
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                var nuevoUsuario = document.getElementById("nuevoUsuarioID").value;
                var nuevoEmail = document.getElementById("nuevoEmailID").value;
                var nuevaIdentificacion = document.getElementById("nuevaIdentificacionID").value;
                var nuevaOficina = document.getElementById("nuevaOficinaID").value;
                var nuevoIngreso = document.getElementById("IngresoID").value;
                var nuevoSalida = document.getElementById("SalidaID").value;
                
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState===4 && this.status === 200)
                    {
                        mostrarUsuarios();
                    }
                }
                xmlhttp.open("GET","servidor1.php?nuevoUsuario="+nuevoUsuario+"&nuevoEmail="+nuevoEmail+"&nuevaIdentificacion="+nuevaIdentificacion+
                        "&nuevaOficina="+nuevaOficina+"&nuevoIngreso="+nuevoIngreso+"&nuevoSalida="+nuevoSalida,true);
                xmlhttp.send();
            }
        </script>
    </body>
</html>
