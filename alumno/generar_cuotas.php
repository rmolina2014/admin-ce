<?php
//13-04-2024 generar cuotas, y generar comisiones
include ("usuario.php");
$usuario_id = $ID;

if (isset($_GET['alumno_id']) && !empty($_GET['alumno_id'])) {
    $prestamo_id = $_GET['idPrestamo'];
    $objeto = new Cuota();
    $listaPrestamo = $objeto->obtenerPrestamo($prestamo_id);

    foreach ($listaPrestamo as $item) {

        // (((((cuota * tasa )/100 )+1)*montosolicitado)/cuotas)

        $cantidadcuotas = $item['cantidadcuotas'];
        $tasa = $item['tasa'];
        $monto = $item['monto'];
        $vendedor_id = $item['vendedor_id'];
        $vencimiento = $item['vencimientoprimeracuota'];

        $monto_cuota = round((((($cantidadcuotas * $tasa) / 100) + 1) * $monto) / $cantidadcuotas); // valor de la cuota

        $cliente_id = $item['cliente_id'];
        // fecha del vencimiento de la primera cuota 
        // $vencimiento = $item['fechaalta'];

        $estado = 'ACTIVADA'; //estado de las cuotas activada, pagada,vencida

        switch ($item['tipo']) {
            case 'SEMANAL': //echo "semanal";
                {
                    $dias = '+7 day';
                    break;
                }
            case 'MENSUAL': { //echo "mensual";
                    $dias = '+30 day';
                    break;
                }
        }

        $i = 0;
        $cuota = new Cuota();
        // ingresar la fecha de vencimiento de la primer cuota
        $fecha_vencimiento = $vencimiento;
        while ($cantidadcuotas > $i) {
            if ($i > 0) {

                $fecha = date_create($fecha_vencimiento);

                date_add($fecha, date_interval_create_from_date_string($dias));

                $fecha_vencimiento = date_format($fecha, 'Y-m-d');

                $diasemana = date_format($fecha, 'w');

                if ($diasemana == 0) {
                    $fecha = date_create($fecha_vencimiento);
                    date_add($fecha, date_interval_create_from_date_string('+1 day'));
                    $fecha_vencimiento = date_format($fecha, 'Y-m-d');
                }
            } else $fecha_vencimiento = $vencimiento;


            $numero_cuota = $i + 1;

            $todobien = $cuota->nuevo($prestamo_id, $cliente_id, $numero_cuota, $fecha_vencimiento, $monto_cuota, $estado, $monto_cuota, $usuario_id);
            //$vencimiento=$nuevafecha;

            if ($todobien) {
                $i++;
            } else {
?>
                <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    Lo sentimos, no se pudo generar la cuota ...<? echo $i; ?>
                </div>
<?php
            }
        } //fin del while interno

    } //fin primer while


    //-------- generar el movimiento en la caja del egreso del prestamo-------

    $todobien = $cuota->movimientocaja('Egreso', $monto, 'Prestamo: ' . $prestamo_id, date("Y-m-d"), $usuario_id, 'Prestamo');



    //01112020-------- generar la comision-------

    //$todobien=$cuota->generarComision($vendedor_id,$prestamo_id,$cantidadcuotas,$monto_cuota,date("Y-m-d"));

    // traer porcentaje del vendedor

    $sql = "select comision from vendedor where id=$vendedor_id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    while ($fila = mysqli_fetch_assoc($rs)) {
        $comision = $fila['comision'];
    }
    // calcular comision

    $montocomision = ($monto * $comision) / 100;

    $fecha_actual = date("Y-m-d");

    // insertar primera cuota
    $sql = "INSERT INTO `comision`
            (
             `vendedor_id`,
             `prestamo_id`,
             `cheque_id`,
             `cuota_id`,
             `importe`,
             `estado`,
             `numero_cuota`,
             `fecha_ingreso`)
            VALUES (
                    '$vendedor_id',
                    '$prestamo_id',
                    '0',
                    '1',
                    '$montocomision',
                    'Activa',
                    '1',
                    '$fecha_actual');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);


    //-------------------------------------------------

    echo "<script language=Javascript> location.href=\"listado_cuota.php?idPrestamo=\"+$prestamo_id; </script>";
    //header("Location: listado.php?idPrestamo=$idPrestamo");
    exit;
} else echo "error sin prestamo";
?>