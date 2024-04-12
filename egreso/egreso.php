<?php
include_once("../bd/conexion.php");
class Egreso
{


  public function obtenerId($id)
  {
    $data=array();
    $consulta = "SELECT * FROM egreso where id='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }

  public function obtenerUsuario($usuario)
  {
    $consulta = "SELECT * FROM usuario where usuario='$usuario'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }

  public function lista($cajaabierta)
  {

    $data=array();
    $consulta = "select e.*,et.nombre from egreso e,egreso_tipo et where e.caja_id='$cajaabierta' and e.egreso_tipo=et.id order by e.id desc";

    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public function nuevo(
    $monto,
    $fecha_egreso,
    $caja_id,
    $usuario_id,
    $egreso_tipo
  ) {
    $sql = "INSERT INTO `egreso`
    (`monto`,
     `fecha_egreso`,
     `caja_id`,
     `usuario_id`,
     `egreso_tipo`)
      VALUES ('$monto',
      '$fecha_egreso',
      '$caja_id',
      '$usuario_id',
      '$egreso_tipo'
      );";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }


    public function editar($egreso_id, $tipoegreso, $monto)
  {
    $sql = "UPDATE `egreso`
    SET 
      `egreso_tipo` = '$tipoegreso',
      `monto` = '$monto'
       WHERE `id` = '$egreso_id'";

    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }



  public function buscarCajaAbierta()
  {
    $data = array();
    $consulta = "SELECT
    *
  FROM `caja`
  where `estado`= 'Abierta';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        //$data[] = $fila;
        $id = $fila["id"];
      }
    }
    return $id;
  }

  //lista los ingresos por tipo
  public function listaEgresoTipo()
  {
    $sql = "SELECT * FROM egreso_tipo";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }
}
