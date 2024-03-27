<?php
include ("usuario.php");
$objeto = new usuario();
if (isset ($_POST['dni']) && !empty ($_POST['dni']))
 {
  $dni = $_POST['dni'];
  //verifico que exista el dni como persona
  $datapersona = array();
  $registropersona = $objeto->buscarDNI($dni);
  if ($registropersona){
        //obtengo el id de la persona
          foreach ($registropersona as $itempersona)
          {
            $datapersona['id_persona'] = $itempersona['id'];
            $datapersona['apellidonombre'] = $itempersona['apellidonombre'];
            
          }

        $registros = $objeto->buscarDNIenusuario($dni);
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
          $data['id_persona'] = $datapersona['id_persona'];
          $data['nombre'] = $datapersona['apellidonombre'];
          $data['estado'] = 'error';
          $data['mensaje'] = $datapersona['apellidonombre'] . '. Puede agregarlo como Usuario';
        }
  }else{
          $data['estado'] = 'errorpersona';
          $data['mensaje'] = 'No Existe como persona. Debe crearlo primero como Persona';

       }

  echo json_encode($data);
}
