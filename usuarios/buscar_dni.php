<?php
include("../cabecera.php");
include("../menu.php");
include("usuario.php");

$objeto = new usuario();

if (isset($_POST['dni']) && !empty($_POST['dni'])) {
  $dni = $_POST['dni'];

  $registros = $objeto->buscarDNI($dni);

  if ($registros) {
    foreach ($registros as $item) {
      $id_cliente = $item['id'];
      $nombre = $item['apellidonombre'];

      ?>

      <form class="form-horizontal" role="form">
        <input type="hidden" name="id_cliente" value="<? echo $id_cliente; ?>" />
        <div class="col-md-4">
          <label>Nombre :
            <?php echo $item['nombre']; ?>
          </label>
        </div>

        <?php $id_persona = $item['id']; ?>

      </form>
      <?php
    }
  } else {
    ?>
    <br>
    <p>No existe DNI.
      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"> Agregar Persona </a>
    </p>
    <br>
    <?php
  }
}