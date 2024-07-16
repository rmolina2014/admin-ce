<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("ingreso.php");
include("../caja/caja.php");
$objeto = new Ingreso();
$caja = new Caja();

if (isset($_POST['monto']) && !empty($_POST['monto'])) {

  $monto = $_POST['monto'];
  $fecha_ingreso = date("Y-m-d H:i:s");
  $caja_id = $_POST['caja_id'];
  $usuario_id = $_POST['usuario_id'];
  $ingreso_tipo = $_POST['ingreso_tipo_id'];
  $observacion = $_POST['observacion'];
  $alumno_id = $_POST['id_alumno'];
  $tipopago = $_POST['tipo_pago'];
  $carrera_id = $_POST['carrera_id'];

  $todobien = $objeto->insertarIngresoOtrosIngresos(
    $monto,
    $fecha_ingreso,
    $caja_id,
    $usuario_id,
    $ingreso_tipo,
    $alumno_id,
    $tipopago,$observacion,$carrera_id

  );
  if ($todobien) {
    //grabo el movimiento en la caja correspondiente
    $todobien = $caja->actualizaringresocaja($caja_id, $monto );


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
            <h3>Otros Ingresos</h3>
            <!--p class="text-subtitle text-muted">The default layout.</p-->
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><?php echo "Usuario : " . $USUARIO; ?></li>
            </ol>             
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Otros Ingresos</li>
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
                <label class="form-label">Tipo Ingreso</label>
                <select class="form-control" name="ingreso_tipo_id" id="ingreso_tipo_id" required autofocus tabindex="1">
                  <option value="">Seleccione....</option>
                  <?php

                  $items = $objeto->listaIngresoTipo();

                  foreach ($items as $item) {
                  ?>
                    <option value="<?php echo $item['id']; ?>"> <?php echo $item['nombre']; ?> </option>
                  <?php
                  }
                  ?>
                </select>
                
              </div>

                        <div class="col-md-8 mb-3">
                            <input name="id_alumno" id="id_alumno"  type="hidden"  />
                            <label id="labeldni">D.N.I </label>
                            <input name="dnialumno" id="dnialumno" class="form-control" type="text"                     maxlength="10" required />
                            <br>
                            
                        </div>

                        <div class="col-md-8 mb-3">
                            <div id="resultadoBusqueda"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                          <button  class="btn btn-sm btn-secondary d-inline-flex align-items-center" type="button" id="loadResultsButton" onclick="loadResultsByDNI()">Buscar Cursos</button>
                          
                          <select  class="form-control" id="searchResults" name="carrera_id" required></select>
                        </div>

              <div class="col-md-8 mb-3">
                <label class="form-label">Monto</label>
                <input name="monto" id="monto" class="form-control" type="text" oninput="return soloNumeros(event);" required  />
              </div>


              <div class="col-md-8 mb-3">
                <label>Forma de Pago :</label>
                    <select class="form-control" name="tipo_pago" id="tipo_pago" required>
                         <option value="">Seleccionar...</option>
                         <option value="EFECTIVO">Efectivo</option>
                         <option value="VIRTUAL MP">Virtual MP</option>
                         <option value="VIRTUAL BBVA">Virtual BBVA</option>                          
                    </select>
              </div>



              <div class="col-md-8 mb-3">
                <label class="form-label">Observacion</label>
                <input name="observacion" id="observacion" class="form-control"  />
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

        <script src="../assets/js/jquery-3.6.3.min.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                   
                   $("#ingreso_tipo_id").on("click", function() {
                   const opcionSeleccionada = $(this).find("option:selected");
                   
                  if (opcionSeleccionada.val() == "1") { // Asumiendo que 1 es el valor para "Aporte externo de socios"
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

                   //console.log("Valor de la opción seleccionada:", opcionSeleccionada.val());
                   //console.log("Texto de la opción seleccionada:", opcionSeleccionada.text());
                   });

            // buscar por dni 09/08/2018
            $("#dnialumno").blur(function() {
                var vdni = $("#dnialumno").val();
                $.ajax({
                    url: "../alumno/buscar_dni_en_alumno.php",
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
                                "<h6 class='text-muted mb-0'> Alumno : " + jsonData
                                .nombre + ". </h6>");
                            $("#id_alumno").val(jsonData.id_alumno);
                            document.getElementById("guardar").disabled = false;
                        } else {
                            $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'>" +
                                jsonData.mensaje + "</h6>");
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
        }) //fin jquery  

         //para llenar el select
function loadResultsByDNI() {
  var dni = $("#dnialumno").val();
  var tipoIngreso = $("#ingreso_tipo_id").val();

  if (dni.trim() !== "") {
    $.ajax({
      url: "buscarcarreraspordni.php",
      type: "POST",
      data: {
        dni: dni
      },
      dataType: "json",
      success: function(response) {
        var select = $('#searchResults');
        select.empty();
        select.append('<option value="">Seleccione una opción</option>');
        
        if (Array.isArray(response) && response.length > 0) {
          $.each(response, function(index, item) {
            select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
          });
          if (tipoIngreso != "1") { // No deshabilitar si es Aporte externo de socios
            $("#guardar").prop('disabled', false);
          }
        } else {
          select.append('<option value="">No se encontraron cursos para el dni dado</option>');
        }
      },
      error: function(xhr, status, error) {
        console.error("Error loading search results:", error);
        if (tipoIngreso != "1") { // No deshabilitar si es Aporte externo de socios
          $("#guardar").prop('disabled', true);
        }
        $('#searchResults').html('<option value="">Error al cargar las carreras</option>');
      }
    });
  } else {
    $('#searchResults').html('<option value="">Ingrese un DNI válido</option>');
    if (tipoIngreso != "1") { // No deshabilitar si es Aporte externo de socios
      $("#guardar").prop('disabled', true);
    }
  }
}
        //fin----



        </script>          