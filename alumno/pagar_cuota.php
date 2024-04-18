<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['cuota_id']) && !empty($_POST['cuota_id']))
{
 $cuota_id = $_POST['cuota_id'];
 $fecha_pago = date("Y-m-d");
 $estado = 'PAGADO';
 $pagar_cuota = $objeto->pagarAlumnoCuota($cuota_id,$estado,$fecha_pago);
    if ($pagar_cuota) {
        echo "<script language=Javascript> location.href=\"alumno_carrera_cuotas.php\"; </script>";
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


 // continuar para pagar una cuota

   /* $carrera_id = $_POST['carrera_id'];
    $gruposanguineo = $_POST['gruposanguineo'];
    $alumno_id = $_POST['alumno_id'];
    $estado = $_POST['estado'];

    //$fechaingreso = date("Y-m-d");
    //$estado = 'Activo';

    $todobien = $objeto->editar($alumno_id, $edad, $gruposanguineo, $carrera_id, $estado);
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
    }*/

    /*
    
    $todobien = $objeto->pagoTotal($cuota_id);
  
  //-------- generar el movimiento en la caja-------

  $todobien=$objeto->movimientocaja('Ingreso ',$monto,'ID Cuota: '.$cuota_id.'-N°-'.$numero_cuota.'-Pr:-'.$idPrestamo ,date("Y-m-d"),$usuario_id,'Pago Cuota Total');

  if($todobien){
			//header("Location:listado.php?idPrestamo=".$idPrestamo);
			echo "<script language=Javascript> location.href=\"listado_cuota.php?idPrestamo=\"+$idPrestamo; </script>"; 
      exit;
		} else {
			$mensaje = 'Lo sentimos, no se pudo grabar el pago ...'.$cuota_id;
		}
		echo $mensaje;
} else echo 'Falta el ID';
    */
}
?>