<?php
include("../cabecera.php");
include("../menu.php");
include("carrera.php");
$objeto = new Carrera();
if (isset($_POST['nombrecarrera']) && !empty($_POST['nombrecarrera'])) {

  $nombre = $_POST['nombrecarrera'];
  $cantidadcuotas = $_POST['cantidadcuotas'];
  $costocurso = $_POST['costocurso'];
  $costoinscripcion = $_POST['costoinscripcion'];
  $detalles = $_POST['detalles'];


  $todobien = $objeto->nuevaCarrera($nombre, $cantidadcuotas,$costocurso,$costoinscripcion,$detalles );

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
            <h3>Curso</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Curso</li>
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
                <label class="form-label">Nombre*</label>
                <input name="nombrecarrera" class="form-control" id="nombrecarrera" required autofocus />
              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Cantidad de cuotas*</label>
                <input name="cantidadcuotas" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="^\d*\.?\d*$" class="form-control" id="cantidadcuotas" required  />
              </div>              

              <div class="col-md-8 mb-3">
                <label class="form-label">Costo Total Curso*</label>
                <input name="costocurso" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="^\d*\.?\d*$" class="form-control" id="costocurso" required  />
              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Costo Inscripcion*</label>
                <input name="costoinscripcion" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="^\d*\.?\d*$" class="form-control" id="costoinscripcion" required  />
              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Detalles*</label>
                <input name="detalles" class="form-control" id="detalles" required  />
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