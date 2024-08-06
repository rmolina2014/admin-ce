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
        $detalle = $item['cuota_detalle'];
        $dni = $item['dni'];
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $carrera_id = $item['carrera_id'];
        $cuota_numero = $item['cuota_numero'];
        $alumno_id = $item['alumno_id'];
        $cuota_original = $item['cuota_monto'];
    }
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
            display: none;
        }
        #chkformadepago{
            display: none;
        }
    </style>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4 class="font-bold">Alumno : <?php echo $apellidonombre; ?> DNI : <?php echo $dni; ?></h4>
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
                    <h5 class="text-muted mb-0">Curso : <?php echo $carrera; ?></h5>
                    <br>

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
                        <input type="hidden" id="cuota_original" name="cuota_original" value="<?php echo $cuota_original; ?>">

                        <input type="hidden" name="apagar" id="apagar" value="<?php echo $monto; ?>">

                        <div class="form-group">
                            <label>Detalle :</label>
                            <label><?php echo $detalle; ?></label>
                        </div>

                        <div class="form-group">
                            <input 
                              onblur="validarNumero(<?php echo $monto; ?>)" 
                              oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                              class="form-control" 
                              type="text" 
                              name="monto" 
                              id="monto" 
                              value="<?php echo $monto; ?>" 
                              pattern="^\d*\.?\d*$"
                              required >
                            <div id="mensajeError"></div>
                        </div>

                        <a onclick="habilitaformadepago()" id="formasdepago" class="btn btn-outline-primary">Forma de pago</a>

                        <hr>
                        <div id="chkformadepago">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipopago" id="efectivo" value="EFECTIVO" onchange="formaPago(this)" required>
                                <label class="form-check-label" for="efectivo">
                                    Pago Efectivo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipopago" id="virtual" value="VIRTUAL" onchange="formaPago(this)" required>
                                <label class="form-check-label" for="virtual">
                                    Pago Virtual
                                </label>
                            </div>
                            <div id="opcionesPagoVirtual" style="display: none; margin-left: 20px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoPagoVirtual" id="mercadoPago" value="mp" onchange="actualizarTipoPagoVirtual(this)">
                                    <label class="form-check-label" for="mercadoPago">
                                        Mercado pago
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoPagoVirtual" id="bbva" value="bbva" onchange="actualizarTipoPagoVirtual(this)">
                                    <label class="form-check-label" for="bbva">
                                        BBVA
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-check" id="chkdescuento10">
                            <div class="checkbox">
                                <input type="checkbox" id="descuento10" name="descuento10" value="APLICAR" class="form-check-input" onchange="descuentoPorDiaDiez(this)">
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
                </div>
            </div>
        </section>

        <?php
        include("../pie.php");
        ?>

        <script src="../assets/js/jquery-3.6.3.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            });

            function validarNumero(maximoPermitido) {
                var numero = document.getElementById("monto").value;
                numero = parseFloat(numero);
                var enlace = document.getElementById("formasdepago");
                if (numero > maximoPermitido) {
                    document.getElementById("mensajeError").innerText = "El número no debe superar " + maximoPermitido;
                    enlace.removeAttribute("onclick");                    
                } else {
                    enlace.setAttribute("onclick", "habilitaformadepago()");
                    document.getElementById("mensajeError").innerText = "";
                }
            }

            function habilitaformadepago() {
                 document.getElementById('monto').disabled = true;
                 document.getElementById('chkformadepago').style.display = 'block';
            }            
             
            function formaPago(sel) {
                document.getElementById('botonpago').disabled = false;
                var monto = $("#monto").val();
                var cuota_original = $("#cuota_original").val();
                var opcionesPagoVirtual = document.getElementById('opcionesPagoVirtual');
                var total_apagar = monto;

                if (sel.value === 'EFECTIVO') {
                    //para verificar que este pagando el total y asi hacer el decuento por pago efectivo
                    if (cuota_original == monto){
                        let porcentaje = Math.round(calcularPorcentaje(monto, 10));
                        total_apagar = monto - porcentaje;
                        $("#descuentoFormaPago").val(porcentaje);
                        $("#descuento_todos").html("<h6 class='font-extrabold mb-0'>Descuento Pago Efectivo : - $ " + porcentaje + "</h6>");
                        $("#tipo_pago").val("EFECTIVO");
                        opcionesPagoVirtual.style.display = 'none';
                        $("#mercadoPago, #bbva").prop("required", false);
                        }else{
                                let porcentaje = 0;
                                total_apagar = monto - porcentaje;
                                $("#descuentoFormaPago").val(porcentaje);
                                $("#descuento_todos").html("<h6 class='font-extrabold mb-0'>Descuento Pago Efectivo : - $ " + porcentaje + "</h6>");
                                $("#tipo_pago").val("EFECTIVO");
                                opcionesPagoVirtual.style.display = 'none';
                                $("#mercadoPago, #bbva").prop("required", false);                            

                            }
                    
                } else {
                    $("#descuentoFormaPago").val(0);
                    $("#descuento_todos").empty();
                    $("#tipo_pago").val("VIRTUAL");
                    opcionesPagoVirtual.style.display = 'block';
                    $("#mercadoPago, #bbva").prop("required", true);
                }

                actualizarTotalAPagar(total_apagar);
                document.getElementById('chkdescuento10').style.display = 'block';
            }

            function actualizarTipoPagoVirtual(sel) {
                if (sel.value === 'mp') {
                    $("#tipo_pago").val("VIRTUAL MP");
                } else if (sel.value === 'bbva') {
                    $("#tipo_pago").val("VIRTUAL BBVA");
                }
                actualizarTotalAPagar($("#apagar").val());
            }

            function actualizarTotalAPagar(total) {
                var formaPago = $("#tipo_pago").val();
                $("#total_apagar").html("<h5 class='font-extrabold mb-0'>A pagar : $ " + total + " Forma de pago: " + formaPago + "</h5>");
                $("#apagar").val(total);
            }

            function descuentoPorDiaDiez(sel) {
               var monto = $("#monto").val();
               //var total_apagar = monto;
               var total_apagar = $("#apagar").val();
               var cuota_original = $("#cuota_original").val();

                if ($("#descuento10").is(":checked")) {
                    //para verificar que este pagando el total y asi hacer el decuento por pago antes del 10
                    if (cuota_original == monto)
                        {
                        let porcentaje2 = Math.round(calcularPorcentaje(total_apagar, 10));
                        $("#descuentoPagoaAntesDiaDiez").val(porcentaje2);
                        $("#descuento_todos").append("<h6 class='font-extrabold mb-0'>Descuento Pago antes del 10. : - $ " + porcentaje2 + "</h6>");
                        total_apagar = total_apagar - porcentaje2;
                        }else{
                            total_apagar = $("#monto").val();
                            //$("#descuento_todos").empty();
                            $("#descuento_todos").append("<h6 class='font-extrabold mb-0'>Descuento Pago antes del 10. : - $ " + 0.00 + "</h6>");
                            $("#descuentoPagoaAntesDiaDiez").val(0);
                            document.getElementById('chkdescuento10').style.display = 'none';
                             }
                

                } else {
                    total_apagar = $("#monto").val();
                    $("#descuento_todos").empty();
                    //$("#descuento_todos").append("<h6 class='font-extrabold mb-0'>Descuento Pago antes del 10. : - $ " + 0 + "</h6>");
                    $("#descuentoPagoaAntesDiaDiez").val(0);
                    document.getElementById('chkdescuento10').style.display = 'none';
                }

                actualizarTotalAPagar(total_apagar);
            }

            function calcularPorcentaje(monto, porcentaje) {
                return (monto * porcentaje) / 100;
            }
        </script>
</div>