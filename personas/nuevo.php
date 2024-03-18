 <?php
  include("../cabecera.php");
  include("../menu.php");
  include("persona.php");

  $objeto = new Persona();
  if (isset($_POST['dni']) && !empty($_POST['dni'])) {
    //   nuevo($apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail)
//$id = $_POST['id'];
$apellidonombre= $_POST['apellido_nombre'];
$dni = $_POST['dni'];
$domicilio=$_POST['domicilio'];
$cel1= $_POST['cel_prin'];
$cel2=$_POST['cel_alte'];
$mail=$_POST['mail'];

    //$fechaingreso = date("Y-m-d");
    //$estado = 'Activo';

    $todobien = $objeto->nuevo($apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail);
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
                 <input name="dni" id="dni" class="form-control" type="text" tabindex="1" required autofocus />
               </div>


  <div class="col-md-8 mb-3">
    <label class="form-label">Apellido y Nombre*</label>
    <input name="apellido_nombre"  class="form-control" type="text" tabindex="2" required />
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

               <div class="col-md-8 mb-3">

                 <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar

                 </button>

                 <button type="submit" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
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
      $('#dni').blur(function(){
          event.preventDefault();
          var vdni = $("#dni").val();
          //alert(vdni);
          console.log(vdni);
          if (vdni != "") {
              $.post("personas/verificarPersona.php", {dni: vdni}, function(mensaje) {
                  $("#resultadoBusqueda").html(mensaje);
              }); 
          } else { 
                 ("#resultadoBusqueda").html('sin Datos.');
                 }
      });// fin buscar

 
  }) //fin jquery   


        
       </script>
     <?php
    }
      ?>