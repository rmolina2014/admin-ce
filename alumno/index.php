<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
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
                                    <form method="POST" role="form" action="editar.php">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button
                                            class="btn btn-sm btn-secondary d-inline-flex align-items-center">Editar</button>
                                        <!--a class="btn btn-sm btn-danger d-inline-flex align-items-center" href="eliminar.php?id=<?php echo $item['id_usuario']; ?>" >
                                              Borrar
                                            </a-->
                                    </form>

                                    <form method="POST" role="form" action="alumno_carrera_cuotas.php">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button
                                            class="btn btn-sm btn-secondary d-inline-flex align-items-center">Cuotas</button>
                                        <!--a class="btn btn-sm btn-danger d-inline-flex align-items-center" href="eliminar.php?id=<?php echo $item['id_usuario']; ?>" >
                                              Borrar
                                            </a-->
                                    </form>
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