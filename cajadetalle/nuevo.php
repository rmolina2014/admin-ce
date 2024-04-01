<?php
include("../sesion.php");
include("../menu.php");
include("detallecaja.php");

$objecto = new DetalleCaja();
if( isset($_POST['monto']) && !empty($_POST['monto']) )
 {
   $cajanueva_id=$_POST['cajanueva_id'];
   $operacion=$_POST['operacion'];
   $tipo=$_POST['operacion'];
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
      <?php
      }     
}
//else echo 'error';

if ( isset($_GET['caja_id']) && !empty($_GET['caja_id']) )
 {
   $cajanueva_id=$_GET['caja_id'];
 
?>
 <div class="container">
 <h3>Movimientos</h3>
 <hr>
 <div class="row">

 <div class="col-md-6">
     
  <h4>Agregar Movimiento</h4>
  <hr>
  <form method="POST" role="form" action="nuevo.php">

    <input type="hidden" id="cajanueva_id" name="cajanueva_id" value="<? echo $cajanueva_id; ?>" >
  
   <div class="col-md-8">
    <label >Operacion*</label>
    <select class="form-control" name="operacion" id="operacion" required autofocus>
      <option value="0">Seleccionar.....</option>
      <option value="Ingreso">Ingreso</option>
      <!--option value="Egreso">Egreso</option-->
     </select>
   </div>
 
   <div class="col-md-8">
    <label>Monto*</label>
    <input name="monto" id="monto" class="form-control" type="text" tabindex="1" maxlength="15" onkeypress="return soloNumeros(event);" required />
   </div>


   <div class="col-md-8">
    <label>Obervacion</label>
    <input name="detalle" id="detalle" class="form-control" type="text" tabindex="3" maxlength="35" />
   </div> 
  
  
  <div class="col-md-8">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='index.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button id='botonGuardar' type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
</form>     
<?php
}
?>

 <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/bootstrap.min.js" type="text/javascript"></script>

  <script type="text/javascript">
  $(document).ready(function()
   {
     // llamada ajax
      $('#guardar').click(function(){
        var v_cajanueva_id = document.getElementById("cajanueva_id").value; 
        var v_operacion = $("#operacion :selected").text();
        var v_tipo =document.getElementById("operacion").value; 
        var v_monto = document.getElementById("monto").value;
        var v_detalle = document.getElementById("detalle").value;
       
        $.ajax({
             type: "POST",
             cache: false,
             async: false,
            url: 'insertarCajaDetalle.php',
            data: { cajanueva_id: v_cajanueva_id,operacion: v_operacion, tipo: v_tipo, monto:v_monto, detalle:v_detalle },
            success: function(data) {
                //$('#div_dinamico').html(data);
                //alert(data);
                 if(data){
            window.location.replace("index.php");
          }
            }
        });
    });

 });
</script>
</body>
</html>