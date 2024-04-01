<?php
include("../sesion.php");
include("detallecaja.php");
$objecto = new DetalleCaja();
if( isset($_POST['monto']) && !empty($_POST['monto']) )
 {
   $cajanueva_id=$_POST['cajanueva_id'];
   $operacion=$_POST['operacion'];
   $tipo=$_POST['tipo'];
   $monto=$_POST['monto'];
   $fechahora=date("Y-m-d H:i:s");
   $detalle=$_POST['detalle'];
   $usuario_id=$ID;

   $todobien = $objecto->nuevo($cajanueva_id,$operacion,$tipo,$monto,$fechahora,$detalle,$usuario_id);
   
   if($todobien){
        echo "<script language=Javascript> location.href=\"index.php\"; </script>"; 
        //header('Location: listado.php');
        exit;
      } 
      else {
      ?>      
           <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
           <button data-dismiss="alert" class="close" type="button">×</button>
           Lo sentimos, no se pudo guardar ...
           </div> 
      <?
      }     
}
else echo 'error';
