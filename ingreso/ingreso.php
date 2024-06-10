<?php
include_once("../bd/conexion.php");
class Ingreso
{
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

  public function lista()
  {
    $data = array();
    $consulta = "SELECT
    ingreso.`caja_id` AS caja_id,
    ingreso.`fecha_ingreso` AS fecha_ingreso,
    ingreso.`id` AS id,
    ingreso.`ingreso_tipo_id` AS ingreso_tipo_id,
    ingreso.`monto` AS monto,
    ingreso.`usuario_id` AS usuario_id,
    ingreso_tipo.`nombre` AS detalle
    FROM
        `ingreso`
        INNER JOIN `bdce`.`ingreso_tipo` 
            ON (`ingreso`.`ingreso_tipo_id` = `ingreso_tipo`.`id`);";
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
    $fecha_ingreso,
    $caja_id,
    $usuario_id,
    $ingreso_tipo_id
  ) {
    $sql = "INSERT INTO `ingreso`
    (`monto`,
     `fecha_ingreso`,
     `caja_id`,
     `usuario_id`,
     `ingreso_tipo_id`)
      VALUES ('$monto',
      '$fecha_ingreso',
      '$caja_id',
      '$usuario_id',
      '$ingreso_tipo_id'
      );";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }

  public function buscarCajaAbierta()
  {
    $data = array();
    $consulta = "SELECT
    `id`,
    `importe_inicio`,
    `fecha_apertura`,
    `importe_cierre`,
    `fecha_cierre`,
    `estado`,
    `saldo`
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
  public function listaIngresoTipo()
  {
    $sql = "SELECT * FROM ingreso_tipo order by nombre";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  //lista las materias
  public function listaCarrera()
  {
    $sql = "SELECT * FROM carrera";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function buscarDniCarrera($dni)
  {
    $data = array();
    $sql = "SELECT id,apellidonombre FROM persona WHERE dni ='$dni'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public function buscarCarreraCuotas($carrera_id)
  {
    $data = array();
    $sql = "SELECT * FROM cuota WHERE carrera_id ='$carrera_id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }
}
