<?
//1606/2017 insertar detalle de apertura 
include("../sesion.php");
include("caja.php");
include '../menu.php';
$objecto = new Caja();
if( isset($_POST['inicio']) && !empty($_POST['inicio']) )
 {

  $inicio = $_POST['inicio'];
  $fechaapertura= date("Y-m-d H:i:s");
  $cierre=0;
  $fechacierre='2001-01-01';
  $estado='Abierta';
  $saldo=0;
  $observacion= $_POST['observacion'];
  $cajanueva_id = $objecto->abrircaja($inicio,$fechaapertura,$cierre,$fechacierre,$estado,$saldo);
  // insertar detalle del movimiento


  $todobien=$objecto->insertarDetalleApertura($cajanueva_id,'Apertura','Ingreso',$inicio,$fechaapertura,'Apertura'
                      ,$ID);



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
else
{
?>
 <div class="container">
 <h3>Caja</h3>
 <script src="../js/jquery.js"></script>
 <script src="../js/util.js"></script>
 <hr>
 <div class="row">

 <div class="col-md-6">
     
 <h4>Apertura de Caja</h4>
 <hr>
  <form method="POST" role="form" action="abrircaja.php">
  
  <div class="col-md-8">
    <label>Monto*</label>
    <input name="inicio" class="form-control" type="text" tabindex="1" maxlength="15" onkeypress="return soloNumeros(event);" required autofocus/>
  </div>

  <div class="col-md-8">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='index.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
</form>     
 <?
 }
 ?>             
   