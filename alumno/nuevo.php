<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();

if (isset($_POST['id_persona']) && !empty($_POST['id_persona'])) {
  $persona_id = $_POST['id_persona'];
  $fecha_nacimiento = $_POST['fecha_nacimiento'];
  $carrera_id = $_POST['carrera_id'];
  $estado = "Activo";
  $fecha_ingreso = date("Y-m-d");
  $observacion = $_POST['observacion'];
  $redes_sociales = $_POST['redes_sociales'];
  $costo_carrera = $_POST['costo_carrera'];
  $costo_inscripcion = $_POST['costo_inscripcion'];
  $cantidad_cuotas = $_POST['cantidad_cuotas'];

  $carrera_alumno = $objeto->buscarAlumnoCarrera($persona_id,$carrera_id); 

  if ($carrera_alumno) {
    echo "<script type='text/javascript'>alert('El alumno ya esta inscripto en ese curso');</script>";
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    exit;
  }

  $insertar_alunmo = $objeto->nuevo(
    $fecha_nacimiento,
    $persona_id,
    $carrera_id,
    $estado,
    $observacion,
    $fecha_ingreso,
    $redes_sociales
  );

  $alumno_id = $insertar_alunmo;

  $estado = 'IMPAGA';

  $objeto = new Alumno();
  $cuota_numero = 0;
  $fechaActual = new DateTime();
  $fechaActual->modify('+1 day');
  $fecha_vencimiento = $fechaActual->format('Y-m-d');
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

  $monto_cuota = round($costo_carrera / $cantidad_cuotas);

  $i = 0;
  while ($cantidad_cuotas > $i) {
    $fechaActual->modify('+1 month');
    $fecha_vencimiento = $fechaActual->format('Y-m-d');
    $cuota_numero = $i + 1;

    $detalle = "Cuota Nro ".$cuota_numero;

    $insertar_cuota_mensual = $objeto->insertar_cuotas_alumno($alumno_id, $carrera_id, $cuota_numero, $monto_cuota, $estado, $fecha_vencimiento, $detalle);

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
  }

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
                      <form>
                          <div class="col-md-8 mb-3">
                              <label>D.N.I </label>
                              <input name="dnialumno" id="dnialumno" class="form-control" type="text" tabindex="1"
                                  maxlength="10" required />
                              <br>
                          </div>

                          <div class="col-md-8 mb-3">
                              <div id="resultadoBusqueda"></div>
                          </div>
                      </form>

                      <hr>

                      <form method="POST" role="form" action="nuevo.php">
                          <input type="hidden" id="id_persona" name="id_persona">

                          <div class="col-md-8 mb-3">
                              <label class="form-label">fecha Nacimiento</label>
                              <input name="fecha_nacimiento" class="form-control" type="date" tabindex="2" required />
                          </div>

                          <div class="col-md-8 mb-3">
                              <label class="form-label">Redes Sociales</label>
                              <input name="redes_sociales" maxlength="150" class="form-control" type="text" tabindex="2" required />
                          </div>                        

                          <div class="col-md-8 mb-3">
                              <label class="form-label">Curso o Diplomatura</label>
                              <select class="form-control" name="carrera_id" id="carrera_id" required autofocus tabindex="1">
                                  <option value="0">Seleccione....</option>
                                  <?php
                                  $items = $objeto->listaCarrera();
                                  foreach ($items as $item) {
                                  ?>
                                  <option value="<?php echo $item['id']; ?>" 
                                          data-costo="<?php echo $item['costo_carrera']; ?>" 
                                          data-inscripcion="<?php echo $item['inscripcion']; ?>"
                                          data-cuotas="<?php echo $item['cantidad_cuotas']; ?>">
                                      <?php echo $item['nombre']; ?>
                                  </option>
                                  <?php
                                  }
                                  ?>
                              </select>
                          </div>

                          <div class="col-md-8 mb-3">
                              <label class="form-label">Costo Carrera</label>
                              <input name="costo_carrera" id="costo_carrera" class="form-control" type="number" step="0.01" required />
                          </div>

                          <div class="col-md-8 mb-3">
                              <label class="form-label">Costo Inscripción</label>
                              <input name="costo_inscripcion" id="costo_inscripcion" class="form-control" type="number" step="0.01" required />
                          </div>

                          <div class="col-md-8 mb-3">
                              <label class="form-label">Cantidad de Cuotas</label>
                              <input name="cantidad_cuotas" id="cantidad_cuotas" class="form-control" type="number" readonly />
                          </div>

                          <div class="col-md-8 mb-3">
                              <label class="form-label">Observacion</label>
                              <input name="observacion" class="form-control" type="text" />
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

    $("#carrera_id").change(function() {
        var selectedOption = $(this).find("option:selected");
        var costoCarrera = selectedOption.data("costo");
        var costoInscripcion = selectedOption.data("inscripcion");
        var cantidadCuotas = selectedOption.data("cuotas");
        
        $("#costo_carrera").val(costoCarrera);
        $("#costo_inscripcion").val(costoInscripcion);
        $("#cantidad_cuotas").val(cantidadCuotas);
    });
});
</script>