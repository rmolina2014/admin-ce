<?php
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
                    <div class="col-12 col-md-6">
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
                                                    <th>N°</th>
                                                    <th>Fecha </th>
                                                    <th>Monto $</th>
                                                    <th>Descuento</th>
                                                    <th>Recargo</th>
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
                                                                <?php echo $item['id']; ?>
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
                    <div class="col-12 col-md-6">
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
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_efectivo, 2, ',', '.');
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
                                                <font style="vertical-align: inherit;">Efectivo</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_efectivo, 2, ',', '.');
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
                                                <font style="vertical-align: inherit;"><?php echo number_format($total_egreso, 2, ',', '.');
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
                    <a id="pagar23" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#border-less23" data-monto="20000.00" data-detalle="Cuota Nº 7">
                        Cerrar Caja
                    </a>
                </div>
            </section>
        <?php
    }
    include("../pie.php");
        ?>