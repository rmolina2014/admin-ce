<?php
 include("detallecaja.php");
 $cajacerrada = DetalleCaja::estadoCajas();
 foreach($cajacerrada as $item)
  {
    $cajasAbiertas=$item ['abiertas'];;
  } 

 if ($cajasAbiertas==1)
 {
 
 $cajas= DetalleCaja::busarCajaAbierta();
 foreach($cajas as $item)
 {
   $caja_id=$item ['id']; 
   $monto=$item ['inicio'];
   $saldo=$monto; 
 }

 $ingresos=0;
 $egresos=0;

  $suma_ingresos = DetalleCaja::ingresoDetalleCaja($caja_id);
  foreach($suma_ingresos as $item)
  {
   $ingresos=$item ['sumatoria'];;
  } 

  $suma_egresos = DetalleCaja::egresoDetalleCaja($caja_id);
  foreach($suma_egresos as $item)
  {
   $egresos=$item ['sumatoria'];;
  } 

  $sumatoria=$ingresos-$egresos;
 
  echo '***** '.number_format($sumatoria, 2, '.', '');
}
?>