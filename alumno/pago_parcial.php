<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
if (isset($_POST['cuota_id']) && !empty($_POST['cuota_id'])) {
    $objeto = new Alumno();
    $cuota_id = (int)$_POST['cuota_id'];
    $datos_cuota = $objeto->obtenerCuotaId($cuota_id);
    foreach ($datos_cuota as $item) {
        $monto = $item['cuota_monto'];
        $detalle = $item['cuota_detalle'];
        $dni = $item['dni'];
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $cuota_numero = $item['cuota_numero'];
        $alumno_id = $item['alumno_id'];
    }
}

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
                    <h4 class="card-title">Formulario Pago Cuota Parcial</h4>
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
                        <input type="hidden" name="monto" id="monto" value="<?php echo $monto; ?>">
                        <input type="hidden" name="tipo_pago" id="tipo_pago">

                        <input type="hidden" name="recargo" id="recargo" value="0">
                        <input type="hidden" name="descuentoFormaPago" id="descuentoFormaPago">
                        <input type="hidden" name="descuentoPagoaAntesDiaDiez" id="descuentoPagoaAntesDiaDiez" value="0">
                        <input type="hidden" name="apagar" id="apagar">

                        <div class="form-group">
                            <label>Detalle :</label>
                            <label><?php echo $detalle; ?></label>

                        </div>

                        <div class="form-group">

                            <label><?php echo $monto; ?></label-->
                                <h6 class="font-extrabold mb-0">Importe : $ <?php echo $monto; ?></h6>

                        </div>

                        <hr>
                        <div class="form-check">
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
                        <hr>
                        <div class="form-check">
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

                        <button type="submit" class="btn btn-outline-primary">
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

            let monto = $("#monto").val();
            $("#apagar").html("<h5 class='font - extrabold mb - 0 '>A pagar : $ " + monto + "</h5>");

            let total_apagar = monto;

            function formaPago(sel, id) {
                //alert("descuento por forma de pago" + sel.value);

                if ('EFECTIVO' === sel.value) {
                    // alert("efectivo");
                    let porcentaje = calcularPorcentaje(monto, 10);
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
            }

            function descuentoPorDiaDiez(sel, id) {
                //alert("descuento por forma de pago" + sel.value);

                // if ('APLICAR' === sel.value) {
                // alert("aplicar");
                if ($("#descuento10").is(":checked")) {
                    let porcentaje2 = calcularPorcentaje(total_apagar, 10);
                    $("#descuentoPagoaAntesDiaDiez").val(porcentaje2);
                    $("#descuento_todos").append("<h6 class='font - extrabold mb - 0 '>Descuento Pago antes del 10. : - $ " + porcentaje2 + "</h6>");
                    total_apagar = total_apagar - porcentaje2;
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + total_apagar + "</h5>");
                    $("#apagar").val(total_apagar);

                } else {

                    $("#virtual").prop("checked", true);
                    total_apagar = monto;
                    $("#descuento_todos").empty();
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + total_apagar + "</h5>");
                    $("#descuentoPagoaAntesDiaDiez").val(0);
                    $("#apagar").val(total_apagar);
                }



            }
        </script>