<?php
include ("../cabecera.php");
include ("../menu.php");
include ("caja.php");
$objeto = new Caja();
if (isset($_POST['monto']) && !empty($_POST['monto'])) {

  $importe_inicio = $_POST['monto'];
  $fecha_apertura = date("Y-m-d H:i:s");
  $importe_cierre = 0;
  $fecha_cierre = '2024-01-01';
  $estado = 'Abierta';
  $saldo = 0;

  $todobien = $objeto->nuevo($importe_inicio, $fecha_apertura, $importe_cierre, $fecha_cierre, $estado, $saldo);
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
            <h3>Caja</h3>
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

            <form method="POST" role="form" action="nuevo.php">

              <div class="col-md-8 mb-3">
                <label class="form-label">Monto</label>
                <input name="monto" class="form-control" type="text" tabindex="1" maxlength="15"
                  onkeypress="return soloNumeros(event);" required autofocus />
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
            <?php
}
?>