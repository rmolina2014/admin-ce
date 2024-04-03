<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['persona_id']) && !empty($_POST['persona_id'])) {
  $persona_id = $_POST['persona_id'];
  $edad = $_POST['edad'];
  $gruposanguineo = $_POST['gruposanguineo'];
  $carrera_id = $_POST['carrera_id'];

 // $fechaingreso = date("Y-m-d");
  //$estado = 'Activo';

  $todobien = $objeto->nuevo($edad,$gruposanguineo,$persona_id,$carrera_id);
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
            <h3>Alumnos</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
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
                <label class="form-label">Edad</label>
                <input name="edad" class="form-control" type="text" tabindex="2" required />
              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Grupo Sanguineo</label>
                <input name="edad" class="form-control" type="text" tabindex="2" required />
              </div>
                        

              <div class="col-md-8 mb-3">
                <label class="form-label">Tipo Ingreso</label>
                <select class="form-control" name="ingreso_tipo_id" required autofocus tabindex="1">
                  <option value="0">Seleccione....</option>
                  <?php

                  $items = $objeto->listaCarrera();

                  foreach ($items as $item) {
                  ?>
                    <option value="<?php echo $item['id']; ?>"> <?php echo $item['nombre']; ?> </option>
                  <?php
                  }
                  ?>
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
}
      include("../pie.php");
      ?>