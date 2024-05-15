 <?php
  include("../cabecera.php");
  include("../menu.php");
  include("egreso.php");
  include("../caja/caja.php");
  $caja = new Caja();

  $objeto = new Egreso();
  if (isset($_POST['id']) && !empty($_POST['id']))
  {
    $id = (int)$_POST['id'];
    $registros = $objeto->obtenerId($id);
    foreach ($registros as $item)
    {
      $egreso_id = $item['id'];
      $caja_id = $item['caja_id'];
      $monto_original= $item['monto'];
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
             <h3>Egreso</h3>
             <!--p class="text-subtitle text-muted">The default layout.</p-->
           </div>
           <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Editar Egreso</li>
               </ol>
             </nav>
           </div>
         </div>
       </div>

       <section class="section">
         <div class="card">
           <div class="card-header">
             <h4 class="card-title">Formulario Editar Egreso</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
             <form method="POST" role="form" action="editar.php">
               <input type="hidden" name="egreso_id" value= "<?php echo $egreso_id; ?>" />
               <input type="hidden" name="caja_id" value= "<?php echo $caja_id; ?>" />
               <input type="hidden" name="monto_original" value= "<?php echo $monto_original; ?>" />
               
               <div class="col-md-8 mb-3">
                 <label class="form-label">Tipo Egreso</label>
                 <select class="form-control" name="egreso_tipo_id" required autofocus tabindex="1">
                   <option value="0">Seleccione....</option>
                   <?php
                    $egresostipos = $objeto->listaEgresoTipo();
                    foreach ($egresostipos as $egresotipo) {
                      if ($egresotipo['id'] == $item['egreso_tipo'])
                      {
                      ?>
                       <option value="<?php echo $egresotipo['id']; ?>" selected> <?php echo $egresotipo['nombre']; ?> </option>
                      <?php
                      }
                      ?>
                     <option value="<?php echo $egresotipo['id']; ?>"> <?php echo $egresotipo['nombre']; ?> </option>
                     <?php
                     }
                    ?>
                 </select>
               </div>

               <div class="col-md-8 mb-3">
                 <label class="form-label">Monto</label>
                 <input name="monto" class="form-control" type="monto" onkeypress="return soloNumeros(event);" required value="<?php echo $item['monto']; ?>"  />
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
        if (isset($_POST['egreso_id']) && !empty($_POST['egreso_id']))
        {
          
          $egreso_id = $_POST['egreso_id'];
          $tipoegreso = $_POST['egreso_tipo_id'];
          $monto = $_POST['monto'];
          $caja_id = $_POST['caja_id'];
          $monto_original = $_POST['monto_original'];

          $todobien = $objeto->editar($egreso_id, $tipoegreso, $monto);
          if ($todobien) {
            $monto_actualizado =  $monto - $monto_original;
            $todobien = $caja->actualizaregresocaja($caja_id, $monto_actualizado ); 
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