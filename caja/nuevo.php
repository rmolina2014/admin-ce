<?php
include("../cabecera.php");
include("../menu.php");
include("caja.php");
$objeto = new Caja();

$cantCajasAbiertas = $objeto->cajasAbiertas();
//echo $cantCajasAbiertas;
//exit;
if ($cantCajasAbiertas >= 1) {
  echo "<script language=Javascript> alert('Debe Cerrar la Caja Actual.'); </script>";
  echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}
$ingreso_total = 0;
$fecha_apertura = date("Y-m-d H:i:s");
$egreso_total = 0;
$fecha_cierre = '0001-01-01';
$estado = 'Abierta';
$saldo = 0;

$todobien = $objeto->nuevo($fecha_apertura, $ingreso_total, $egreso_total, $fecha_cierre, $estado, $saldo);
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
<?php
}
?>