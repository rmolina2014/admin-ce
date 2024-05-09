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
                    <h4 class="card-title">Formulario PagoCuota Total</h4>
                </div>
                <div class="card-body">
                    <!--- contenido ---------------------------------------------------------->

                        <h5 class="text-muted mb-0">Curso : <?php echo $carrera; ?></h5>

                    <!-- formulario post--->
                    <form id="form" method="post" action="pagar_cuota.php">
                        <input type="hidden" name="cuota_id" value="<?php echo $cuota_id; ?>">
                        <input type="hidden" name="alumno_id" value="<?php echo $alumno_id; ?>">
                        <div class="form-group">
                            <label>Detalle :</label>
                            <input class="form-control" type="text" value="<?php echo $detalle; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Importe : $</label>
                            <input class="form-control" id="monto" type="number" value="<?php echo $monto; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Forma de Pago :</label>
                            <select class="form-control" onchange="getval(this,<?php echo $cuota_id; ?>);" id="tipo_pago<?php echo $cuota_id; ?>" name="tipo_pago" required>
                                <option value="">Seleccionar...</option>
                                <option value="EFECTIVO">Efectivo</option>
                                <option value="VIRTUAL">Virtual</option>
                            </select>
                        </div>

                        <div id="descuento_efectivo<?php echo $cuota_id; ?>">

                        </div>

                        <div class="form-group">
                            <label>Descuento Pago antes del dia 10 : $</label>
                            <select class="form-control" id="descuento" name="descuento" onchange="getval(this,<?php echo $cuota_id; ?>);" id="tipo_pago<?php echo $item['id']; ?>" name="tipo_pago" required>
                                <option value="">Seleccionar...</option>
                                <option value="Aplicar">Aplicar</option>
                                <option value="NoAplicar">No Aplicar</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Recargo : $</label>
                            <input class="form-control" name="recargo" type="number" />
                        </div>

                        <div class="form-group">
                            <label>A pagar : $</label>
                            <input class="form-control" name="a_pagar" id="apagar" type="number" />
                        </div>

                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cancelar</span>
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

            function getval(sel, id) {
                alert(sel.value);
                $("#descuento_efectivo" + id).html("<span class='red'> -10</span>");

            }
        </script>