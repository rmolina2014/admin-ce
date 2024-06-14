<?php
include("../sesion.php");
include("caja.php");
include("../cajadetalle/detallecaja.php");

if (isset($_POST['caja_id']) && !empty($_POST['caja_id']))
{
  $caja_id=$_POST['caja_id'];
  $ingreso_total=$_POST['ingreso_total'];
  $egreso_total=$_POST['egreso_total'];
  $fecha_cierre = date("Y-m-d H:i:s");
  $estado = 'Cerrado';
  $saldo=$_POST['saldo'];
  $saldo_efectivo = $_POST['saldo_efectivo'];
  $saldo_virtual = $_POST['saldo_virtual'];
  $dep_caja_fuerte = $_POST['dep_caja_fuerte'];
  $dep_banco = $_POST['dep_banco'];
  $dep_mp = $_POST['dep_mp'];
  $dep_proxima_caja = $_POST['dep_proxima_caja'];

  // cerrar caja
  $objecto = new Caja();

  /*
     $id,
    $fecha_cierre,
    $estado,
    $saldo_efectivo,
    $saldo_virtual,
    $dep_caja_fuerte,
    $dep_banco,
    $dep_mp,
    $dep_proxima_caja
   */

  $todobien = $objecto->cerrarcaja($caja_id,$fecha_cierre,'Cerrado', $saldo_efectivo, $saldo_virtual,$dep_caja_fuerte,$dep_banco,$dep_mp,$dep_proxima_caja);
  if ($todobien) {
    
    // abrir proxima caja
    $fecha_apertura = date("Y-m-d H:i:s");
    $ingreso_total = $dep_proxima_caja;
    $egreso_total = 0;
    $fecha_cierre = date("Y-m-d H:i:s");
    $estado = 'Abierta';
    $saldo = $dep_proxima_caja;
    $id_caja_nueva = $objecto->abrircaja($fecha_apertura, $ingreso_total, $egreso_total, $fecha_cierre, $estado, $saldo);

    // agregar el ingreso del saldo inicial
    //el tipo de ingreso 1 es ingreso de socios
    //el alumno_id=1 esta jarcodeado es el dni del instituto
    $ingreso_inicial_caja = $objecto->insertar_ingreso($dep_proxima_caja, date("Y-m-d H:i:s"), $id_caja_nueva, $ID, 1,1,"INGRESO INICIAL CAJA ANTERIOR","EFECTIVO","Socios");

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
} else {
  echo "<script language=Javascript> alert('error si caja id'); </script>";
  exit;
  echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}
?>