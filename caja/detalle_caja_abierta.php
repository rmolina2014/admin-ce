<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("caja.php");

if (isset($_POST['caja_id']) && !empty($_POST['caja_id'])) {
    $objeto = new Caja();
    $caja_id = $_POST['caja_id'];
    $estado_caja = $_POST['estado_caja'];

    // Definir si los atributos de Bootstrap deben estar presentes
    $toggleAttribute = ($estado_caja === "Abierta") ?  ' class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModal"' : 'class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#"';
    
    $toggleAttributeReporte = ($estado_caja === "Abierta") ?  'class="btn btn-outline-secondary" disabled' : 'class="btn btn-outline-primary"';



    //$linkClass = ($estado_caja === "Cerrado") ? 'btn btn-outline-primary' : 'btn btn-outline-primary disabled-link';


?>
    <div id="main">
        <header class="mb-3">

            <style>
                .disabled-link {
                    pointer-events: none; /* Desactiva los eventos de mouse */
                    color: grey; /* Cambia el color para que parezca deshabilitado */
                    text-decoration: none; /* Opcional: Quita el subrayado */
                    cursor: default; /* Cambia el cursor para que parezca deshabilitado */
                }
            </style>


            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Detalle Caja</h3>
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
                                                    <th>Fecha</th>
                                                    <th>M.Pago</th>
                                                    <th>BBVA</th>
                                                    <th>EFECTIVO</th>
                                                    <th>Descuento</th>
                                                    <th>Recargo</th>
                                                    <th>Tipo</th>
                                                    <th>Detalle</th>
                                                    <th>Curso</th>
                                                    <th>Comp.</th>
                                                   
                                                    <th></th>
                                                </tr>
                                                <thead>
                                                <tbody>
                                                    <?php
                                                    $sub_total_virtual_mp = 0;
                                                    $sub_total_virtual_bbva = 0;
                                                    $sub_total_efectivo = 0;
                                                    $ingresos = $objeto->listadoIngresos($caja_id);
                                                    foreach ($ingresos as $item) {
                                                        if ($item['tipo_pago'] == "VIRTUAL MP") {
                                                            $sub_total_virtual_mp = $sub_total_virtual_mp + $item['monto'];
                                                        }
                                                        if ($item['tipo_pago'] == "VIRTUAL BBVA") {
                                                            $sub_total_virtual_bbva = $sub_total_virtual_bbva + $item['monto'];
                                                        }                                                         

                                                        if ($item['tipo_pago'] == "EFECTIVO")  {
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
                                                                <?php 
                                                                    if ($item['tipo_pago'] == "VIRTUAL MP") {
                                                                        echo $item['monto'];
                                                                    }else{ echo 0; }
                                                                 ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    if ($item['tipo_pago'] == "VIRTUAL BBVA") {
                                                                        echo $item['monto'];
                                                                    }else{ echo 0; }
                                                                 ?>
                                                            </td>
                                                                                                                                                                                    <td>
                                                                <?php 
                                                                    if ($item['tipo_pago'] == "EFECTIVO") {
                                                                        echo $item['monto'];
                                                                    }else{ echo 0; }
                                                                 ?>
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
                                                                <?php echo $item['nombre_carrera']; ?>
                                                            </td>   
                                                            <td>
                                                                <?php echo $item['id']; ?>
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
                                    <table id="egresos" class="table table-lg">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>N°</th>
                                                <th>Fecha </th>
                                                <th>Detalle</th>
                                                <th>Efectivo</th>
                                                <th>Mercado Pago</th>
                                            </tr>
                                            <thead>
                                            <tbody>
                                                <?php
                                                $total_egreso = 0;
                                                $sub_total_egreso_virtual_mp = 0;
                                                $sub_total_egreso_efectivo = 0;
                                                $egresos = $objeto->listadoEgresos($caja_id);
                                                foreach ($egresos as $item) {
                                                    $total_egreso = $total_egreso + $item['monto'];
                                                    if ($item['tipo_pago'] == "VIRTUAL MP") {
                                                        $sub_total_egreso_virtual_mp = $sub_total_egreso_virtual_mp + $item['monto'];
                                                        }                                                         

                                                        if ($item['tipo_pago'] == "EFECTIVO")  {
                                                            $sub_total_egreso_efectivo = $sub_total_egreso_efectivo + $item['monto'];
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $item['id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['fecha_egreso']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['egreso_tipo']; ?>
                                                        </td>
                                                            <td>
                                                                <?php 
                                                                    if ($item['tipo_pago'] == "EFECTIVO") {
                                                                        echo $item['monto'];
                                                                    }else{ echo 0; }
                                                                 ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    if ($item['tipo_pago'] == "VIRTUAL MP") {
                                                                        echo $item['monto'];
                                                                    }else{ echo 0; }
                                                                 ?>
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
                                    <!----------DEPOSITO -->
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Depositos</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                </div>
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table id="deposito" class="table table-lg">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Caja Fuerte</th>
                                                <th>Banco </th>
                                                <th>Mercado pago</th>
                                                <th>Saldo inicial proxima caja</th>
                                            </tr>
                                            <thead>
                                            <tbody>
                                                <?php
                                                
                                                $depositos = $objeto->listadoDepositos($caja_id);
                                                foreach ($depositos as $item) {
                                                 ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $item['dep_caja_fuerte']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['dep_banco']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['dep_mp']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['dep_proxima_caja']; ?>
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
                                                <font style="vertical-align: inherit;">Ingresos Virtual M.Pago</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_virtual_mp, 2, ',', '.'); ?></font>
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
                                                <font style="vertical-align: inherit;">Ingresos Virtual BBVA</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_virtual_bbva, 2, ',', '.'); ?></font>
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
                                                <font style="vertical-align: inherit;">Ingresos Efectivo</font>
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
                                                    $total_ingreso = $sub_total_efectivo + $sub_total_virtual_mp + $sub_total_virtual_bbva;
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
                                                <font style="vertical-align: inherit;">Egresos Virtual M.Pago</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_egreso_virtual_mp, 2, ',', '.'); ?></font>
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
                                                <font style="vertical-align: inherit;">Egresos Virtual BBVA</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format(0, 2, ',', '.'); ?></font>
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
                                                <font style="vertical-align: inherit;">Egresos Efectivo</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?php echo number_format($sub_total_egreso_efectivo, 2, ',', '.'); ?></font>
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
                                                <font style="vertical-align: inherit;">Saldo Virtual M.P.</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <?php
                                                    $saldovmp = $sub_total_virtual_mp - $sub_total_egreso_virtual_mp;
                                                    echo number_format($saldovmp, 2, ',', '.');
                                                    ?>
                                                </font>
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
                                                <font style="vertical-align: inherit;">Saldo Virtual BBVA</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <?php
                                                    $saldovbbva = $sub_total_virtual_bbva;
                                                    echo number_format($saldovbbva, 2, ',', '.');
                                                    ?>
                                                </font>
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
                                                <font style="vertical-align: inherit;">Saldo Efectivo</font>
                                            </font>
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <?php
                                                    $saldoefectivo = $sub_total_efectivo - $sub_total_egreso_efectivo;
                                                    echo number_format($saldoefectivo, 2, ',', '.');
                                                    ?>
                                                </font>
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
                    <!--a id="pagar23" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-target="#border-less23" data-monto="20000.00" data-detalle="Cuota Nº 7">
                        Cerrar Caja
                    </a-->
                    <a id="pagar23"  <?php echo $toggleAttribute; ?> >
                      Cerrar Caja
                    </a>
                    <button id="generarReporte"  <?php echo $toggleAttributeReporte; ?>>Generar Reporte</button>
                                                            
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
                                                <input type="hidden" name="saldo_efectivo" value="<?php echo $saldoefectivo; ?>">
                                                <input type="hidden" name="saldo_virtual_mp" value="<?php echo $saldovmp; ?>">
                                                <input type="hidden" name="saldo_virtual_bbva" value="<?php echo $saldovbbva; ?>">
                                                <?php $saldo_virtual=$saldovmp + $saldovbbva; ?>
                                                <input type="hidden" name="saldo_virtual" value="<?php echo $saldo_virtual; ?>">
                                                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['sesion_id']; ?>">                                                                                                
                                                <input type="hidden" id="monto_total_deposito" name="monto_total_deposito" value="<?php echo $saldo; ?>">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group " style="font-size: 18px;">
                                                                <label for="first-name-vertical">Efectivo $ <?php echo number_format($saldoefectivo, 2, ',', '.'); ?></label>
                                                                <br>
                                                                <label for="">Virtual MP $ <?php echo number_format($saldovmp, 2, ',', '.'); ?> </label>
                                                                <br>
                                                                <label for="">Virtual BBVA $ <?php echo number_format($saldovbbva, 2, ',', '.'); ?> </label>
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
                                                                <label for="password-vertical">Efectivo Proxima Caja</label>
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
<script type="text/javascript">
document.getElementById('generarReporte').addEventListener('click', function() {
    var ingresos = recopilarIngresos();
    var egresos = recopilarEgresos();
    var totales = calcularTotales(ingresos, egresos);
    var depositos = recopilarDepositos();
    
    var ventanaReporte = window.open('', '_blank');
    ventanaReporte.document.write(`
        <html>
        <head>
            <title>Reporte de Caja</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid black; padding: 5px; text-align: left; }
                th { background-color: #f2f2f2; }
                .totales { font-weight: bold; }
                @media print {
                    button { display: none; }
                }
            </style>
        </head>
        <body>
            <h1>Entradas</h1>
            ${generarTablaEntradas(ingresos)}
            <h1>Salidas</h1>
            ${generarTablaSalidas(egresos)}
            <h2>Resumen</h2>
            ${generarTablaResumen(totales)}
            <h1>Depositos</h1>
            ${generarTablaDepositos(depositos)}            
            <div style="text-align: center; margin-top: 20px;">
                <button onclick="window.print()" class="btn btn-primary no-print" style="font-size: 16px; padding: 10px 20px;">Imprimir</button>
            </div>            
        </body>
        </html>
    `);
    ventanaReporte.document.close();
});

function recopilarIngresos() {
    var ingresos = [];
    var filas = document.querySelectorAll('table tbody tr');
    var conceptointegrado = "";

    filas.forEach(function(fila) {
        var celdas = fila.querySelectorAll('td');
        if (celdas.length >= 6) {
            conceptointegrado = celdas[7].textContent + " " + celdas[8].textContent;
            var fecha = celdas[1].textContent;
        
            ingresos.push({
                alumno: celdas[0].textContent,
                fecha: fecha,
                montoMP: parseFloat(celdas[2].textContent.replace('$', '').replace(',', '')) || 0,
                montoBBVA: parseFloat(celdas[3].textContent.replace('$', '').replace(',', '')) || 0,               
                montoEFECTIVO: parseFloat(celdas[4].textContent.replace('$', '').replace(',', '')) || 0,             
                concepto: conceptointegrado,
                curso: celdas[9].textContent,
                comprobante: celdas[10].textContent,
            });
        }
    });
    return ingresos;
}

function recopilarEgresos() {
    var egresos = [];
    var filasEgresos = document.querySelectorAll('#egresos tbody tr');
    filasEgresos.forEach(function(fila) {
        var celdas = fila.querySelectorAll('td');
        if (celdas.length >= 4) {
            egresos.push({
                numero: celdas[0].textContent,
                fecha: celdas[1].textContent,
                detalle: celdas[2].textContent,
                efectivo: parseFloat(celdas[3].textContent.replace('$', '').replace(',', '')) || 0,
                mercadopago: parseFloat(celdas[4].textContent.replace('$', '').replace(',', '')) || 0,
            });
        }
    });
    return egresos;
}

function recopilarDepositos() {
    var depositos = [];
    var filasDepositos = document.querySelectorAll('#deposito tbody tr');
    filasDepositos.forEach(function(fila) {
        var celdas = fila.querySelectorAll('td');
        if (celdas.length >= 4) {
            depositos.push({
                cajafuerte: parseFloat(celdas[0].textContent.replace('$', '').replace(',', '')) || 0,
                banco: parseFloat(celdas[1].textContent.replace('$', '').replace(',', '')) || 0,
                mercadopago: parseFloat(celdas[2].textContent.replace('$', '').replace(',', '')) || 0,
                saldocajasiguiente: parseFloat(celdas[3].textContent.replace('$', '').replace(',', '')) || 0,
            });
        }
    });
    return depositos;
}

function calcularTotales(ingresos, egresos) {
    var totales = {
        ingresos: {efectivo: 0, mPago: 0, bbva: 0, total: 0},
        egresos: {efectivo: 0, mPago: 0,total: 0},
        saldo: {efectivo: 0, mPago: 0, bbva: 0, total: 0}
    };

    ingresos.forEach(function(ingreso) {
        totales.ingresos.efectivo += ingreso.montoEFECTIVO;
        totales.ingresos.mPago += ingreso.montoMP;
        totales.ingresos.bbva += ingreso.montoBBVA;
    });
    totales.ingresos.total = totales.ingresos.efectivo + totales.ingresos.mPago + totales.ingresos.bbva;

    egresos.forEach(function(egreso) {
        totales.egresos.efectivo += egreso.efectivo;
        totales.egresos.mPago += egreso.mercadopago;
        
    });
    totales.egresos.total += totales.egresos.efectivo + totales.egresos.mPago;

    totales.saldo.efectivo = totales.ingresos.efectivo - totales.egresos.efectivo;
    totales.saldo.mPago = totales.ingresos.mPago - totales.egresos.mPago;
    totales.saldo.bbva = totales.ingresos.bbva;
    totales.saldo.total = totales.ingresos.total - totales.egresos.total;

    return totales;
}

function generarTablaEntradas(ingresos) {
    let tabla = `
        <table>
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Fecha</th>
                    <th>Monto MP</th>
                    <th>Monto BBVA</th>
                    <th>Efectivo</th>
                    <th>Detalle</th>
                    <th>Curso</th>
                    <th>Comp.</th>
                </tr>
            </thead>
            <tbody>
    `;

    ingresos.forEach(function(ingreso) {
        tabla += `
            <tr>
                <td>${ingreso.alumno}</td>
                <td>${ingreso.fecha}</td>
                <td>$${ingreso.montoMP.toFixed(2)}</td>
                <td>$${ingreso.montoBBVA.toFixed(2)}</td>
                <td>$${ingreso.montoEFECTIVO.toFixed(2)}</td>
                <td>${ingreso.concepto}</td>
                <td>${ingreso.curso}</td>
                <td>${ingreso.comprobante}</td>
            </tr>
        `;
    });

    tabla += '</tbody></table>';
    return tabla;
}

function generarTablaSalidas(egresos) {
    let tabla = `
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Efectivo</th>
                    <th>Mercado Pago</th>
                </tr>
            </thead>
            <tbody>
    `;

    egresos.forEach(function(egreso) {
        tabla += `
            <tr>
                <td>${egreso.numero}</td>
                <td>${egreso.fecha}</td>
                <td>${egreso.detalle}</td>
                <td>${egreso.efectivo.toFixed(2)}</td>
                <td>${egreso.mercadopago.toFixed(2)}</td>
            </tr>
        `;
    });

    tabla += '</tbody></table>';
    return tabla;
}

function generarTablaDepositos(depositos) {
    let tabla = `
        <table>
            <thead>
                <tr>
                    <th>Caja Fuerte</th>
                    <th>Banco</th>
                    <th>Mercado Pago</th>
                    <th>Proxima Caja</th>
                </tr>
            </thead>
            <tbody>
    `;

    depositos.forEach(function(deposito) {
        tabla += `
            <tr>
                <td>${deposito.cajafuerte.toFixed(2)}</td>
                <td>${deposito.banco.toFixed(2)}</td>
                <td>${deposito.mercadopago.toFixed(2)}</td>
                <td>${deposito.saldocajasiguiente.toFixed(2)}</td>
            </tr>
        `;
    });

    tabla += '</tbody></table>';
    return tabla;
}


function generarTablaResumen(totales) {
    return `
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Efectivo</th>
                    <th>M Pago</th>
                    <th>Bbva</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Ingresos</td>
                    <td>${totales.ingresos.efectivo.toFixed(2)}</td>
                    <td>${totales.ingresos.mPago.toFixed(2)}</td>
                    <td>${totales.ingresos.bbva.toFixed(2)}</td>
                    <td>${totales.ingresos.total.toFixed(2)}</td>
                </tr>
                <tr>
                    <td>Total Egresos</td>
                    <td>${totales.egresos.efectivo.toFixed(2)}</td>
                    <td>${totales.egresos.mPago.toFixed(2)}</td>
                    <td>-</td>
                    <td>${totales.egresos.total.toFixed(2)}</td>
                </tr>
                <tr class="totales">
                    <td>Saldo</td>
                    <td>${totales.saldo.efectivo.toFixed(2)}</td>
                    <td>${totales.saldo.mPago.toFixed(2)}</td>
                    <td>${totales.saldo.bbva.toFixed(2)}</td>
                    <td>${totales.saldo.total.toFixed(2)}</td>
                </tr>
            </tbody>
        </table>
    `;
}             

        </script>

