<?php
include("../sesion.php"); 
include("../cabecera.php");
include("../menu.php");
include("ingreso.php");
include("../caja/caja.php");
  $objeto = new Ingreso();
  $caja = new Caja();

  if (isset($_POST['id']) && !empty($_POST['id']))
  {
    $id = (int)$_POST['id'];
    $registros = $objeto->obtenerIdconalumno($id);
    foreach ($registros as $item)
    {
      $ingreso_id = $item['id'];
      $caja_id = $item['caja_id'];
      $monto_original= $item['monto'];
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
             <h3>Ingreso</h3>
             <!--p class="text-subtitle text-muted">The default layout.</p-->
           </div>
           <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="../panelcontrol/index.html">Panel de Control</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Editar Ingreso</li>
               </ol>
             </nav>
           </div>
         </div>
       </div>

       <section class="section">
         <div class="card">
           <div class="card-header">
             <h4 class="card-title">Formulario Editar Ingreso</h4>
           </div>
           <div class="card-body">
             <!--- contenido -->

             <!---formulario-->
             <form method="POST" role="form" action="editar.php">
               <input type="hidden" name="ingreso_id" value= "<?php echo $ingreso_id; ?>" />
               <input type="hidden" name="caja_id" value= "<?php echo $caja_id; ?>" />
               <input type="hidden" name="monto_original" value= "<?php echo $monto_original; ?>" />               
               
               <div class="col-md-8 mb-3">
                 <label class="form-label">Tipo Ingreso</label>
                 <select class="form-control" name="ingreso_tipo_id" id="ingreso_tipo_id" required autofocus tabindex="1">
                   <option value="0">Seleccione....</option>
                   <?php
                    $ingresostipos = $objeto->listaIngresoTipo();
                    foreach ($ingresostipos as $ingresotipo) {
                      if ($ingresotipo['id'] == $item['ingreso_tipo_id'])
                      {
                      ?>
                       <option value="<?php echo $ingresotipo['id']; ?>" selected> <?php echo $ingresotipo['nombre']; ?> </option>
                      <?php
                      }else{
                      ?>

                     <option value="<?php echo $ingresotipo['id']; ?>"> <?php echo $ingresotipo['nombre']; ?> </option>
                     <?php
                     }
                      }
                    ?>
                 </select>
               </div>

                        <div class="col-md-8 mb-3">
                            <input name="id_alumno" id="id_alumno" value= "<?php echo $item['alumno_id']; ?>"  type="hidden"  />

                            <?php 
                            if ($item['alumno_id'] != 1)  
                              {
                            ?>          
                            <label id="labeldni">D.N.I </label>
                            <input name="dnialumno" id="dnialumno" value= "<?php echo $item['dni']; ?>" class="form-control" type="text" maxlength="10" required />
                            <br>
                            <?php
                             }else{
                             ?>  
                            <label id="labeldni" style="display: none;">D.N.I </label>
                            <input name="dnialumno" id="dnialumno" style="display: none;" value= "<?php echo $item['dni']; ?>" class="form-control" type="text" maxlength="10"  required />
                            <?php
                             }
                             ?>                                                               
                        </div>

                        <div class="col-md-8 mb-3">
                            <div id="resultadoBusqueda"></div>
                        </div>


               <div class="col-md-8 mb-3">
                 <label class="form-label">Monto</label>
                 <input name="monto" class="form-control" type="monto" onkeypress="return soloNumeros(event);" required value="<?php echo $item['monto']; ?>"  />
               </div>



              <div class="col-md-8 mb-3">
                <label>Forma de Pago :</label>
                    <select class="form-control" name="tipo_pago" id="tipo_pago" required>
                         <option value="">Seleccionar...</option>
                         <?php
                          if ($item['tipo_pago'] == 'EFECTIVO')
                            {
                            ?>
                             <option value="<?php echo $item['tipo_pago']; ?>" selected> Efectivo </option>
                             <option value="VIRTUAL" > Virtual </option>
                            <?php
                            }else{
                            ?>
                             <option value="EFECTIVO"> Efectivo </option>
                             <option value="<?php echo $item['tipo_pago']; ?>" selected> Virtual </option>
                           <?php
                           }
                            
                          ?>

                    </select>
              </div>               


               <div class="col-md-8 mb-3">
                 <button type="button" class="btn btn-sm btn-secondary d-inline-flex align-items-center" data-dismiss="modal" onclick="location.href='index.php';"> Cancelar
                 </button>
                 <button type="submit" id="guardar" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
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
      }
       include("../pie.php");
      } else {
        if (isset($_POST['ingreso_id']) && !empty($_POST['ingreso_id']))
        {
          
          $ingreso_id = $_POST['ingreso_id'];
          $tipoingreso = $_POST['ingreso_tipo_id'];
          $monto = $_POST['monto'];
          $id_alumno = $_POST['id_alumno'];
          $tipo_pago = $_POST['tipo_pago'];
          if ($_POST['id_alumno']==1){
            $origen="Socios";
          }else
          {
            $origen="Alumno";
          }
          $caja_id = $_POST['caja_id'];
          $monto_original = $_POST['monto_original'];


          $todobien = $objeto->editar($ingreso_id, $tipoingreso, $monto,$id_alumno,$tipo_pago,$origen);
          if ($todobien) {
            $monto_actualizado =  $monto - $monto_original;
            $todobien = $caja->actualizaringresocaja($caja_id, $monto_actualizado );             
            echo "<script language=Javascript> location.href=\"index.php\"; </script>";
            //header('Location: listado.php');
            exit;
          } else {
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

        <script src="../assets/js/jquery-3.6.3.min.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                   
                   $("#ingreso_tipo_id").on("click", function() {
                   const opcionSeleccionada = $(this).find("option:selected");
                   
                   if (opcionSeleccionada.val()==1){
                        $("#dnialumno").val(999);
                        document.getElementById("dnialumno").style.display = "none";
                        document.getElementById("labeldni").style.display = "none";
                        $("#resultadoBusqueda").html(
                                "<h6 class='text-muted mb-0'> "   + " </h6>");
                        document.getElementById("guardar").disabled = false;
                        $("#id_alumno").val(1);


                        
                   }else{
                       document.getElementById("dnialumno").style.display = "block";
                       document.getElementById("labeldni").style.display = "block";
                       document.getElementById("guardar").disabled = true;
                       $("#id_alumno").val(0);
                       $("#dnialumno").val("");
                   }

                   //console.log("Valor de la opción seleccionada:", opcionSeleccionada.val());
                   //console.log("Texto de la opción seleccionada:", opcionSeleccionada.text());
                   });

            // buscar por dni 09/08/2018
            $("#dnialumno").blur(function() {
                var vdni = $("#dnialumno").val();
                $.ajax({
                    url: "../alumno/buscar_dni_en_alumno.php",
                    type: "POST",
                    data: {
                        dni: vdni
                    },
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        console.log(jsonData);
                        //alert(jsonData.estado);
                        if (jsonData.estado == "ok") {
                            $("#resultadoBusqueda").html(
                                "<h6 class='text-muted mb-0'> Alumno : " + jsonData
                                .nombre + ". </h6>");
                            $("#id_alumno").val(jsonData.id_alumno);
                            document.getElementById("guardar").disabled = false;
                        } else {
                            $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'>" +
                                jsonData.mensaje + "</h6>");
                            $("#id_alumno").val(0);
                            document.getElementById("guardar").disabled = true;
                        }

                    },
                    failure: function(data) {
                        alert(response);
                    },
                    error: function(data) {
                        alert(response);
                    }
                });
            });
        }) //fin jquery      
        </script>       