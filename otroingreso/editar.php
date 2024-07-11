<?php
include("../sesion.php"); 
include("../cabecera.php");
include("../menu.php");
include("ingreso.php");
include("../caja/caja.php");
$objeto = new Ingreso();
$caja = new Caja();

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int)$_POST['id'];
    $registros = $objeto->obtenerIdconalumno($id);
    foreach ($registros as $item) {
        $ingreso_id = $item['id'];
        $caja_id = $item['caja_id'];
        $monto_original = $item['monto'];
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
                    <h3>Ingreso</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Ingreso</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Formulario Editar Ingreso</h4>
                </div>
                <div class="card-body">
                    <form method="POST" role="form" action="editar.php">
                        <input type="hidden" name="ingreso_id" value="<?php echo $ingreso_id; ?>" />
                        <input type="hidden" name="caja_id" value="<?php echo $caja_id; ?>" />
                        <input type="hidden" name="monto_original" value="<?php echo $monto_original; ?>" />               
                        
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Tipo Ingreso</label>
                            <select class="form-control" name="ingreso_tipo_id" id="ingreso_tipo_id" required autofocus tabindex="1">
                                <option value="">Seleccione....</option>
                                <?php
                                $ingresostipos = $objeto->listaIngresoTipo();
                                foreach ($ingresostipos as $ingresotipo) {
                                    $selected = ($ingresotipo['id'] == $item['ingreso_tipo_id']) ? 'selected' : '';
                                    echo "<option value='{$ingresotipo['id']}' {$selected}>{$ingresotipo['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-8 mb-3">
                            <input name="id_alumno" id="id_alumno" value="<?php echo $item['alumno_id']; ?>" type="hidden" />
                            <label id="labeldni">D.N.I</label>
                            <input name="dnialumno" id="dnialumno" value="<?php echo $item['dni']; ?>" class="form-control" type="text" maxlength="10" required />
                        </div>

                        <div class="col-md-8 mb-3">
                            <div id="resultadoBusqueda"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <button class="btn btn-sm btn-secondary d-inline-flex align-items-center" type="button" id="loadResultsButton" onclick="loadResultsByDNI()">Buscar Cursos</button>
                            <select class="form-control" id="searchResults" name="carrera_id" required></select>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label class="form-label">Monto</label>
                            <input name="monto" class="form-control" type="text" onkeypress="return soloNumeros(event);" required value="<?php echo $item['monto']; ?>" />
                        </div>

                        <div class="col-md-8 mb-3">
                            <label>Forma de Pago :</label>
                            <select class="form-control" name="tipo_pago" id="tipo_pago" required>
                                <option value="">Seleccionar...</option>
                                <option value="EFECTIVO" <?php echo ($item['tipo_pago'] == 'EFECTIVO') ? 'selected' : ''; ?>>Efectivo</option>
                                <option value="VIRTUAL" <?php echo ($item['tipo_pago'] == 'VIRTUAL') ? 'selected' : ''; ?>>Virtual</option>
                            </select>
                        </div>               

                        <div class="col-md-8 mb-3">
                            <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';">Cancelar</button>
                            <button type="submit" id="guardar" class="btn btn-sm btn-secondary d-inline-flex align-items-center">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
    }
    include("../pie.php");
} else if (isset($_POST['ingreso_id']) && !empty($_POST['ingreso_id'])) {
    $ingreso_id = $_POST['ingreso_id'];
    $tipoingreso = $_POST['ingreso_tipo_id'];
    $monto = $_POST['monto'];
    $id_alumno = $_POST['id_alumno'];
    $tipo_pago = $_POST['tipo_pago'];
    $origen = ($_POST['id_alumno'] == 1) ? "Socios" : "Alumno";
    $caja_id = $_POST['caja_id'];
    $monto_original = $_POST['monto_original'];
    $carrera_id = $_POST['carrera_id'];

    $todobien = $objeto->editar($ingreso_id, $tipoingreso, $monto, $id_alumno, $tipo_pago, $origen, $carrera_id);
    if ($todobien) {
        $monto_actualizado = $monto - $monto_original;
        $todobien = $caja->actualizaringresocaja($caja_id, $monto_actualizado);             
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
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
?>

<script src="../assets/js/jquery-3.6.3.min.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#ingreso_tipo_id").on("change", function() {
        const opcionSeleccionada = $(this).val();
        
        if (opcionSeleccionada == "1") { // Asumiendo que 1 es el valor para "Aporte externo de socios"
            $("#dnialumno").val(999);
            $("#dnialumno").hide();
            $("#labeldni").hide();
            $("#loadResultsButton").hide();
            $("#searchResults").hide().prop('required', false);
            $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'></h6>");
            $("#guardar").prop('disabled', false);
            $("#id_alumno").val(1);
        } else {
            $("#dnialumno").show().val('');
            $("#labeldni").show();
            $("#loadResultsButton").show();
            $("#searchResults").show().prop('required', true);
            $("#guardar").prop('disabled', true);
            $("#id_alumno").val(0);
        }
    });

    $("#dnialumno").blur(function() {
        var vdni = $("#dnialumno").val();
        $.ajax({
            url: "../alumno/buscar_dni_en_alumno.php",
            type: "POST",
            data: { dni: vdni },
            success: function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                if (jsonData.estado == "ok") {
                    $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'> Alumno : " + jsonData.nombre + ". </h6>");
                    $("#id_alumno").val(jsonData.id_alumno);
                    document.getElementById("guardar").disabled = false;
                } else {
                    $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'>" + jsonData.mensaje + "</h6>");
                    $("#id_alumno").val(0);
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
});

function loadResultsByDNI() {
    var dni = $("#dnialumno").val();
    var tipoIngreso = $("#ingreso_tipo_id").val();

    if (dni.trim() !== "") {
        $.ajax({
            url: "buscarcarreraspordni.php",
            type: "POST",
            data: { dni: dni },
            dataType: "json",
            success: function(response) {
                var select = $('#searchResults');
                select.empty();
                select.append('<option value="">Seleccione una opción</option>');
                
                if (Array.isArray(response) && response.length > 0) {
                    $.each(response, function(index, item) {
                        select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                    });
                    if (tipoIngreso != "1") {
                        $("#guardar").prop('disabled', false);
                    }
                } else {
                    select.append('<option value="">No se encontraron cursos para el dni dado</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading search results:", error);
                if (tipoIngreso != "1") {
                    $("#guardar").prop('disabled', true);
                }
                $('#searchResults').html('<option value="">Error al cargar las carreras</option>');
            }
        });
    } else {
        $('#searchResults').html('<option value="">Ingrese un DNI válido</option>');
        if (tipoIngreso != "1") {
            $("#guardar").prop('disabled', true);
        }
    }
}
</script>