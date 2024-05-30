<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['id_persona']) && !empty($_POST['id_persona'])) {
  $persona_id = $_POST['id_persona'];
  $edad = $_POST['edad'];
  $gruposanguineo = $_POST['gruposanguineo'];
  $carrera_id = $_POST['carrera_id'];
  $estado = "Activo";
  $fecha_ingreso = date("Y-m-d");
  $observacion = $_POST['observacion'];

  $insertar_alunmo = $objeto->nuevo(
    $edad,
    $gruposanguineo,
    $persona_id,
    $carrera_id,
    $estado,
    $observacion,
    $fecha_ingreso
  );

  // 1 -insertra alumno 

  if (!is_int($insertar_alunmo)) {
?>
<div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
    <button data-dismiss="alert" class="close" type="button">×</button>
    Error al insertar Alumno ...
</div>
<?php
  }

  //2 -insertra cuota inscripcion

  $alumno_id = $insertar_alunmo;

  $datos_carrera = $objeto->cuotasCostoCarrera($carrera_id);
  foreach ($datos_carrera as $item) {
    $cantidad_cuotas = $item['cantidad_cuotas'];
    $costo_carrera = $item['costo_carrera'];
    $costo_inscripcion = $item['inscripcion'];
  }

  $estado = 'IMPAGA'; //estado de las cuotas IMPAGA, pagada,vencida

  $objeto = new Alumno();
  $cuota_numero = 0;
  $fecha_vencimiento = "0001-01-01";
  //$fecha_pago = "0001-01-01";
  $detalle = "Inscripción";

  $insertar_inscripcion = $objeto->insertar_cuotas_alumno($alumno_id, $carrera_id, $cuota_numero, $costo_inscripcion, $estado, $fecha_vencimiento, $detalle);

  if (!$insertar_inscripcion) {
  ?>
<div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
    <button data-dismiss="alert" class="close" type="button">×</button>
    Lo sentimos, no se pudo generar la cuota Inscripcion
</div>
<?php
  }


  /*
// generar las cuotas en base a el total de cuotas de la carrera y el costo */

  $monto_cuota = round($costo_carrera / $cantidad_cuotas); // valor de la cuota

  $i = 0;
  while ($cantidad_cuotas > $i) {

    $cuota_numero = $i + 1;

    $detalle = "Cuota Nº ".$cuota_numero;

    $insertar_cuota_mensual =
    $objeto->insertar_cuotas_alumno($alumno_id, $carrera_id, $cuota_numero, $monto_cuota, $estado, $fecha_vencimiento, $fecha_pago, $detalle);
    //$vencimiento=$nuevafecha;

    if ($insertar_cuota_mensual) {
      $i++;
    } else {
    ?>
<div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
    <button data-dismiss="alert" class="close" type="button">×</button>
    Lo sentimos, no se pudo generar la cuota ...<?php echo $i; ?>
</div>
<?php
    }
  } //fin del while interno

  echo "<script language=Javascript> location.href=\"index.php\"; </script>";
  exit;
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
                            <input name="dnialumno" id="dnialumno" class="form-control" type="text" tabindex="1"
                                maxlength="10" required />
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
                            <input name="gruposanguineo" class="form-control" type="text" tabindex="2" required />
                        </div>

                        <div class="col-md-8 mb-3">
                            <label class="form-label">Carrera o Curso</label>
                            <select class="form-control" name="carrera_id" required autofocus tabindex="1">
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
                            <label class="form-label">Observacion</label>
                            <input name="observacion" class="form-control" type="text" s />
                        </div>

                        <div class="col-md-8 mb-3">

                            <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center"
                                data-dismiss="modal" onclick="location.href='index.php';"> Cancelar

                            </button>

                            <button id="guardar" type="submit"
                                class="btn btn-sm btn-secondary d-inline-flex align-items-center">
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
        <script src="../assets/js/jquery-3.6.3.min.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {


            // buscar por dni 09/08/2018
            $("#dnialumno").blur(function() {
                var vdni = $("#dnialumno").val();
                $.ajax({
                    url: "../personas/buscar_dni.php",
                    type: "POST",
                    data: {
                        dni: vdni
                    },
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        console.log(jsonData);
                        //alert(jsonData.estado);
                        if (jsonData.estado == "ok") {
                            $("#resultadoBusqueda").html(
                                "<h6 class='text-muted mb-0'> Persona : " + jsonData
                                .nombre + ". </h6>");
                            $("#id_persona").val(jsonData.id_persona);
                            document.getElementById("guardar").disabled = false;
                        } else {
                            $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'>" +
                                jsonData.mensaje + "</h6>");
                            document.getElementById("guardar").disabled = true;
                        }

                    },
                    failure: function(data) {
                        alert(response);
                    },
                    error: function(data) {
                        alert(response);
                    }
                });
            });
        }) //fin jquery      
        </script>