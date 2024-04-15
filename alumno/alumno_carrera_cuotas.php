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

                                        <a class="btn btn-sm btn-secondary d-inline-flex align-items-center" id="pagar<?php echo $item['id']; ?>"> Pagar</a>

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

                $("a[id^='pagar']").click(function(evento) {
                    evento.preventDefault();
                    vid = this.id.substr(5, 4);
                    alert(vid);
                    /* 14-04-2024 continuar desde aca
                     $.ajax({
                         type: "POST",
                         cache: false,
                         async: false,
                         url: 'pagar_cuota.php',
                         data: {
                             id: vid
                         },
                         success: function(data) {
                             if (data) {
                                 alert(data);
                                 location.reload(true);
                             }
                         }
                     }) //fin ajax */


                })

            })
        </script>