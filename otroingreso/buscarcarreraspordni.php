<?php
include ("ingreso.php");
$objeto = new Ingreso();
if (isset ($_POST['dni']) && !empty ($_POST['dni']))
 {
  $dni = $_POST['dni'];
  $registros = $objeto->listaCarrerapordni($dni);
  $data = array();
  if ($registros)
  {
    foreach ($registros as $item)
    {
      $data[] = array(
            'id' => $item['id'],
            'nombre' => $item['nombre']
        );
    }
  } else {
    $data['estado'] = 'error';
    $data['mensaje'] = 'No Existe este DNI como alumno';
  }
  echo json_encode($data);
}
