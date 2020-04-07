<link rel="stylesheet" href="style2.css">
<br/><br/>
       
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
                
                xmlhttp.open("GET","Clientes/servidor.php?personas=" + "personas", true)
                xmlhttp.send();
                
            }
            mostrarUsuarios();
            function editarUsuario(usuarioID) 
            {
                var nombreID        = "nombreID" + usuarioID;
                var emailID         = "emailID" + usuarioID;
                var borrar          = "borrar" + usuarioID;
                var actualizar      = "actualizar" + usuarioID;
                var ingresoID       = "ingresoID" + usuarioID;
                var salidaID       = "salidaID" + usuarioID;
                var editarIngresoID  = ingresoID + "-editar";
                var editarSalidaID  = salidaID + "-editar";
                
                var ingresoDelUsuario= document.getElementById(ingresoID).innerHTML;
                var salidaDelUsuario= document.getElementById(salidaID).innerHTML;
                var parent = document.querySelector("#" + ingresoID);
                
                
                if(parent.querySelector("#" + editarIngresoID)=== null){
                    document.getElementById(ingresoID).innerHTML = '<input type = "text" id = "' + editarIngresoID + '" value="'+ingresoDelUsuario+'">';
                    document.getElementById(salidaID).innerHTML = '<input type = "text" id = "' + editarSalidaID + '" value="'+salidaDelUsuario+'">';
                    document.getElementById(borrar).disabled = "true";
                    document.getElementById(actualizar).style.display= "block";
                }
            }
            function actualizarUsuario(usuarioID)
            {
                var xmlhttp; 
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest;
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                var ingresoActualizado = document.getElementById("ingresoID" + usuarioID + "-editar").value;
                var salidaActualizado = document.getElementById("salidaID" + usuarioID + "-editar").value;
                
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState===4 && this.status === 200)
                    {
                        mostrarUsuarios();
                    }
                }
                
                xmlhttp.open("GET","Clientes/servidor.php?usuarioIDActualizado="+ usuarioID + "&ingresoActualizado=" + ingresoActualizado + "&salidaActualizado=" + salidaActualizado, true);
                xmlhttp.send();
                
            }
            function borrarUsuario(usuarioID)
            {
                var respuesta = confirm("Estas Seguro de borrar este usuario?");
                
                if(respuesta===true)
                {
                    if(window.XMLHttpRequest){
                        xmlhttp = new XMLHttpRequest;
                    }else{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                
                   
                    xmlhttp.onreadystatechange = function()
                    {
                        if(this.readyState===4 && this.status === 200)
                        {
                            mostrarUsuarios();
                        }
                    }
                    
                    xmlhttp.open("GET","Clientes/servidor.php?usuarioIDEliminado="+usuarioID);
                    xmlhttp.send();
                }
            }
            
            var overlay = document.getElementById("overlay");
            var nuevaVentana = document.getElementById("nuevaVentana");
            
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
                xmlhttp.open("GET","Clientes/servidor.php?nuevoUsuario="+nuevoUsuario+"&nuevoEmail="+nuevoEmail+"&nuevaIdentificacion="+nuevaIdentificacion+
                        "&nuevaOficina="+nuevaOficina+"&nuevoIngreso="+nuevoIngreso+"&nuevoSalida="+nuevoSalida,true);
                xmlhttp.send();
            }
        </script>
