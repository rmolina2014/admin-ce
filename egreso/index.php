<?php
include ("../cabecera.php");
include ("../menu.php");
include ("ingreso.php");
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
          <h3>Ingresos</h3>
          <!--p class="text-subtitle text-muted">The default layout.</p-->
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../panelcontrol/index.php">Panel de Control</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ingresos</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Listado de Ingresos</h4>
        </div>
        <div class="card-body">
          <!--- inico contenido -------------------------------------------------------------------------->

          <div class="buttons">
            <a href="nuevo.php" class="btn btn-outline-primary">Agregar</a>
          </div>

          <table class="table table-flush" id="datatable">
            <thead class="thead-light">
              <tr>
                <th>N°</th>
                <th>Fecha Ingreso</th>
                <th>Importe</th>
                <th>Detalle</th>
                <th>Caja</th>
                <th></th>
              </tr>
              <thead>
              <tbody>
                <?php
                $objeto = new Ingreso();
                $usuarios = $objeto->lista();
                foreach ($usuarios as $item) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $item['id']; ?>
                    </td>
                    <td>
                      <?php echo $item['fecha_ingreso']; ?>
                    </td>
                    <td>
                      <?php echo $item['monto']; ?>
                    </td>
                    <td>
                      <?php echo $item['detalle']; ?>
                    </td>
                    <td>
                      <?php echo $item['caja_id']; ?>
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
    include ("../pie.php");
    ?>