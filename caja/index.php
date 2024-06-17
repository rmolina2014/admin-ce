<?php
include("../sesion.php");
include("../cabecera.php");
include("../menu.php");
include("caja.php");
//PERMISOS
$permiso = new Caja();
$permisos = $permiso->permiso($ID,'CAJA');
if ($permisos == 0 && $ID != 1) {
   $mensaje = "¡No tiene permisos para entrar a este modulo!";
    echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = '../panelcontrol/index.php';</script>";
    exit();
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
          <h3>Cajas</h3>
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
          <h4 class="card-title">Listado de Cajas</h4>
        </div>
        <div class="card-body">
          <!--- inico contenido -------------------------------------------------------------------------->

          <div class="buttons">
            <!--a href="nuevo.php" class="btn btn-outline-primary">Agregar</a-->
          </div>

          <table class="table table-flush" id="datatable">
            <thead class="thead-light">
              <tr>
                <th>N°</th>
                <th>Fecha apertura</th>
                <th>Total Ingresos</th>
                <th>Total Egresos</th>
                <th>Fecha cierre</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th></th>
              </tr>
              <thead>
              <tbody>
                <?php
                $objeto = new Caja();
                $usuarios = $objeto->lista();
                foreach ($usuarios as $item) {
                  $totalcajaingreso = $objeto->totalesIngresoCaja($item['id']);
                  $totalcajaegreso = $objeto->totalesEgresoCaja($item['id']);

                  /*if (!is_int($totalcajaegreso)) {
                    $totalcajaegreso = 0;
                  }

                  if (!is_float($totalcajaingreso)) {
                    $totalcajaingreso = 0;
                  }*/

                  // $saldo = $totalesingresocaja['totalingresos'] - $totalesegresocaja['totalegresos'];
                  $saldo = $totalcajaingreso - $totalcajaegreso;
                  $saldo = number_format($saldo, 2, ',', '.');

                ?>
                  <tr>
                    <td>
                      <?php echo $item['id']; ?>
                    </td>
                    <td>
                      <?php echo $item['fecha_apertura']; ?>
                    </td>
                    <td>
                      <?php echo number_format($totalcajaingreso, 2, ',', '.'); ?>
                    </td>
                    <td>
                      <?php echo number_format($totalcajaegreso, 2, ',', '.'); ?>
                    </td>
                    <td>
                      <?php echo $item['fecha_cierre']; ?>
                    </td>

                    <td>
                      <?php echo $saldo; ?>
                    </td>

                    <td>
                      <?php echo $item['estado']; ?>
                    </td>
                    <td>
                      <form method="POST" role="form" action="detalle_caja_abierta.php">
                        <input type="hidden" name="caja_id" value="<?php echo $item['id']; ?>">
                        <input type="hidden" name="estado_caja" value="<?php echo $item['estado']; ?>">
                        <button class="btn btn-sm btn-secondary d-inline-flex align-items-center">Detalle
                          de la Caja</button>
                      </form>

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