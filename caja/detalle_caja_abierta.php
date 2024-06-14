<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("caja.php");

if (isset($_POST['caja_id']) && !empty($_POST['caja_id'])) {
    $objeto = new Caja();
    $caja_id = $_POST['caja_id'];
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
                        <h3>Detalle Cajas Abierta</h3>
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
                <div class="row" id="basic-table">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ingresos</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table table-lg">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Alumno</th>
                                                    <th>Fecha </th>
                                                    <th>Monto $</th>
                                                    <th>Descuento</th>
                                                    <th>Recargo</th>
                                                    <th>Tipo</th>
                                                    <th>Detalle</th>
                                                    <th>Forma</th>
                                                    <th></th>
                                                </tr>
                                                <thead>
                                                <tbody>
                                                    <?php
                                                    $sub_total_virtual = 0;
                                                    $sub_total_efectivo = 0;
                                                    $ingresos = $objeto->listadoIngresos($caja_id);
                                                    foreach ($ingresos as $item) {
                                                        if ($item['tipo_pago'] == "VIRTUAL") {
                                                            $sub_total_virtual = $sub_total_virtual + $item['monto'];
                                                        } else {
                                                            $sub_total_efectivo = $sub_total_efectivo + $item['monto'];
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $item['apellidonombre']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['fecha_ingreso']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['monto']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['descuento']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['recargo']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['tipo_de_ingreso']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['detalle']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $item['tipo_pago']; ?>
                                                            </td>

                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                        </table>
                                        <!--- fin contenido------------------------------------------------------- -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Egresos</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                </div>
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>N°</th>
                                                <th>Fecha </th>
                                                <th>Monto $</th>
                                                <th>Detalle</th>
                                            </tr>
                                            <thead>
                                            <tbody>
                                                <?php
                                                $total_egreso = 0;
                                                $ingresos = $objeto->listadoEgresos($caja_id);
                                                foreach ($ingresos as $item) {
                                                    $total_egreso = $total_egreso + $item['monto'];
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $item['id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['fecha_egreso']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['monto']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['egreso_tipo']; ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                    </table>
                                    <!--- fin contenido------------------------------------------------------- -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--- saldos------------------------------------------------------- -->
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Virtual</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_virtual, 2, ',', '.'); ?></font>
                                            </font>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">

                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Efectivo</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_efectivo, 2, ',', '.'); ?></font>
                                            </font>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">

                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Total Ingreso</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <?php
                                                    $total_ingreso = $sub_total_efectivo + $sub_total_virtual;
                                                    echo number_format($total_ingreso, 2, ',', '.');
                                                    ?></font>
                                            </font>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">

                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Total Egresos</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($total_egreso, 2, ',', '.'); ?></font>
                                            </font>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">

                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Saldo de Caja</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <?php
                                                    $saldo = $total_ingreso - $total_egreso;
                                                    echo number_format($saldo, 2, ',', '.');
                                                    ?>
                                                </font>
                                            </font>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a id="pagar23" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-target="#border-less23" data-monto="20000.00" data-detalle="Cuota Nº 7">
                        Cerrar Caja
                    </a>
                </div>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Depositos</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="card">

                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form form-vertical" method="POST" action="cerrarcaja.php">
                                                <input type="hidden" name="caja_id" value="<?php echo $caja_id; ?>">
                                                <input type="hidden" name="saldo" value="<?php echo $saldo; ?>">
                                                <input type="hidden" name="ingreso_total" value="<?php echo $total_ingreso; ?>">
                                                <input type="hidden" name="egreso_total" value="<?php echo $total_egreso; ?>">
                                                <input type="hidden" name="saldo_efectivo" value="<?php echo $sub_total_efectivo; ?>">
                                                <input type="hidden" name="saldo_virtual" value="<?php echo $sub_total_virtual; ?>">
                                                <input type="hidden" id="monto_total_deposito" name="monto_total_deposito" value="<?php echo $saldo; ?>">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group " style="font-size: 18px;">
                                                                <label for="first-name-vertical">Efectivo $ <?php echo number_format($sub_total_efectivo, 2, ',', '.'); ?></label>
                                                                <br>
                                                                <label for="">Virtual $ <?php echo number_format($sub_total_virtual, 2, ',', '.'); ?> </label>
                                                                <br>
                                                                <label  for="">Total Ingresos $ <?php echo number_format($total_ingreso, 2, ',', '.'); ?> </label>
                                                                <br>
                                                                <label  for="">Total Egresos $ <?php echo number_format($total_egreso, 2, ',', '.'); ?> </label>
                                                                <br>                                               
                                                                <label style="font-size: 25px;"  for="">SALDO $ <?php echo number_format($saldo, 2, ',', '.'); ?> </label>                                                                      
                                                                <label style="display: none;"  id="ingreso_arendir"><?php echo $saldo; ?> </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="email-id-vertical">Caja Fuerte</label>
                                                                <input type="text" id="dep_caja_fuerte" name="dep_caja_fuerte" class="form-control sumando moneda" placeholder="Nota: Usar el . como decimal" oninput="validarSumaCierreCaja()">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="contact-info-vertical">Banco</label>
                                                                <input type="text" class="form-control sumando moneda" id="dep_banco" name="dep_banco" placeholder="Nota: Usar el . como decimal" oninput="validarSumaCierreCaja()">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="password-vertical">Mercado Pago</label>
                                                                <input type="text" class="form-control sumando moneda" id="dep_mp" name="dep_mp" placeholder="Nota: Usar el . como decimal" oninput="validarSumaCierreCaja()">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="password-vertical">Saldo Inicial Proxima Caja</label>
                                                                <input type="text" class="form-control sumando" id="dep_proxima_caja" name="dep_proxima_caja" placeholder="Nota: Usar el . como decimal" oninput="validarSumaCierreCaja()">
                                                            </div>
                                                        </div>
                                                        <div id="mensaje"></div>
                                                        <button type="submit" id="botonEnviar" class="btn btn-primary me-1 mb-1" disabled>CERRAR CAJA </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
            </section>
        <?php
    }
    include("../pie.php");
        ?>
        <script src="../assets/js/jquery-3.6.3.min.js"></script>

