 <?php
  include("../cabecera.php");
  include("../menu.php");
  include("usuario.php");

  $objeto = new Usuario();
  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int)$_POST['id'];
    $registros = $objeto->usuariosLista($id);
    foreach ($registros as $item) {
      $id_usuario = $item['id'];
    }
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
             <h4 class="card-title">Formulario Editar</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
             <form method="POST" role="form" action="editar.php">

               <div class="col-md-8 mb-3">
                 <label class="form-label">DNI</label>
                 <input name="codigo" class="form-control" type="text" tabindex="1" required value="<?php echo $item['dni']; ?>" disabled />
               </div>
               <input name="id_usuario" class="form-control" type="hidden" tabindex="1" value="<?php echo $id_usuario; ?>" />

               <div class="col-md-8 mb-3">
                 <label class="form-label">Apellido Nombre </label>
                 <input name="apellido_nombre" class="form-control" type="text" tabindex="3" required value="<?php echo $item['apellidonombre']; ?>" disabled />
               </div>

               <div class="col-md-8 mb-3">
                 <label class="form-label">Nombre de Usuario</label>
                 <input name="usuario" class="form-control" type="text" tabindex="2" required value="<?php echo $item['usuario']; ?>" />
               </div>


               <!--div class="col-md-8 mb-3">
    <label class="form-label">Password</label>
    <input type="text" class="form-control" placeholder="8 caracteres max." id="password" name="password" tabindex="5" maxlength="8" required>

     
<div id="passstrength">
   <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
   <ul>
      <li id="letter">Debe tener 8 caracteres</li>
      <li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
      <li id="number">Al menos debería tener <strong>un número</strong></li>
      <li id="length">Al menos debería tener <strong>un carácter especial</strong> como mínimo</li>
   </ul>
</div>
  </div-->




               <div class="col-md-8 mb-3">
                 <label class="form-label">Bloqueado</label>
                 <select class="form-select" name="bloqueado">
                   <option>Seleccionar.....</option>

                   <option value="0"> SI </option>
                   <option value="1"> NO </option>
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
        include("../pie.php");
      } else {
        if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
          //   $nInscripcion,$nombre,$dni,$curso,$horario,$sucursal,$email,$observacion,$otros,$idCurso
          $usuario = $_POST['usuario'];
          $bloqueado = $_POST['bloqueado'];
          $id_usuario = $_POST['id_usuario'];

          //$fechaingreso = date("Y-m-d");
          //$estado = 'Activo';

          $todobien = $objeto->editar($id_usuario, $usuario, $bloqueado);
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