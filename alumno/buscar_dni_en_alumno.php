<?php
include ("alumno.php");
$objeto = new alumno();
if (isset ($_POST['dni']) && !empty ($_POST['dni']))
 {
  $dni = $_POST['dni'];
  $registros = $objeto->buscarDNIalumno($dni);
  $data = array();
  if ($registros)
  {
    foreach ($registros as $item)
    {
      $data['id_alumno'] = $item['id'];
      $data['nombre'] = $item['apellidonombre'];
      $data['estado'] = 'ok';
    }
  } else {
    $data['estado'] = 'error';
    $data['mensaje'] = 'No Existe este DNI como alumno';
  }
  echo json_encode($data);
}
