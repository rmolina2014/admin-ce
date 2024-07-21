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
             <h3>Actualizacion de precios por %</h3>
             <!--p class="text-subtitle text-muted">The default layout.</p-->
           </div>
           <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Actualizar valores por Curso</li>
               </ol>
             </nav>
           </div>
         </div>
       </div>

       <section class="section">
         <div class="card">
           <div class="card-header">
             <h4 class="card-title">AVISO IMPORTANTE: Todas las cuotas IMPAGAS de los alumnos del curso se actualizaran</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
<form method="POST" role="form" action="actualizarprecios.php" id="updateForm">

  <input type="hidden" name="id_carrera" value="<?php echo $item['id']; ?>">
  <div class="col-md-8 mb-3">
    <label class="form-label">Nombre</label>
    <input name="nombre"  class="form-control" type="text" tabindex="2" disabled required value="<?php echo utf8_encode($item['nombre']); ?>" />
  </div>


  <div class="col-md-8 mb-3">
    <label class="form-label">Cantidad de cuotas</label>
    <input name="cantidadcuotas"  class="form-control" type="text" tabindex="2" disabled required value="<?php echo utf8_encode($item['cantidad_cuotas']); ?>" />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Costo total curso</label>
    <input name="costocarrera"  class="form-control" type="text" tabindex="2" disabled required value="<?php echo utf8_encode($item['costo_carrera']); ?>" />
  </div>  

  <div class="col-md-8 mb-3">
    <label class="form-label">Costo Inscripcion</label>
    <input name="costoinscripcion"  class="form-control" type="text" tabindex="2" disabled required value="<?php echo utf8_encode($item['inscripcion']); ?>" />
  </div>   

  <div class="col-md-8 mb-3">
    <label class="form-label">Detalle</label>
    <input name="detalles"  class="form-control" type="text" tabindex="2" disabled required value="<?php echo utf8_encode($item['detalles']); ?>" />
  </div>

 <div class="col-md-8 mb-3">
    <label class="form-label">Porcentaje de aumento*</label>
    <input name="porcentajeaumento" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="^\d*\.?\d*$"  class="form-control" type="text" tabindex="2" required value="" />
  </div>   

    
  <div class="col-md-8 mb-3">

    <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar
  
    </button>
    
    <button type="button" class="btn btn-sm btn-warning d-inline-flex align-items-center" onclick="confirmUpdate()">
       Actualizar precios
    </button>    
    <!--button type="submit" class="btn btn-sm btn-warning d-inline-flex align-items-center">
       Actualizar precios
    
    </button-->
  
  </div>
</form>


<script>
function confirmUpdate() {
    if (confirm("¿Está seguro de que desea actualizar los precios?")) {
        document.getElementById("updateForm").submit();
    }
}
</script>

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
$porcentajeaumento = $_POST['porcentajeaumento'];
$todobien = $objeto->actualizarprecios($id,$porcentajeaumento);
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
       Lo sentimos, no se pudo actualizar ...
       </div> 
  <?php
  }     
}
}
?>