<header class="header-two-bars">
  <label>Administrando:<?php echo $nombre; ?> Oficina: <?php echo $nombreoficina; ?> Perfil:
  <?php
  switch ($activo)
  {
    case '5':
      echo "Super Administrador";
    break;
    case '4':
      echo "Administrador";
    break;
    case '3':
      echo "Funcionarios";
    break;
    case '2':
      echo "Visitantes";
    break;
    case '1':
      echo "Inactivo";
    break;
    }
  ?>
  </label>
  <div class="header-first-bar">
    <div class="header-limiter">

      <h1><a href="perfil.php">Teleport&nbsp;</span></a></h1>
      <?php
      if($activo==2)
      {
        echo "
        <ul class='nav'>
          <ul>
            <li class='dropdown'>
              <a href='javascript:void(0)' class='dropbtn'>Visitantes</a>
              <div class='dropdown-content'>
                <a href='perfil.php'  >Registrar Visitantes</a>
                <a href='mostrar.php' >Mostrar Visitantes</a>
                <a href='importar2.php' >Masivo Visitantes</a>
              </div>
            </li>
          </ul>
        ";
      }
      if($activo==3)
      {
        echo '
        <ul class="nav">
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropbtn">Visitantes</a>
              <div class="dropdown-content">
                <a href="perfil.php"  >Registrar Visitantes</a>
                <a href="mostrar.php" >Mostrar Visitantes</a>
                <a href="importar2.php" >Masivo Visitantes</a>
              </div>
            </li>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropbtn" >Contratistas</a>
              <div class="dropdown-content">
                <a href="perfil2.php" >Registrar Contratistas</a>
                <a href="mostrarc.php" >Mostrar Contratistas</a>
              </div>
            </li>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropbtn" >Funcionarios</a>
              <div class="dropdown-content" >
                <a href="perfil1.php" >Registrar Funcionarios</a>
                <a href="mostrarf.php" >Mostrar Funcionarios</a>
              </div>
            </li>
          </ul>
          ';
      }

                        if($activo==4)
                        {
                           echo
                           '
                           <ul class="nav">
                                <ul>
                                  <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn">Visitantes</a>
                                    <div class="dropdown-content">
                                      <a href="perfil.php"  >Registrar Visitantes</a>
                                      <a href="mostrar.php" >Mostrar Visitantes</a>
                                      <a href="importar2.php" >Masivo Visitantes</a>
                                    </div>
                                  </li>
                                  <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn" >Contratistas</a>
                                    <div class="dropdown-content">
                                      <a href="perfil2.php" >Registrar Contratistas</a>
                                      <a href="mostrarc.php" >Mostrar Contratistas</a>
                                    </div>
                                  </li>
                                  <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn" >Funcionarios</a>
                                    <div class="dropdown-content" >
                                      <a href="perfil1.php" >Registrar Funcionarios</a>
                                      <a href="mostrarf.php" >Mostrar Funcionarios</a>
                                      <a href="mostrarFuncionarios.php"  >Buscar<br>Funcionarios x Oficina</a>

                                    </div>
                                  </li>
                                  <li class="dropdown">
                                   <a href="activarfuncionarios.php" class="dropbtn" >Roles <br> Administradores</a>
                                   </li>
                                   <li class="dropdown">
                                   <a href="logregistros.php" class="dropbtn" >Log<br>Registros</a>
                                   </li>

                            </ul>

                           ';

                        }

                         if($activo==5)
                        {
                            echo
                           '
                           <ul class="nav">
                                <ul>
                                 <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn">Visitantes</a>
                                    <div class="dropdown-content">
                                      <a href="perfil.php"  >Registrar Visitantes</a>
                                      <a href="mostrar.php" >Mostrar Visitantes</a>
                                      
                                    </div>
                                  </li>
                                  <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn" >Estudiantes</a>
                                    <div class="dropdown-content">
                                      <a href="perfil2.php" >Registrar Estudiantes</a>
                                      <a href="mostrarc.php" >Mostrar Estudiantes</a>
                                      <a href="importar2.php" >Masivo Estudiantes</a>
                                    </div>
                                  </li>
                                  <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropbtn" >Funcionarios</a>
                                    <div class="dropdown-content" >
                                      <a href="perfil1.php" >Registrar Funcionarios</a>
                                      <a href="mostrarf.php" >Mostrar Funcionarios</a>
                                      <a href="mostrarFuncionarios.php" class="dropbtn" >Buscar Funcionarios<br>x Oficina</a>
                                      <a href="importar2.php" >Masivo Funcionarios</a>

                                    </div>
                                  </li>

                                  <li class="dropdown">
                                   <a href="javascript:void(0)" class="dropbtn" >Administrar</a>
                                   <div class="dropdown-content" >
                                   <a href="activarfuncionarios.php" >Roles Administradores</a>
                                  <a href="grupo_acceso.php">Crear Grupos de Acceso</a>
                                  <a href="grupo_dia.php">Crear Grupos de Dias</a>
                                  <a href="grupo_horario.php">Crear Grupos de Horario</a>
                                    ';// <a href="ofice.php" >Oficinas</a>
                                    echo'
                                   </li>
                                   <li class="dropdown">
				                          <a href="javascript:void(0)" class="dropbtn" >Reportes</a>
				                            <div class="dropdown-content" >
                                   <a href="logregistros.php">Mostrar Registros Creados</a>
			                              <a href="reportemovimientos.php">Mostrar Movimientos Usuarios</a>

                                     <a href="buscarlog.php">Buscar Movimientos Controladoras</a>
			                                <a href="mostrarlog.php">Mostrar Movimientos Controladoras</a>
                                   </li>

                                   </ul>

                                    ';
                        }

                        ?>
                        <!-- <img src="assets/logogo.png"width="200"> -->
                      <!--<h1><a> Go Security </a></h1>!-->
                    <a href="logout.php" class="logout-button">Logout</a>

                </div>

            </div>
            </header>