<?
include("../sesion.php");
include("caja.php");
include '../menu.php';
$objecto = new Caja();
if( isset($_POST['inicio']) && !empty($_POST['inicio']) )
 {

  $cierre = $_POST['inicio'];
  $fechaapertura= date("Y-m-d H:i:s");
  $cierre=0;
  $fechacierre='2001-01-01';
  $estado='Abierto';
  $saldo=0;
  

  $observacion= $_POST['observacion'];
  $todobien = $objecto->abrircaja($inicio,$fechaapertura,$cierre,$fechacierre,$estado,$saldo);
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
     
 <h4>Cierre de Caja</h4>
 <hr>
  <form method="POST" role="form" action="cerrarcaja.php">
  
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
   