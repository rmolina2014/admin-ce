<?php
//session_start();
include("../cabecera.php");
include("../menu.php");
include("persona.php");
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
                    <h3>Personas</h3>
                    <!--p class="text-subtitle text-muted">The default layout.</p-->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../panelcontrol/index.php">Panel de Control</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personas</li>
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
                                <th>Apellido Nombre</th>
                                <th>DNI</th>
                                <th>Domicilio</th>
                                <th>Celular Pri.</th>
                                <th>Celular Alt.</th>
                                <th>Mail</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item -->
                            <?php
                            $objeto = new Persona();
                            $usuarios = $objeto->lista();
                            foreach ($usuarios as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['apellidonombre']; ?></td>
                                    <td><?php echo $item['dni']; ?></td>
                                    <td><?php echo $item['domicilio']; ?></td>
                                    <td><?php echo $item['cel1']; ?></td>
                                    <td><?php echo $item['cel2']; ?></td>
                                    <td><?php echo $item['mail']; ?></td>
                                    <td>
                                        <form method="POST" role="form" action="editar.php">
                                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                            <button class="btn btn-sm btn-secondary d-inline-flex align-items-center">Editar</button>
                                           
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