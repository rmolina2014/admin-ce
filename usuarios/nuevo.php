<?php
include("../cabecera.php");
include("../menu.php");
include("usuario.php");
$objeto = new Usuario();
if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
  $usuario = $_POST['usuario'];
  $rela_persona = $_POST['id_persona'];
  $pass = md5($_POST['password']);
  //$id_perfil = $_POST['id_perfil'];
  $estado = $_POST['bloqueado'];
  $fechaingreso = date("Y-m-d");
  //$estado = 'Activo';

  $todobien = $objeto->nuevo($rela_persona, $usuario, $pass, $estado, $fechaingreso);
  if ($todobien) {
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    //header('Location: listado.php');
    exit;
  } else {
    ?>
    <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
      <button data-dismiss="alert" class="close" type="button">×</button>
      Lo sentimos, no se pudo guardar ...
    </div>
    <?php
  }
} else {
  ?>

  <!--inicio contenido-->
  <div id="main">
    <header class="mb-3">
      <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
      </a>
    </header>

    <div class="page-heading">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Usuarios</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <section class="section">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Formulario Agregar</h4>
          </div>
          <div class="card-body">
            <!--- contenido ---------------------------------------------------------->

            <!---formulario-->
            <form>
              <div class="col-md-8 mb-3">
                <label>D.N.I </label>
                <input name="dniusuario" id="dniusuario" class="form-control" type="number" tabindex="1" maxlength="10" required />
                <br>
                <!--button type="button" id="buscar_dni"
                  class="btn btn-sm btn-secondary d-inline-flex align-items-center">Buscar D.N.I.</button-->
              </div>
              <div class="col-md-8 mb-3">
                <div id="resultadoBusqueda"></div>
              </div>
            </form>

            <hr>

            <form method="POST" role="form" action="nuevo.php">

              <input type="hidden" id="id_persona" name="id_persona">

              <div class="col-md-8 mb-3">
                <label class="form-label">Nombre de Usuario*</label>
                <input name="usuario" class="form-control" type="text" tabindex="2" required />
              </div>

              <!--div class="col-md-8 mb-3">
                 <label class="form-label">Perfil</label>
                 <select class="form-select" name="id_perfil">
                   <option>Seleccionar.....</option>
                   <?php

                   /*$objeto = new Usuario();
                   $datos = $objeto->listaPerfil();
                   foreach ($datos as $item) {
                     ?>
                     <option value="<?php echo $item['id_perfil'] ?>">
                       <?php echo $item['perfil']; ?>
                     </option>
                   <?php
                   }*/
                   ?>
                 </select>
               </div-->

              <div class="col-md-8 mb-3">
                <label class="form-label">Password*</label>
                <input type="password" class="form-control" placeholder="8 caracteres max." id="password" name="password"
                  tabindex="3" maxlength="8" required>

                <!--div id="passstrength">
                  <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
                  <ul>
                    <li id="letter">Debe tener 8 caracteres</li>
                    <li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                    <li id="number">Al menos debería tener <strong>un número</strong></li>
                    <li id="length">Al menos debería tener <strong>un carácter especial</strong> como mínimo</li>
                  </ul>
                </div-->
              </div>


              <div class="col-md-8 mb-3">
                <label class="form-label">Bloqueado</label>
                <select class="form-select" name="bloqueado">
                  <option>Seleccionar.....</option>

                  <option value="0"> SI </option>
                  <option value="1"> NO </option>
                </select>
              </div>

              <div class="col-md-8 mb-3">

                <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center"
                  data-dismiss="modal" onclick="location.href='index.php';"> Cancelar

                </button>

                <button id="guardar" type="submit" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                  Guardar

                </button>

              </div>
            </form>

            <!--- fin ---------------------------------------------------------->
            <!--- fin contenido -->
          </div>
        </div>
      </section>
      <?php
      include("../pie.php");
      ?>

      <script src="../assets/js/jquery-3.6.3.min.js"></script>

      <script src="../assets/js/jquery.validate.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function () {

          /* $('#password').blur(function (e) {
             valor = $('#password').val();
             checkPassword(valor);
           });

           function checkPassword(valor) {
             var myregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
             if (myregex.test(valor)) {
               alert(valor + " es valido :-) !");
               return true;
             } else {
               alert(valor + " NO es valido!");
               return false;
             }
           }*/

          // buscar por dni 17/03/2024
          $("#dniusuario").blur(function () {
            var vdni = $("#dniusuario").val();
            $.ajax({
              url: "buscar_dni_en_usuario.php",
              type: "POST",
              data: { dni: vdni },
              success: function (response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                //alert(jsonData.estado);
                if (jsonData.estado == "ok") {
                  $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'> Persona : " + jsonData.nombre + ". Ya es Usuario del sistema</h6>");
                  
                  document.getElementById("guardar").disabled = true;
                }
                else { 
                      if (jsonData.estado == "error") {  
                       $("#id_persona").val(jsonData.id_persona);
                       $("#resultadoBusqueda").html(jsonData.mensaje); 
                       document.getElementById("guardar").disabled = false; 
                     }else{

                       $("#resultadoBusqueda").html(jsonData.mensaje); 
                       document.getElementById("guardar").disabled = true;                       

                     }

                 }

              },
              failure: function (data) {
                alert(response);
              },
              error: function (data) {
                alert(response);
              }
            });
          });
        }); //fin jquery   

      </script>
      <?php
}
?>