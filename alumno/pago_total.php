<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
if (isset($_POST['cuota_id']) && !empty($_POST['cuota_id'])) {
    $objeto = new Alumno();
    $cuota_id = (int)$_POST['cuota_id'];
    $datos_cuota = $objeto->obtenerCuotaId($cuota_id);
    foreach ($datos_cuota as $item) {
        //$monto = $item['cuota_monto'];
        $detalle = $item['cuota_detalle'];
        $dni = $item['dni'];
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $carrera_id = $item['carrera_id'];
        $cuota_numero = $item['cuota_numero'];
        $alumno_id = $item['alumno_id'];
    }
    //para obtener el saldo a pagar, si no ha pagado ninguna cuota la funcion devuelve el total 
    $saldo_cuota = $objeto->saldoCuotaAlumno($cuota_id);
    foreach ($saldo_cuota as $itemsaldo) {
        $monto = $itemsaldo['saldo'];

    }

}


?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    <style>
        #chkdescuento10 {
            display: none; /* El div está oculto inicialmente */
        }
        #chkformadepago{
            display: none; /* El div está oculto inicialmente */
        }
    </style>

    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4 class="font-bold">Alumno : <?php echo $apellidonombre; ?> DNI :
                        <?php echo $dni; ?></h4>

                    <!--p class="text-subtitle text-muted">The default layout.</p-->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><?php echo "Usuario : " . $USUARIO; ?></li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Formulario Pago Cuota </h4>
                </div>
                <div class="card-body">
                    <!--- contenido ---------------------------------------------------------->

                    <h5 class="text-muted mb-0">Curso : <?php echo $carrera; ?></h5>
                    <br>

                    <!-- formulario post--->
                    <form id="form" method="post" action="pagar_cuota.php">
                        <input type="hidden" name="cuota_id" value="<?php echo $cuota_id; ?>">
                        <input type="hidden" name="alumno_id" value="<?php echo $alumno_id; ?>">
                        <input type="hidden" name="detalle" value="<?php echo $detalle; ?>">
                        <input type="hidden" name="carrera_id" value="<?php echo $carrera_id; ?>">
                        
                        <input type="hidden" name="tipo_pago" id="tipo_pago">
                        <input type="hidden" name="monto_original" id="monto_original" value="<?php echo $monto; ?>">
                        <input type="hidden" name="recargo" id="recargo" value="0">
                        <input type="hidden" name="descuentoFormaPago" id="descuentoFormaPago">
                        <input type="hidden" name="descuentoPagoaAntesDiaDiez" id="descuentoPagoaAntesDiaDiez" value="0">
                        <input type="hidden" name="apagar" id="apagar" value="<?php echo $monto; ?>">

                        <div class="form-group">
                            <label>Detalle :</label>
                            <label><?php echo $detalle; ?></label>

                        </div>

                        <div class="form-group">

                            
                            <input  onblur="validarNumero(<?php echo $monto; ?>)" class="form-control" type="text" name="monto" id="monto" value="<?php echo $monto; ?>"  require>
                            <div id="mensajeError"></div>

                        </div>

                        
                        <a onclick="habilitaformadepago()" id="formasdepago" class="btn btn-outline-primary">Forma de pago</a>

                        <hr>
                        <div id="chkformadepago">
                        <div class="form-check" >
                            <input class="form-check-input" type="radio" name="tipopago" id="efectivo" value="EFECTIVO" onchange="formaPago(this,<?php echo $cuota_id; ?>);" require>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Pago Efectivo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipopago" id="virtual" value="VIRTUAL" onchange="formaPago(this,<?php echo $cuota_id; ?>);" require>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pago Virtual
                            </label>
                        </div>
                        </div>
                        <hr>
                        <div class="form-check" id="chkdescuento10">
                            <div class="checkbox">
                                <input type="checkbox" id="descuento10" name="descuento10" value="APLICAR" class="form-check-input" onchange="descuentoPorDiaDiez(this,<?php echo $cuota_id; ?>);">
                                <label for="checkbox1">Descuento Pago antes del dia 10</label>
                            </div>
                        </div>
                        <hr>
                        <div id="descuento_todos">
                        </div>
                        <hr>
                        <div id="total_apagar">

                        </div>
                        <hr>

                        <a href="alumno_carrera_cuotas.php?id=<?php echo $alumno_id; ?>" class="btn btn-outline-primary">Cancelar</a>

                        <button type="submit" id="botonpago" disabled class="btn btn-outline-primary">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Pagar</span>
                        </button>
                    </form>

                    <!--- fin contenido------------------------------------------------------- -->
                </div>
            </div>
        </section>

        <?php
        include("../pie.php");
        ?>

        <script src="../assets/js/jquery-3.6.3.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

            }); // fin ready

            //var monto = $("#monto").val();

            //$("#apagar").html("<h5 class='font - extrabold mb - 0 '>A pagar : $ " + monto + "</h5>");

            //var total_apagar = monto;

            function validarNumero(maximoPermitido) {
                // Obtener el valor del input
                var numero = document.getElementById("monto").value;

                // Obtener el valor máximo permitido del input
                //var maximoPermitido = document.getElementById("monto").value;

                // Convertir el valor a número
                numero = parseFloat(numero);
                var enlace = document.getElementById("formasdepago");
                // Validar si el número es mayor que el máximo permitido
                if (numero > maximoPermitido) {
                    // Mostrar un mensaje de error
                    document.getElementById("mensajeError").innerText = "El número no debe superar " + maximoPermitido;
                    // Puedes también deshabilitar el botón o realizar otras acciones según tu necesidad
                    

                    
                        // Deshabilitar el enlace
                        enlace.removeAttribute("onclick");                    
                              
                }else{
                    enlace.setAttribute("onclick", "habilitaformadepago()");
                    document.getElementById("mensajeError").innerText = "";
                }
            }



            function habilitaformadepago() {
                 document.getElementById('monto').disabled = true;
                 document.getElementById('chkformadepago').style.display = 'block';
            }            
             
            function formaPago(sel, id) {
                //alert("descuento por forma de pago" + sel.value);
                document.getElementById('botonpago').disabled = false;
               var monto_original= $("#monto_original").val();
               var monto = $("#monto").val();
               $("#monto").val(monto);

                //$("#apagar").html("<h5 class='font - extrabold mb - 0 '>A pagar : $ " + monto + "</h5>");

                //var total_apagar = monto;


                if ('EFECTIVO' === sel.value) {
                    // alert("efectivo");
                    let porcentaje = Math.round(calcularPorcentaje(monto, 10));
                    total_apagar = monto - porcentaje;
                    $("#descuentoFormaPago").val(porcentaje);
                    $("#descuento_todos").append("<h6 class='font - extrabold mb - 0 '>Descuento Pago Efectivo : - $ " + porcentaje + "</h6>");
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + total_apagar + "</h5>");
                    $("#apagar").val(total_apagar);
                    $("#tipo_pago").val("EFECTIVO");
                } else {
                    //alert("virtual");
                    if ($("#descuento10").is(":checked")) {
                        $("#descuento10").prop("checked", false);
                    }
                    $("#descuentoFormaPago").val(0);
                    total_apagar = monto;
                    $("#descuento_todos").empty();
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + total_apagar + "</h5>");
                    $("#descuentoPagoaAntesDiaDiez").val(0);
                    $("#apagar").val(total_apagar);
                    $("#tipo_pago").val("VIRTUAL");
                }
                $("#apagar").html("<h5 class='font - extrabold mb - 0 '>A pagar : $ " + total_apagar + "</h5>");
                 document.getElementById('chkdescuento10').style.display = 'block';
            }

            function descuentoPorDiaDiez(sel, id) {
                //alert("descuento por forma de pago" + sel.value);
               var monto = $("#apagar").val();
               //$("#monto").val(monto);

                //$("#apagar").html("<h5 class='font - extrabold mb - 0 '>A pagar : $ " + monto + "</h5>");

                var total_apagar = monto;                

                // if ('APLICAR' === sel.value) {
                // alert("aplicar");
                if ($("#descuento10").is(":checked")) {
                    let porcentaje2 = Math.round(calcularPorcentaje(total_apagar, 10));
                    $("#descuentoPagoaAntesDiaDiez").val(porcentaje2);
                    $("#descuento_todos").append("<h6 class='font - extrabold mb - 0 '>Descuento Pago antes del 10. : - $ " + porcentaje2 + "</h6>");
                    total_apagar = total_apagar - porcentaje2;
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + total_apagar + "</h5>");
                    $("#apagar").val(total_apagar);

                } else {

                    $("#virtual").prop("checked", true);
                    total_apagar = $("#monto").val();
                    $("#descuento_todos").empty();
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + total_apagar + "</h5>");
                    $("#descuentoPagoaAntesDiaDiez").val(0);
                    $("#apagar").val(total_apagar);
                    $("#monto").val(total_apagar);
                    document.getElementById('chkdescuento10').style.display = 'none';
                }



            }
        </script>