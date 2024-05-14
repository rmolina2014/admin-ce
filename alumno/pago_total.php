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
                    <h4 class="card-title">Formulario Pago Cuota Total</h4>
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
                        <input type="hidden" name="tipo_pago" id="tipo_pago" >

                        <input type="hidden" name="recargo" id="recargo" value="0">
                        <input type="hidden" name="descuentoFormaPago" id="descuentoFormaPago">
                        <input type="hidden" name="descuentoPagoaAntesDiaDiez" id="descuentoPagoaAntesDiaDiez">
                        <input type="hidden" name="apagar" id="apagar">

                        <div class="form-group">
                            <label>Detalle :</label>
                            <label><?php echo $detalle; ?></label>

                        </div>

                        <div class="form-group">
                            <!--label>Importe : $</label>
                            <label><?php echo $monto; ?></label-->
                            <h6 class="font-extrabold mb-0">Importe : $ <?php echo $monto; ?></h6>

                        </div>

                        <hr>

                        <div class="form-group">
                            <label>Forma de Pago :</label>
                            <select class="form-control" onchange="formaPago(this,<?php echo $cuota_id; ?>);" id="tipo_pago" name="tipo_pago" required>
                                <option value="">Seleccionar...</option>
                                <option value="EFECTIVO">Efectivo</option>
                                <option value="VIRTUAL">Virtual</option>
                            </select>
                        </div>

                        <div id="descuento_efectivo">

                        </div>

                        <div class="form-group">
                            <label>Descuento Pago antes del dia 10 :</label>
                            <select class="form-control" id="descuento" name="descuento" onchange="descuentoPorDiaDiez(this,<?php echo $cuota_id; ?>);" id="tipo_pago<?php echo $item['id']; ?>" name="tipo_pago" required>
                                <option value="">Seleccionar...</option>
                                <option value="Aplicar">Aplicar</option>
                                <option value="NoAplicar">No Aplicar</option>
                            </select>
                        </div>

                        <div id="descuento_pago_antes_diez">

                        </div>

                        <!--div class="form-group">
                            <label>Recargo : $</label>
                            <input class="form-control" name="recargo" id="recargo" type="number" value="0" />
                        </div-->

                        <hr>

                        <div id="descuento_todos">

                        </div>

                        <hr>
                        <div id="total_apagar">

                        </div>

                        <hr>



                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>Cancelar
                        </button>

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

            let apagar = monto;

            function formaPago(sel, id) {
                // alert("descuento por forma de pago" + sel.value);

                if ('EFECTIVO' === sel.value) {
                    alert("efectivo");

                    let porcentaje = calcularPorcentaje(monto, 10);

                    apagar = monto - porcentaje;

                    $("#descuentoFormaPago").val(porcentaje);

                    $("#descuento_todos").append("<h6 class='font - extrabold mb - 0 '>Descuento Pago Efectivo : $ " + porcentaje + "</h6>");

                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + apagar + "</h5>");

                } else {
                    alert("virtual");
                    $("#descuentoFormaPago").val(0);
                    apagar = monto;
                    $("#descuento_todos").empty();
                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + apagar + "</h5>");
                    $("#descuentoPagoaAntesDiaDiez").val(0);

                }
            }

            function descuentoPorDiaDiez(sel, id) {
                // alert("descuento por forma de pago" + sel.value);

                if ('Aplicar' === sel.value) {
                    alert("aplicar");

                    let porcentaje2 = calcularPorcentaje(apagar, 10);

                    $("#descuentoPagoaAntesDiaDiez").val(porcentaje2);

                    $("#descuento_todos").append("<h6 class='font - extrabold mb - 0 '>Descuento Pago antes del 10. : $ " + porcentaje2 + "</h6>");

                    apagar = apagar - porcentaje2;

                    $("#total_apagar").html("<h5 class='font - extrabold mb - 0'>A pagar : $ " + apagar + "</h5>");

                }

            }
        </script>