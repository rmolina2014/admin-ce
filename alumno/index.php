<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
//PERMISOS
$permiso = new Alumno();
$permisos = $permiso->permiso($ID,'ALUMNOS');
if ($permisos == 0 && $ID != 1) {
   $mensaje = "¡No tiene permisos para entrar a este modulo!";
    echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = '../panelcontrol/index.php';</script>";
    exit();
}
//FIN VALIDACION PERMISOS
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
                    <h3>Alumnos</h3>
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
                    <h4 class="card-title">Listado</h4>
                </div>
                <div class="card-body">
                    <!--- inico contenido -------------------------------------------------------------------------->
                    <div class="buttons">
                        <a href="nuevo.php" class="btn btn-outline-primary">Agregar</a>
                    </div>
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>Apellido Nombre</th>
                                <th>Curso</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item -->
                            <?php
                            $objeto = new Alumno();
                            $usuarios = $objeto->lista();
                            foreach ($usuarios as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['dni']; ?></td>
                                    <td><?php echo $item['apellidonombre']; ?></td>
                                    <td><?php echo $item['carrera']; ?></td>
                                    <td><?php echo $item['estado']; ?></td>
                                    <td>
                                        <div class="buttons" style="margin:0 auto">

                                            <form method="POST" role="form" action="editar.php" style="margin:0 auto">
                                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                <button class="btn btn-outline-primary">Editar</button>

                                            </form>

                                            <form method="POST" role="form" action="alumno_carrera_cuotas.php" style="margin:0 auto">
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
        <?php
        include("../pie.php");
        ?>