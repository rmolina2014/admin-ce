 <?php
  include("../cabecera.php");
  include("../menu.php");
  include("alumno.php");

  $objeto = new Alumno();
  if (isset($_POST['id']) && !empty($_POST['id']))
  {
    $id = (int)$_POST['id'];
    $registros = $objeto->obtenerId($id);
    foreach ($registros as $item)
    {
      $alumno_id = $item['alumno_id'];
  ?>

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
             <h3>Alumno</h3>
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
             <h4 class="card-title">Formulario Editar</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
             <form method="POST" role="form" action="editar.php">
               <input type="hidden" name="alumno_id" value= "<?php echo $alumno_id; ?>" />
               
               <div class="col-md-8 mb-3">
                 <label class="form-label">DNI</label>
                 <input name="dni" class="form-control" type="text" tabindex="1" required value="<?php echo $item['dni']; ?>" disabled />
               </div>

               <div class="col-md-8 mb-3">
                 <label class="form-label">Apellido Nombre </label>
                 <input name="apellidonombre" class="form-control" type="text" tabindex="3" required value="<?php echo $item['apellidonombre']; ?>" disabled />
               </div>

               <div class="col-md-8 mb-3">
                 <label class="form-label">Edad</label>
                 <input name="edad" class="form-control" type="text" tabindex="2" required value="<?php echo $item['edad']; ?>" />
               </div>

               <div class="col-md-8 mb-3">
                 <label class="form-label">Grupo Sanguineo</label>
                 <input name="gruposanguineo" class="form-control" type="text" tabindex="2" required value="<?php echo $item['gruposanguineo']; ?>"/>
               </div>

               <div class="col-md-8 mb-3">
                 <label class="form-label">Carrera</label>
                 <select class="form-control" name="carrera_id" required autofocus tabindex="1">
                   <option value="0">Seleccione....</option>
                   <?php
                    $carreras = $objeto->listaCarrera();
                    foreach ($carreras as $carrera) {
                      if ($carrera['id'] == $item['carrera_id'])
                      {
                      ?>
                       <option value="<?php echo $carrera['id']; ?>" selected> <?php echo $carrera['nombre']; ?> </option>
                      <?php
                      }
                      ?>
                     <option value="<?php echo $carrera['id']; ?>"> <?php echo $carrera['nombre']; ?> </option>
                     <?php
                     }
                    ?>
                 </select>
               </div>

               <div class="col-md-8 mb-3">
                 <label>Estado</label>
                 <select class="form-control" name="estado" required>
                   <option value="<?php echo $item['estado']; ?>"> <?php echo $item['estado']; ?> </option>
                   <option value="Activo"> Activo </option>
                   <option value="Inactivo"> Inactivo </option>
                 </select>
               </div>

               <div class="col-md-8 mb-3">
                 <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar
                 </button>
                 <button type="submit" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                   Guardar
                 </button>
               </div>
             </form>

             <!--- fin -->
             <!--- fin contenido -->
           </div>
         </div>
       </section>
      <?php
      }
       include("../pie.php");
      } else {
        if (isset($_POST['edad']) && !empty($_POST['edad']))
        {
          //   $nInscripcion,$nombre,$dni,$curso,$horario,$sucursal,$email,$observacion,$otros,$idCurso
          $edad = $_POST['edad'];
          $carrera_id = $_POST['carrera_id'];
          $gruposanguineo = $_POST['gruposanguineo'];
          $alumno_id = $_POST['alumno_id'];
          $estado = $_POST['estado'];

          //$fechaingreso = date("Y-m-d");
          //$estado = 'Activo';

          $todobien = $objeto->editar($alumno_id, $edad, $gruposanguineo, $carrera_id, $estado);
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
        }
      }
      ?>