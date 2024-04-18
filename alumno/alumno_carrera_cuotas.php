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
                            <li class="breadcrumb-item"><a href="../panelcontrol/index.php">Panel de Control</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="ms-3 name">
                        <h5 class="text-muted mb-0">Carrera : <?php echo $carrera; ?></h5>
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
                            $usuarios = $objeto->listaAlumnoCarreraCuota($alumno_id);
                            foreach ($usuarios as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['detalle']; ?></td>
                                    <td><?php echo $item['monto']; ?></td>
                                    <td><?php echo $item['estado']; ?></td>
                                    <td>

                                        <?php
                                        if ($item['estado'] == "IMPAGA") {
                                        ?>
                                            <a id="pagar<?php echo $item['id']; ?>" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#border-less<?php echo $item['id']; ?>" data-monto="<?php echo $item['monto']; ?>" data-detalle="<?php echo $item['detalle']; ?>">
                                                Pagar
                                            </a>

                                        <?php
                                        }

                                        ?>
                                        <!---modal--->
                                        <!--BorderLess Modal Modal -->
                                        <div class="modal fade text-left modal-borderless" id="border-less<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Pagar Cuota</h5>
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
                                                                <input class="form-control" type="number" value="<?php echo $item['monto']; ?>" />
                                                                <input type="hidden" name="cuota_id" value="<?php echo $item['id']; ?>">
                                                            </div>


                                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Cancelar</span>
                                                            </button>

                                                            <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal">
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
<script src="../assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("a[id^='pagar888']").click(function(evento) {
            evento.preventDefault();
            let cuota_id = this.id.substr(5, 4);
            let monto = $(this).data('monto');
            let detalle = $(this).data('detalle');

            // $("#apagar").append('<h3><span class="badge badge-secondary">Saldo: $'+monto+'</span></h3>');
            //$("#monto").html(monto);
            $("#apagar").html("<h5>Detalle : " + detalle + " Monto : $ " + monto + "</h5>");
            $("#cuotaApagar").val(cuota_id);

        })

        $("#aceptarpago").click(function() {
            let cuotaId = $("#cuotaApagar").val();
            alert(cuotaId);
            /*    
            $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: 'pagar_cuota.php',
                 data: {
                     cuota_id: cuotaId
                 },
                 success: function(data) {
                     if (data) {
                         //alert(data);
                         location.reload(true);
                     }
                 }
             }) //fin ajax */
        });

    })
</script>