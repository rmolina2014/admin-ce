<?php
include ("../cabecera.php");
include ("../menu.php");
include ("ingreso.php");
include("../caja/caja.php");
$objeto = new Ingreso();
$caja = new Caja();
if (isset ($_POST['monto']) && !empty ($_POST['monto'])) {

  $monto = $_POST['monto'];
  $fecha_ingreso = date("Y-m-d H:i:s");
  $caja_id = $_POST['caja_id'];
  $usuario_id = $_POST['usuario_id'];
  $ingreso_tipo_id = $_POST['ingreso_tipo_id'];

  $todobien = $objeto->nuevo(
    $monto,
    $fecha_ingreso,
    $caja_id,
    $usuario_id,
    $ingreso_tipo_id
  );
  if ($todobien) {
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    $todobien = $caja->actualizaringresocaja($caja_id, $monto );
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
            <h3>Ingreso</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ingreso</li>
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
                <label>D.N.I Alumno </label>
                <input name="dnialumno" id="dnialumno" class="form-control" type="text" tabindex="1" maxlength="10"
                  required />
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

              <div class="col-md-8 mb-3">
                <?php
                //buscar caja
                $caja = $objeto->buscarCajaAbierta();
                ?>

                <label class="form-label">Caja :
                  <?php
                  //buscar caja
                  echo $caja;
                  ?>
                </label>
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
                <label class="form-label">Carrera</label>
                <select class="form-control" id="carreras" name="carrera_id" required autofocus tabindex="1">
                  <option value="0">Seleccione....</option>
                  <?php
                  $items = $objeto->listaCarrera();
                  foreach ($items as $item) {
                    ?>
                    <option value="<?php echo $item['id']; ?>">
                      <?php echo $item['nombre']; ?>
                    </option>
                    <?php
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Cuotas</label>
                <select class="form-control" name="cuotas" id="cuotas" required autofocus tabindex="1">
                  <option value="0">Seleccione....</option>

                </select>
              </div>




              <div class="col-md-8 mb-3">
                <label class="form-label">Monto</label>
                <input name="monto" class="form-control" type="monto" onkeypress="return soloNumeros(event);" required
                  autofocus />
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

include ("../pie.php");
?>
          <script src="../assets/js/jquery-3.6.3.min.js"></script>
          <script src="../assets/js/jquery.validate.min.js"></script>
          <script type="text/javascript">
            $(document).ready(function () {

              // buscar por dni 09/08/2018
              $("#dnialumno").blur(function () {
                var vdni = $("#dnialumno").val();
                $.ajax({
                  url: "../personas/buscar_dni.php",
                  type: "POST",
                  data: {
                    dni: vdni
                  },
                  success: function (response) {
                    var jsonData = JSON.parse(response);
                    console.log(jsonData);
                    //alert(jsonData.estado);
                    if (jsonData.estado == "ok") {
                      $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'> Persona : " + jsonData.nombre + ". </h6>");
                      $("#id_persona").val(jsonData.id_persona);
                      document.getElementById("guardar").disabled = false;
                    } else {
                      $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'>" + jsonData.mensaje + "</h6>");
                      document.getElementById("guardar").disabled = true;
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

              //llenar otro combo
              $("#carreras").change(function () {
                var carrera_id = $(this).val();

                $.ajax({
                  url: 'buscar_cuotas.php',
                  type: 'post',
                  data: { carrera_id: carrera_id },
                  dataType: 'json',
                  success: function (response) {

                    var len = response.length;

                    $("#cuotas").empty();

                    for (var i = 0; i < len; i++) {
                      var id = response[i]['id'];
                      var detalle = response[i]['detalle'];
                      var costo = response[i]['costo'];

                      $("#cuotas").append("<option value='" + id + "'>" + detalle +' Costo '+costo+ "</option>");

                    }
                  }
                });
              });

            }) //fin jquery    


          </script>