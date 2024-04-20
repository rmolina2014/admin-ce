<?php
include("../cabecera.php");
include("../menu.php");
include("caja.php");
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
            <a href="nuevo.php" class="btn btn-outline-primary">Agregar</a>
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
                ?>
                  <tr>
                    <td>
                      <?php echo $item['id']; ?>
                    </td>
                    <td>
                      <?php echo $item['fecha_apertura']; ?>
                    </td>
                    <td>
                      <?php echo $item['ingreso_total']; ?>
                    </td>
                    <td>
                      <?php echo $item['egreso_total']; ?>
                    </td>
                    <td>
                      <?php echo $item['fecha_cierre']; ?>
                    </td>
                    
                    <td>
                      <?php echo $item['saldo']; ?>
                    </td>

                    <td>
                      <?php echo $item['estado']; ?>
                    </td>
                    
                    <td>
                    <a class="btn btn-primary btn-sm" href="detalle_caja.php?caja_id=<?php echo $item['id']; ?>">Detalle
                      de la Caja</a>
                      <?php
                      if ($item['estado'] == 'Abierta') {
                      ?>
                        <a class="btn btn-danger btn-sm" href="cerrarcaja.php?caja_id=<?php echo $item['id']; ?>">Cerrar
                          Caja</a>
                    </td>
                  <?php
                    } 
                  ?>
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