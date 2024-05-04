<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $objeto = new Alumno();
    $alumno_id = (int)$_POST['id'];
    //buscar los datos del alumno
    $datos_alumno = $objeto->obtenerId($alumno_id);
    foreach ($datos_alumno as $item) {
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $dni = $item['dni'];
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $objeto = new Alumno();
    $alumno_id = (int)$_GET['id'];
    //buscar los datos del alumno
    $datos_alumno = $objeto->obtenerId($alumno_id);
    foreach ($datos_alumno as $item) {
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $dni = $item['dni'];
    }
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
                    <h4 class="font-bold">Alumno : <?php echo $apellidonombre; ?> DNI :
                        <?php echo $dni; ?></h4>

                    <!--p class="text-subtitle text-muted">The default layout.</p-->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><?php echo "Usuario : " . $USUARIO; ?></li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="ms-3 name">
                        <h5 class="text-muted mb-0">Curso : <?php echo $carrera; ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Detalle</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item -->
                            <?php
                            $unosolo = True;
                            $usuarios = $objeto->listaAlumnoCarreraCuota($alumno_id);
                            foreach ($usuarios as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['detalle']; ?></td>
                                    <td><?php echo $item['monto']; ?></td>
                                    <td><?php echo $item['estado']; ?></td>
                                    <td>
                                        <?php
                                        if ($item['estado'] == "IMPAGA" and $unosolo) {
                                            $unosolo = False;
                                        ?>
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pago-total<?php echo $item['id']; ?>">
                                                Pago Total
                                            </a>
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pago-parcial<?php echo $item['id']; ?>">
                                                Pago Parcial
                                            </a>
                                        <?php
                                        }
                                        ?>

                                        <!--Modal - PAGO TOTAL Modal -->
                                        <div class="modal fade text-left modal-borderless" id="pago-total<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Pagar Cuota Total</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!-- formulario post--->
                                                        <form id="form" method="post" action="pagar_cuota.php">
                                                            <input type="hidden" name="cuota_id" value="<?php echo $item['id']; ?>">
                                                            <input type="hidden" name="alumno_id" value="<?php echo $item['alumno_id']; ?>">
                                                            <div class="form-group">
                                                                <label>Detalle :</label>
                                                                <input class="form-control" type="text" value="<?php echo $item['detalle']; ?>" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Importe : $</label>
                                                                <input class="form-control" id="monto" type="number" value="<?php echo $item['monto']; ?>" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Forma de Pago :</label>
                                                                <select class="form-control" onchange="getval(this,<?php echo $item['id']; ?>);" id="tipo_pago<?php echo $item['id']; ?>" name="tipo_pago" required>
                                                                    <option value="">Seleccionar...</option>
                                                                    <option value="EFECTIVO">Efectivo</option>
                                                                    <option value="VIRTUAL">Virtual</option>
                                                                </select>
                                                                
                                                            </div>

                                                            <div id="descuento_efectivo<?php echo $item['id']; ?>">
                                                                    
                                                                </div>



                                                            <div class="form-group">
                                                                <label>Descuento Pago antes del dia 10 : $</label>
                                                                <input class="form-control" id="descuento" name="descuento" type="number" />

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Recargo : $</label>
                                                                <input class="form-control" name="recargo" type="number" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>A pagar : $</label>
                                                                <input class="form-control" name="a_pagar" id="apagar" type="number" />
                                                            </div>




                                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Cancelar</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Pagar</span>
                                                            </button>
                                                        </form>
                                                        <!-- fin formulario--->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                </div>
            </div>
            <!-- fin modal-->
            <!--Modal - PAGO PARCIAL Modal -->
            <div class="modal fade text-left modal-borderless" id="pago-parcial<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pagar Cuota Parcial</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">

                            <!-- formulario post--->
                            <form id="form" method="post" action="pagar_cuota.php">
                                <div class="form-group">
                                    <label>Detalle :</label>
                                    <input class="form-control" type="text" value="<?php echo $item['detalle']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Importe : $</label>
                                    <input class="form-control" type="number" name="monto_pago_parcial" />
                                    <input type="hidden" name="cuota_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="alumno_id" value="<?php echo $item['alumno_id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Forma de Pago :</label>
                                    <select class="form-control" name="tipo_pago2" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="EFECTIVO">Efectivo</option>
                                        <option value="VIRTUAL">Virtual</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Descuento : $</label>
                                    <input class="form-control" name="descuento" type="number" />
                                </div>

                                <div class="form-group">
                                    <label>Recargo : $</label>
                                    <input class="form-control" name="recargo" type="number" />
                                </div>

                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Cancelar</span>
                                </button>

                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Pagar</span>
                                </button>
                            </form>
                            <!-- fin formulario--->
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
    </div>
</div>
<!-- fin modal-->

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

<?php
include("../pie.php");
?>
<script src="../assets/js/jquery-3.6.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   

  
});// fin ready

function getval(sel,id)
{
    alert(sel.value);
    $("#descuento_efectivo"+id).html("<span class='red'> -10</span>");

}

  </script>