<?php
include_once("../bd/conexion.php");
class Egreso
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
    $consulta = "select * from egreso e,egreso_tipo et where e.egreso_tipo=et.id ";
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
