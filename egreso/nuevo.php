<?php
include("../cabecera.php");
include("../menu.php");
include("egreso.php");
$objeto = new Egreso();
if (isset($_POST['monto']) && !empty($_POST['monto'])) {

  $monto = $_POST['monto'];
  $fecha_egreso = date("Y-m-d H:i:s");
  $caja_id = $_POST['caja_id'];
  $usuario_id = $_POST['usuario_id'];
  $egreso_tipo = $_POST['egreso_tipo_id'];

  $todobien = $objeto->nuevo(
    $monto,
    $fecha_egreso,
    $caja_id,
    $usuario_id,
    $egreso_tipo
  );
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
            <h3>Egreso</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Egreso</li>
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

            <form method="POST" role="form" action="nuevo.php">

              <div class="col-md-8 mb-3">
                <?php
                //buscar caja
                $caja = $objeto->buscarCajaAbierta();
                ?>

                <label class="form-label">Caja : <?php
                                                  //buscar caja
                                                  echo $caja;
                                                  ?> </label>
                <input type="hidden" name="caja_id" value="<?php
                                                            //buscar caja
                                                            echo $caja;
                                                            ?>">
                <input type="hidden" name="usuario_id" value="<?php
                                                            //buscar caja
                                                            echo $_SESSION['sesion_id'];
                                                            ?>">                                            

              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Tipo Egreso</label>
                <select class="form-control" name="egreso_tipo_id" required autofocus tabindex="1">
                  <option value="0">Seleccione....</option>
                  <?php

                  $items = $objeto->listaEgresoTipo();

                  foreach ($items as $item) {
                  ?>
                    <option value="<?php echo $item['id']; ?>"> <?php echo $item['nombre']; ?> </option>
                  <?php
                  }
                  ?>
                </select>
                
              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Monto</label>
                <input name="monto" class="form-control" type="monto" onkeypress="return soloNumeros(event);" required autofocus />
              </div>

              <div class="col-md-8 mb-3">
                <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar
                </button>
                <button id="guardar" type="submit" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                  Guardar
                </button>
              </div>

            </form>
          <?php
        }

    include ("../pie.php");
          ?>