<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("alumno.php");

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $objeto = new Alumno();
    $alumno_id = (int)$_POST['id'];
    $datos_alumno = $objeto->obtenerId($alumno_id);
    foreach ($datos_alumno as $item) {
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $dni = $item['dni'];
    }
} elseif (isset($_GET['id']) && !empty($_GET['id'])) {
    $objeto = new Alumno();
    $alumno_id = (int)$_GET['id'];
    $datos_alumno = $objeto->obtenerId($alumno_id);
    foreach ($datos_alumno as $item) {
        $apellidonombre = $item['apellidonombre'];
        $carrera = $item['carrera'];
        $dni = $item['dni'];
    }
} else {
    // Redirigir si no hay ID de alumno
    header("Location: lista_alumnos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuotas del Alumno</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="main" class="container mt-4">
        <header class="mb-3">
            <h1>Sistema de Gestión de Cuotas</h1>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h2>Alumno: <?php echo htmlspecialchars($apellidonombre); ?></h2>
                        <p>DNI: <?php echo htmlspecialchars($dni); ?></p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><?php echo "Usuario: " . htmlspecialchars($USUARIO); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Mostrar mensajes de éxito o error
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Curso: <?php echo htmlspecialchars($carrera); ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Detalle</th>
                                <th>Vencimiento</th>
                                <th>Monto</th>
                                <th>Saldo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usuarios = $objeto->listaAlumnoCarreraCuota($alumno_id);
                            $primera_cuota_impaga = true;
                            foreach ($usuarios as $item) {
                                $saldo_cuota = $objeto->saldoCuotaAlumno($item['id']);
                                $saldo = $saldo_cuota[0]['saldo'] ?? $item['monto'];
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['detalle']); ?></td>
                                    <td><?php 
                                        $fecha_venc = new DateTime($item['fecha_vencimiento']);
                                        echo $fecha_venc->format('d/m/Y');
                                    ?></td>
                                    <td>$<?php echo number_format($item['monto'], 2); ?></td>
                                    <td>$<?php echo number_format($saldo, 2); ?></td>
                                    <td><?php echo htmlspecialchars($item['estado']); ?></td>
                                    <td>
                                        <?php if ($item['estado'] == "IMPAGA" && $primera_cuota_impaga): ?>
                                            <form action="pago_total.php" method="POST" class="d-inline">
                                                <input type="hidden" name="cuota_id" value="<?php echo $item['id']; ?>">
                                                <button class="btn btn-primary btn-sm" type="submit">Pago Total/Parcial</button>
                                            </form>
                                            <?php $primera_cuota_impaga = false; ?>
                                        <?php endif; ?>

                                        <?php if ($item['estado'] == "IMPAGA" && $saldo == $item['monto']): ?>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editar-cuota<?php echo $item['id']; ?>">
                                                Editar Cuota
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Modal para editar cuota -->
                                <div class="modal fade" id="editar-cuota<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="editarCuotaLabel<?php echo $item['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editarCuotaLabel<?php echo $item['id']; ?>">Editar Cuota</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="editar_cuota.php" method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="cuota_id" value="<?php echo $item['id']; ?>">
                                                    <input type="hidden" name="alumno_id" value="<?php echo $alumno_id; ?>">
                                                    <div class="mb-3">
                                                        <label for="nuevo_monto<?php echo $item['id']; ?>" class="form-label">Nuevo Monto ($)</label>
                                                        <input type="number" step="0.01" class="form-control" id="nuevo_monto<?php echo $item['id']; ?>" name="nuevo_monto" value="<?php echo $item['monto']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Incluir Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>