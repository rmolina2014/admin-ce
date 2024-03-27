 <?php
 include("../cabecera.php");
 include("../menu.php");
 include("persona.php");

 $objeto = new Persona();
 if( isset($_POST['id']) && !empty($_POST['id']) )
 {
    $id=(int)$_POST['id'];
    $registros= $objeto->obtenerId($id);
   foreach($registros as $item)
   {
    $id_persona= $item['id'];
   }
?>

<div id="main">
     <header class="mb-3">
       <a href="#" class="burger-btn d-block d-xl-none">
         <i class="bi bi-justify fs-3"></i>
       </a>
     </header>

     <div class="page-heading">
       <div class="page-title">
         <div class="row">
           <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Personas</h3>
             <!--p class="text-subtitle text-muted">The default layout.</p-->
           </div>
           <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Personas</li>
               </ol>
             </nav>
           </div>
         </div>
       </div>

       <section class="section">
         <div class="card">
           <div class="card-header">
             <h4 class="card-title">Editar Persona</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
<form method="POST" role="form" action="editar.php">

  <div class="col-md-8 mb-3">
    <label class="form-label">DNI</label>
    <input name="dni"  class="form-control" type="text" tabindex="1" required value="<?php echo utf8_encode($item['dni']); ?>" disabled/>
  </div>
  <input type="hidden" name="id_persona" value="<?php echo $item['id']; ?>">
  <div class="col-md-8 mb-3">
    <label class="form-label">Apellido y Nombre</label>
    <input name="apellido_nombre"  class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['apellidonombre']); ?>" disabled/>
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label" >Domicilio </label>
    <input name="domicilio"  class="form-control" type="text" tabindex="3" required value="<?php echo utf8_encode($item['domicilio']); ?>"/>
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Celular Principal</label>
    <input name="cel_prin"  class="form-control" type="text" tabindex="4"  value="<?php echo utf8_encode($item['cel1']); ?>" />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Celular Alternativo</label>
    <input name="cel_alte"  class="form-control" type="text" tabindex="4"  value="<?php echo utf8_encode($item['cel2']); ?>" />
  </div>  

  <div class="col-md-8 mb-3">
    <label class="form-label">Mail</label>
    <input name="mail"  class="form-control" type="email" tabindex="4"  value="<?php echo utf8_encode($item['mail']); ?>" />
  </div>   

    
  <div class="col-md-8 mb-3">

    <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar
  
    </button>
    
    <button type="submit" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
       Guardar
    
    </button>
  
  </div>
</form>

<!--- fin -->
             <!--- fin contenido -->
             </div>
         </div>
       </section>
       <?php
        include("../pie.php");
        
}else
{
if (isset($_POST['id_persona']) && !empty($_POST['id_persona']))
{
//   editar($id,$apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail)
$id = $_POST['id_persona'];
//$apellidonombre= $_POST['apellido_nombre'];
//$dni = $_POST['dni'];
$domicilio=$_POST['domicilio'];
$cel1= $_POST['cel_prin'];
$cel2=$_POST['cel_alte'];
$mail=$_POST['mail'];


//$fechaingreso = date("Y-m-d");
//$estado = 'Activo';

//$todobien = $objeto->editar($id,$apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail);
$todobien = $objeto->editar($id,$domicilio, $cel1, $cel2, $mail);
if($todobien){
    echo "<script language=Javascript> location.href=\"index.php\"; </script>"; 
    //header('Location: listado.php');
    exit;
  } 
  else {
    echo "<script language=Javascript> location.href=\"index.php\"; </script>"; 
  ?>      
       <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
       <button data-dismiss="alert" class="close" type="button">×</button>
       Lo sentimos, no se pudo guardar ...
       </div> 
  <?php
  }     
}
}
?>