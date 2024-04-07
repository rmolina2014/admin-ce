<?php
include ("ingreso.php");
$objeto = new Ingreso();
if (isset ($_POST['carrera_id']) && !empty ($_POST['carrera_id'])) {
    $carrera_id = $_POST['carrera_id'];
    $registros = $objeto->buscarCarreraCuotas($carrera_id);
    $data = array();
    if ($registros) {
        foreach ($registros as $item) {
            $cuota_id = $item['id'];
            $detalle = $item['detalle'];
            $costo = $item['costo'];
            $data[] = array("cuota_id" => $cuota_id, "detalle" => $detalle, "costo" => $costo);
        }
    } else {
        $estado = 'error';
        $mensaje = 'No Existe ID Carrera';
        $data[] = array("estado" => $estado, "mensaje" => $mensaje);
    }
    echo json_encode($data);
}
