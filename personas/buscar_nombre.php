<?php
include ("persona.php");
$objeto = new persona();
if (isset ($_POST['nombre']) && !empty ($_POST['nombre']))
 {
  $nombre = $_POST['nombre'];
  $registros = $objeto->obtenerNombre($nombre);
  $data = array();
  $data['estado'] = 'error';
  $data['mensaje'] = 'No Existe esta persona';
  if ($registros)
  {
    foreach ($registros as $item)
    {
      $data['id_persona'] = $item['id'];
      $data['nombre'] = $item['apellidonombre'];
      $data['estado'] = 'ok';
    }
  } else {
    $data['estado'] = 'error';
    $data['mensaje'] = 'No Existe esta persona';
  }
  echo json_encode($data);
}
