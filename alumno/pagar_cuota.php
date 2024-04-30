<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['cuota_id']) && !empty($_POST['cuota_id'])) {
    $cuota_id = $_POST['cuota_id'];
    $fecha_pago = date("Y-m-d H:i:s");
    $estado = 'PAGADO';
    $alumno_id = $_POST['alumno_id'];
    $tipo_pago = $_POST['tipo_pago'];

    $pagar_cuota = $objeto->pagarAlumnoCuota($cuota_id, $estado, $fecha_pago);
    if ($pagar_cuota) {

        //-------- generar el movimiento en la caja-------
        $insertarIngreso = $objeto->insertarIngresoAlumnoCuota($cuota_id,$tipo_pago);

        echo "<script language=Javascript> location.href=\"alumno_carrera_cuotas.php?id=" . $alumno_id . "\"; </script>";
        //header('Location: listado.php');
        exit;
    } else {
?>
        <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Lo sentimos, no se pudo guardar ...
        </div>
<?php
    }
}
?>