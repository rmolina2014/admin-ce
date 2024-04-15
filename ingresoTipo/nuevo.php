<?php
include("../cabecera.php");
include("../menu.php");
include("ingreso.php");
$objeto = new Ingreso();
if (isset($_POST['nombretipo']) && !empty($_POST['nombretipo'])) {

  $nombretipo = $_POST['nombretipo'];
  $todobien = $objeto->nuevoIngresoTipo($nombretipo );

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
            <h3>Tipo de Ingreso</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tipo de Ingreso</li>
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
                <label class="form-label">Nombre</label>
                <input name="nombretipo" class="form-control" id="nombretipo" required autofocus />
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