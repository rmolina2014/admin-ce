<?php
include("../sesion.php");
include("../menu.php");
include("caja.php");

if( isset($_GET['caja_id']) && !empty($_GET['caja_id']) )
{
 $objeto=new Caja(); 
 $caja_id=(int)$_GET['caja_id'];
 $registros=$objeto->detalleCaja($caja_id);
 foreach($registros as $item)
 {
  $id = $item['id']; 
  $inicio = $item['inicio']; 
  $fecha_cierre = $item['fechacierre']; 
  $saldo = $item['cierre']; 
?>
 <div class="container">
    <h2>Detalle Caja </h2>
     <h3>
     Caja N° : <? echo $id;?>
     Saldo Inicial: $<? echo $inicio;?>
     Saldo al Cierre: $<? echo $saldo;?>
     Fecha Cierre: <? echo $fecha_cierre;?> 
    </h3>
      <?
         }
      ?>  
   <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
             <th>Operacion</th>
             <th>Tipo</th>
             <th>Monto</th>
             <th>Detalle</th>
              <th>Fecha</th>
             </tr>
           <thead>
           <tbody>
          <?php
          $usuarios = caja::listaDetalleCaja($id);
          foreach($usuarios as $item)
          {
          ?>
           <tr>
             
              <td><?php echo $item ['operacion']; ?></td>
              <td><?php echo $item ['tipo']; ?></td>
              <td><?php echo $item ['monto']; ?></td>
              <td><?php echo $item ['detalle']; ?></td>
               <td><?php echo $item ['fechahora']; ?></td>
            </tr>
          <?php
           }
         }
          ?>
          </tbody>
         </table>
       </div>
   
  <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>