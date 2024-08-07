<?php
include_once("../bd/conexion.php");
class Egreso
{

  public function permiso(
      $id,
      $permiso  
    ) {
      $sql = "SELECT p.*, d.* FROM permiso p INNER JOIN detalle_permiso d ON p.id = d.rela_permiso WHERE d.rela_usuario = $id AND p.nombre = '$permiso'";
      $rs = mysqli_query(conexion::obtenerInstancia(), $sql);

      $existe = mysqli_num_rows($rs);

      // retornar 0 o un registro

      return $existe;
    }

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
    $egreso_tipo,
    $tipo_pago
  ) {
    $sql = "INSERT INTO `egreso`
    (`monto`,
     `fecha_egreso`,
     `caja_id`,
     `usuario_id`,
     `egreso_tipo`,
     `tipo_pago`)
      VALUES ('$monto',
      '$fecha_egreso',
      '$caja_id',
      '$usuario_id',
      '$egreso_tipo',
      '$tipo_pago'
      );";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }


    public function editar($egreso_id, $tipoegreso, $monto,$tipo_pago)
  {
    $sql = "UPDATE `egreso`
    SET 
      `egreso_tipo` = '$tipoegreso',
      `monto` = '$monto',
      `tipo_pago` = '$tipo_pago' 
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
