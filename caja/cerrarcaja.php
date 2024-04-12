<?php
include ("caja.php");
include ("../cajadetalle/detallecaja.php");
if (isset($_GET['caja_id']) && !empty($_GET['caja_id'])) {
  $cajas = DetalleCaja::busarCajaAbierta();
  foreach ($cajas as $item) {
    $caja_id = $item['id'];
    $monto = $item['inicio'];
    $saldo = $monto;
  }

  $ingresos = 0;
  $egresos = 0;

  $suma_ingresos = DetalleCaja::ingresoDetalleCaja($caja_id);
  foreach ($suma_ingresos as $item) {
    $ingresos = $item['sumatoria'];
    ;
  }

  $suma_egresos = DetalleCaja::egresoDetalleCaja($caja_id);
  foreach ($suma_egresos as $item) {
    $egresos = $item['sumatoria'];
    ;
  }

  $sumatoria = $ingresos - $egresos;

  $objecto = new Caja();


  $caja_id = $_GET['caja_id'];
  $fechacierre = date("Y-m-d H:i:s");
  $estado = 'Cerrado';
  //diferencia de saldo inicial - movimientos  
  $cierre = $sumatoria;

  $saldo = 0;

  $observacion = $_POST['observacion'];
  $todobien = $objecto->cerrarcaja($caja_id, $cierre, $fechacierre, $estado, $saldo);
  if ($todobien) {
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    //header('Location: listado.php');
    exit;
  } else {
    ?>
    <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
      <button data-dismiss="alert" class="close" type="button">×</button>
      Lo sentimos, no se pudo guardar ...
    </div>
  <?
  }
} else {
  echo 'Error';
  echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}
?>