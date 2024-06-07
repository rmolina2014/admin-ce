<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['cuota_id']) && !empty($_POST['cuota_id'])) {
    $cuota_id = $_POST['cuota_id'];
    $fecha_pago = date("Y-m-d H:i:s");
    //$estado = 'PAGADO';
    $alumno_id = $_POST['alumno_id'];
    $detalle = $_POST['detalle'];
    $tipo_pago = $_POST['tipo_pago'];
    // Suponiendo que quieres verificar la variable $_POST['miVariable']
    //$valorPost = empty($_POST['miVariable']) ? 0 : $_POST['miVariable'];
    $descuento_tipo_pago =
        empty($_POST['descuentoFormaPago']) ? 0 : $_POST['descuentoFormaPago'];

    $descuento_antes_dia_10 =
        empty($_POST['descuentoPagoaAntesDiaDiez']) ? 0 : $_POST['descuentoPagoaAntesDiaDiez']; //$_POST['descuentoPagoaAntesDiaDiez'];
    $apagar = $_POST['apagar'];
    $usuario = $ID;
    //esto graba en la tabla pagos_parciales el pago
    $pagar_cuota = $objeto->pagarAlumnoCuota($cuota_id, $fecha_pago, $descuento_tipo_pago, $descuento_antes_dia_10, $apagar, $usuario);
    

    if ($pagar_cuota) {

    //tengo que verificar si con este pago_parcial completo la cuota, para cambiar el estado en la
    //tabla alumno_carrera_cuotas

    $saldo_final = 0;
    $saldo_cuota = $objeto->saldoCuotaAlumno($cuota_id);
    foreach ($saldo_cuota as $item) {
        $saldo_final = $item['saldo'];
    }

    if ($saldo_final == 0) {
            //si el saldo es 0 quiere decir que se saldo la cuota, hay que cambiar el estado
            $cambia_estado = $objeto->estadoCuota($cuota_id, 'PAGADO');
    }

        $descuento = $descuento_tipo_pago + $descuento_antes_dia_10;
        //-------- generar el movimiento en la caja-------
        $insertarIngreso = $objeto->insertarIngresoAlumnoCuota($cuota_id, $tipo_pago, $apagar, $alumno_id, $ID, $detalle, $descuento);
    }

    // recuperar datos
    $objeto = new Alumno();
    $datos_cuota = $objeto->obtenerCuotaId($cuota_id);
    foreach ($datos_cuota as $item) {
        $detalle = $item['cuota_detalle'];
        $dni = $item['dni'];
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $cuota_numero = $item['cuota_numero'];
        $alumno_id = $item['alumno_id'];
    }

}
?>
<?php
/*
        //echo "<script language=Javascript> location.href=\"alumno_carrera_cuotas.php?id=" . $alumno_id . "\"; </script>";
        //header('Location: listado.php');
        //exit;
    } else {
    ?>
        <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Lo sentimos, no se pudo guardar ...
        </div>
<?php
    }
}*/
?>
<style>
    /* Estilos generales */
    .imprimir {
        background: white;
        margin-right: 200px;
        margin-left: 200px;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        max-width: 1000px;
    }

    .imprimir table {
        max-width: 960px;
    }

    /************** */
    .recibo {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .recibo-encabezado {
        text-align: center;
        margin-bottom: 20px;
    }

    .recibo-encabezado h1 {
        margin: 0;
    }

    .recibo-informacion {
        display: flex;
        justify-content: space-between;
    }

    .recibo-informacion-izquierda {
        width: 50%;
    }

    .recibo-informacion-derecha {
        width: 49%;
        text-align: right;
    }

    .recibo-tabla {
        width: 100%;
        border-collapse: collapse;
    }

    .recibo-tabla th,
    .recibo-tabla td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    .recibo-tabla th {
        text-align: left;
        background-color: #f2f2f2;
    }

    .recibo-firma {
        text-align: center;
        margin-top: 20px;
    }

    .recibo-fecha-impresion {
        font-size: 9px;
        text-align: right;
    }
</style>
</head>

<body>

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
                        <div class="imprimir" id="imprimir">
                            <div class="recibo">
                                <div class="recibo-encabezado">
                                    <h1>INSTITUTO CE</h1>
                                    <h1></h1>
                                </div>

                                <div class="recibo-informacion">
                                    <div class="recibo-informacion-izquierda">
                                        <p><strong>Responsable Monotributo:</strong></p>
                                        <p>CUIT N° xx-xxxxxxx-x</p>
                                        <p><strong>Documento No válido como factura</strong></p>
                                    </div>

                                    <div class="recibo-informacion-derecha">
                                        <p><strong>Fecha:</strong> <?php echo $fecha_pago; ?></p>
                                        <p><strong>N° Recibo:</strong> <?php echo  $cuota_id; ?></p>
                                    </div>
                                </div>

                                <div class="recibo-informacion">
                                    <p><strong>Señores: </strong> <?php echo $apellidonombre; ?></p>
                                    <p>D.N.I.: <?php echo $dni; ?></p>
                                    <p><strong>Horario:</strong></p>
                                    <p><strong>Curso:</strong></p>
                                    
                                </div>

                                <table class="recibo-tabla">
                                    <thead>
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Plan de Pago</td>
                                            <td><span class="math-inline"></td\>
                                                    </tr\>
                                                    <tr\>
                                                        <td\>Inscripción</td\>
                                                        <td\>
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Cuota N°</td>
                                            <td><span class="math-inline"></td\>
                                                    </tr\>
                                                    <tr\>
                                                        <td\>Otros</td\>
                                                        <td\>
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <th>$</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="recibo-firma">
                                    <p>Firma y Sello</p>
                                </div>

                                <div class="recibo-fecha-impresion">
                                    <p>Fecha de imp: 18/11/2023</p>
                                    <p>ORIGINAL:</p>
                                </div>
                            </div>
                        </div><!-- finimprimir-->



                        <button onclick="printDiv()">Imprimir</button>

                        <a href="alumno_carrera_cuotas.php?id=<?php echo $alumno_id; ?>" class="btn btn-outline-primary">Cancelar</a>

                        <script src="../script.js"></script>
                    </div>
                </div>
            </section>