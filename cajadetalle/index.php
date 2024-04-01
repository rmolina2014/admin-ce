<?php
include("../sesion.php");
include("../menu.php");
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
?>
 <div class="container">
    <h3>
     Caja N° : <?php echo $caja_id;?>
     Saldo Inicial: $<?php echo $saldo;?>
     Saldo Real: $<?php
       echo number_format($sumatoria, 2, '.', '');
       //echo $sumatoria;?> 
    </h3>
    <hr>
     <h3> Movimientos </h3>
     <p>
       <a class="btn btn-primary" href="nuevo.php?caja_id=<? echo $caja_id;?>">Ingresar Movimiento</a> 
   </p>
    <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
             <th>Caja N°</th>
             <th>Operacion</th>
             <th>Tipo</th>
             <th>Monto</th>
             <th>Detalle</th>
             <th>Fecha</th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new DetalleCaja();
          $usuarios = DetalleCaja::listaDetalleCaja($caja_id);
          foreach($usuarios as $item)
          {
          ?>
           <tr>
              <td><?php echo $item ['cajanueva_id']; ?></td>
              <td><?php echo $item ['operacion']; ?></td>
              <td><?php echo $item ['tipo']; ?></td>
              <td><?php echo $item ['monto']; ?></td>
              <td><?php echo $item ['detalle']; ?></td>
              <td><?php echo $item ['fechahora']; ?></td>
            </tr>
          <?php
           }
          ?>
          </tbody>
         </table>
       </div>
  <?php
  }
   else{
    echo "<h3> No hay una Cajas Abierta.</h3>";
   }
  ?>
  
</body>
</html>