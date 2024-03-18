<?php
include ("persona.php");
$objeto = new persona();
if (isset ($_POST['dni']) && !empty ($_POST['dni']))
 {
  $dni = $_POST['dni'];
  $registros = $objeto->buscarDNI($dni);
  $data = array();
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
    $data['mensaje'] = 'No Existe este DNI';
  }
  echo json_encode($data);
}
