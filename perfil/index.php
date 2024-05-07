<?php
 include("../cabecera.php");
 include("../menu.php");
 include("perfil.php");

 $objeto = new Perfil();
 if( isset($_POST['dni']) && !empty($_POST['dni']) )
 {
    $dni=(int)$_POST['dni'];
    $registros= $objeto->obtenerAlumnoCursos($dni);
   foreach($registros as $item)
   {
    $id_persona= $item['id'];
    $apellidonombre=$item['apellidonombre'];
    $dni=$item['dni'];
   }
if (empty($registros)){
   ?>      
       <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
       <button data-dismiss="alert" class="close" type="button">×</button>
       Sin Datos.............
       </div> 
  <?php
  echo "<script>alert('Con el DNI no encontre ningun alumno....');</script>";
  die();
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
                 <li class="breadcrumb-item active" aria-current="page">Alumno</li>
               </ol>
             </nav>
           </div>
         </div>
       </div>

<!--seccion cursos-->

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado de Cursos</h4>
                    <h5 class="card-title"><?php echo $item['apellidonombre']; ?></h5>
                    <h5 class="card-title"><?php echo $item['dni']; ?></h5>
                </div>
                <div class="card-body">
                    <!--- inico contenido -------------------------------------------------------------------------->
                    <!--div class="buttons">
                        <a href="nuevo.php" class="btn btn-outline-primary">Agregar</a>
                    </div-->
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <!--th>DNI</th>
                                <th>Apellido Nombre</th-->
                                <th>Curso</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item -->
                            <?php
                            $objeto = new Perfil();
                            $cursos= $objeto->obtenerAlumnoCursos($dni);
                            foreach ($cursos as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['carrera']; ?></td>
                                    <td><?php echo $item['estado']; ?></td>
                                    <td>
                                        <div class="buttons" style="margin:0 auto">

                                            <!--form method="POST" role="form" action="editar.php" style="margin:0 auto">
                                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                <button class="btn btn-outline-primary">Editar</button>

                                            </form-->

                                            <form method="POST" role="form" action="../alumno/alumno_carrera_cuotas.php" style="margin:0 auto">
                                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                <button class="btn btn-outline-primary">Cuotas</button>

                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--- fin contenido------------------------------------------------------- -->
                </div>
            </div>
        </section>


<!--fin seccion cursos-->



       <section class="section">
         <div class="card">
           <div class="card-header">
             <h4 class="card-title">Datos Personales</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

            
  <div class="col-md-8 mb-3">
    <label class="form-label">DNI</label>
    <input name="dni" disabled  class="form-control" type="text" tabindex="1" required value="<?php echo utf8_encode($item['dni']); ?>"/>
  </div>
  <input type="hidden" name="id_persona" value="<?php echo $item['id']; ?>">
  <div class="col-md-8 mb-3">
    <label class="form-label">Apellido y Nombre</label>
    <input name="apellido_nombre" disabled class="form-control" type="text" tabindex="2" required value="<?php echo utf8_encode($item['apellidonombre']); ?>"/>
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label" >Domicilio </label>
    <input name="domicilio" disabled  class="form-control" type="text" tabindex="3" required value="<?php echo utf8_encode($item['domicilio']); ?>"/>
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Celular Principal</label>
    <input name="cel_prin" disabled  class="form-control" type="text" tabindex="4"  value="<?php echo utf8_encode($item['cel1']); ?>" />
  </div>

  <div class="col-md-8 mb-3">
    <label class="form-label">Celular Alternativo</label>
    <input name="cel_alte" disabled class="form-control" type="text" tabindex="4"  value="<?php echo utf8_encode($item['cel2']); ?>" />
  </div>  

  <div class="col-md-8 mb-3">
    <label class="form-label">Mail</label>
    <input name="mail" disabled class="form-control" type="email" tabindex="4"  value="<?php echo utf8_encode($item['mail']); ?>" />
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