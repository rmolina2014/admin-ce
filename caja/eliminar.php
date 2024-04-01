<?php
include("usuario.php");
include("../menu.php");
if(isset($_GET['id']) && !empty($_GET['id'])) {
	$id = (int)$_GET['id'];
      $clientes = usuario::obtenerId($id);
      foreach($clientes as $cli)
	{
   ?>

 <div class="container">
 <h3>Usuarios</h3>
 <script src="../js/jquery.js"></script>
 <hr>
 <div class="row">
 <div class="col-md-6">
 <h3>Eliminar Usuario</h3>
 <hr>     
 
 <form class="form-horizontal" role="form" method="POST" action="eliminar.php">
  <input type="hidden" name="idCliente" value="<?echo $id; ?>" />
  
   <div class="col-md-8">
    <label>Usuario </label>
    <input name="cliente"  class="form-control" type="text" tabindex="1"  value="<?echo utf8_encode($cli['usuario']); ?>" required />
  </div>

  <div class="col-md-8">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='index.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Eliminar</button>
  </div>
</form>

 <?
}//fin del while
}


if( isset($_POST['idCliente']) && !empty($_POST['idCliente']) )
 {
	$id = $_POST['idCliente'];
	//$objecto = new Cliente();
	//$todobien = $objecto->borrar($id);
	$todobien=usuario::eliminar($id);
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
?>