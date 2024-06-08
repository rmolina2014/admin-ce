<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("persona.php");

  $objeto = new Persona();
  if (isset($_POST['dnipersona']) && !empty($_POST['dnipersona'])) {
    //   nuevo($apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail)
    //$id = $_POST['id'];
    $apellidonombre= $_POST['apellido_nombre'];
    $dni = $_POST['dnipersona'];
    $domicilio=$_POST['domicilio'];
    $cel1= $_POST['cel_prin'];
    $cel2=$_POST['cel_alte'];
    $mail=$_POST['mail'];
    $alumnosi=$_POST['alumnosi'];

    //$fechaingreso = date("Y-m-d");
    //$estado = 'Activo';

    $todobien = $objeto->nuevo($apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail);
    if ($todobien>0) {
     
        if (isset($_POST['alumnosi'])) {
            // El checkbox está marcado
            //aca tengo que llamar a un nuevoalumnodirecto.php pasandole el id y el numero de documento
            //para que carguen los demas datos como alumno
          echo "<script language='Javascript'> location.href=\"../alumno/nuevoalumnodirecto.php?dni=$dni&id=$todobien\"; </script>";

            echo "Checkbox está marcado.";
        } else {
            // El checkbox no está marcado
            echo "<script language=Javascript> location.href=\"index.php\"; </script>";
            
        }     
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
             <h3>Personas</h3>
             <!--p class="text-subtitle text-muted">The default layout.</p-->
           </div>
           <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Personas</li>
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
             <form method="POST" role="form" action="nuevo.php">


             <!--div class="col-md-8 mb-3">
              <label>D.N.I *</label>
              <input name="dni" id="dni"  class="form-control" type="text" tabindex="7" maxlength="8" tabindex="9" required />
              <br>
              <button id="buscar_dni">Buscar D.N.I.</button>
              <div id="resultadoBusqueda"></div>
            </div-->
               <div id="resultadoBusqueda"></div>
               <div class="col-md-8 mb-3">
                 <label class="form-label">N° DNI*</label>
                 <input name="dnipersona" id="dnipersona" class="form-control" type="text" tabindex="1" required autofocus />
               </div>


  <div id="resultadoBusquedaNombre"></div>
  <div class="col-md-8 mb-3">
    <label class="form-label">Apellido y Nombre*</label>
    <input name="apellido_nombre" id="apellido_nombre"  class="form-control" type="text" tabindex="2" required />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label" >Domicilio*</label>
    <input name="domicilio"  class="form-control" type="text" tabindex="3" required />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Celular Principal</label>
    <input name="cel_prin"  class="form-control" type="text" tabindex="4" />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Celular Alternativo</label>
    <input name="cel_alte"  class="form-control" type="text" tabindex="4" />
  </div>  

  <div class="col-md-8 mb-3">
    <label class="form-label">Mail</label>
    <input name="mail"  class="form-control" type="email" tabindex="4" />
  </div>

  <div  class="form-check">
      <div class="checkbox">
      <input type="checkbox" id="alumnosi" name="alumnosi" value="APLICAR" class="form-check-input" >
      <label for="checkbox1">Es alumno</label>
      </div>
 </div>  

               <div style="padding: 45px;" class="col-md-8 mb-3">

                 <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar

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
         $(document).ready(function() {


            // buscar por dni 09/08/2018
          $("#dnipersona").blur(function () {
            var vdni = $("#dnipersona").val();
            $.ajax({
              url: "buscar_dni.php",
              type: "POST",
              data: { dni: vdni },
              success: function (response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                //alert(jsonData.estado);
                if (jsonData.estado == "ok") {
                  $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'> Persona : " + jsonData.nombre + ". No se puede agregar porque ya existe</h6>");
                  $("#id_persona").val(jsonData.id_persona);
                  document.getElementById("guardar").disabled = true;
                }
                else {
                 $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'>" + jsonData.mensaje + "</h6>");
                 document.getElementById("guardar").disabled = false;
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

          $("#apellido_nombre").blur(function () {
            var vnombre = $("#apellido_nombre").val();
            $.ajax({
              url: "buscar_nombre.php",
              type: "POST",
              data: { nombre: vnombre },
              success: function (response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                //alert(jsonData.estado);
                if (jsonData.estado == "ok") {
                  $("#resultadoBusquedaNombre").html("<h6 class='text-muted mb-0'> Persona : " + jsonData.nombre + ". No se puede agregar porque ya existe</h6>");
                  $("#id_persona").val(jsonData.id_persona);
                  document.getElementById("guardar").disabled = true;
                }
                else {
                 $("#resultadoBusquedaNombre").html("<h6 class='text-muted mb-0'>" + jsonData.mensaje + "</h6>");
                 document.getElementById("guardar").disabled = false;
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


 
  }) //fin jquery   


        
       </script>
     <?php
    }
      ?>