<?php
 include("../cabecera.php");
 include("../menu.php");
 include("perfil.php");

 $objeto = new Perfil();
 if( isset($_POST['dni']) && !empty($_POST['dni']) )
 {
    $dni=(int)$_POST['dni'];
    $registros= $objeto->obtenerPersona($dni);
   foreach($registros as $item)
   {
    $id_persona= $item['id'];
    $apellidonombre=$item['apellidonombre'];
    $dni=$item['dni'];
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
             <h3>Perfil</h3>
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
             <h4 class="card-title">Datos Personales</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

            
  <div class="col-md-8 mb-3">
    <label class="form-label">DNI</label>
    <input name="dni"  class="form-control" type="text" tabindex="1" required value="<?php echo utf8_encode($item['dni']); ?>"/>
  </div>
  <input type="hidden" name="id_persona" value="<?php echo $item['id']; ?>">
  <div class="col-md-8 mb-3">
    <label class="form-label">Apellido y Nombre</label>
    <input name="apellido_nombre"  class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['apellidonombre']); ?>"/>
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
   
  

<!--- fin -->
             <!--- fin contenido -->
             </div>
         </div>
       </section>
       <?php
        include("../pie.php");
        
}else
{

 ?>      
       <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
       <button data-dismiss="alert" class="close" type="button">×</button>
       Sin Datos.............
       </div> 
  <?php
  }     

?>