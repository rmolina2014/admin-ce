<?php
 include("../cabecera.php");
 include("../menu.php");
 include("carrera.php");

 $objeto = new Carrera();
 if( isset($_POST['id']) && !empty($_POST['id']) )
 {
    $id=(int)$_POST['id'];
    $registros= $objeto->obtenerCarrera($id);
   foreach($registros as $item)
   {
    $id_carrera= $item['id'];
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
             <h3>Curso</h3>
             <!--p class="text-subtitle text-muted">The default layout.</p-->
           </div>
           <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Cursos</li>
               </ol>
             </nav>
           </div>
         </div>
       </div>

       <section class="section">
         <div class="card">
           <div class="card-header">
             <h4 class="card-title">Editar Cursos</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
<form method="POST" role="form" action="editar.php">

  <input type="hidden" name="id_carrera" value="<?php echo $item['id']; ?>">
  <div class="col-md-8 mb-3">
    <label class="form-label">Nombre*</label>
    <input name="nombre"  class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['nombre']); ?>" />
  </div>


  <div class="col-md-8 mb-3">
    <label class="form-label">Cantidad de cuotas*</label>
    <input name="cantidadcuotas" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="^\d*\.?\d*$" class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['cantidad_cuotas']); ?>" />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Costo total curso*</label>
    <input name="costocarrera" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="^\d*\.?\d*$"  class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['costo_carrera']); ?>" />
  </div>  

  <div class="col-md-8 mb-3">
    <label class="form-label">Costo Inscripcion*</label>
    <input name="costoinscripcion" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  pattern="^\d*\.?\d*$" class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['inscripcion']); ?>" />
  </div>   

  <div class="col-md-8 mb-3">
    <label class="form-label">Detalle*</label>
    <input name="detalles"  class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['detalles']); ?>" />
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
if (isset($_POST['id_carrera']) && !empty($_POST['id_carrera']))
{

$id = $_POST['id_carrera'];
$nombre=$_POST['nombre'];
$cantidadcuotas=$_POST['cantidadcuotas'];
$costocurso=$_POST['costocarrera'];
$costoinscripcion=$_POST['costoinscripcion'];
$detalles=$_POST['detalles'];
$todobien = $objeto->editar($id,$nombre,$cantidadcuotas,$costocurso,$costoinscripcion,$detalles);
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