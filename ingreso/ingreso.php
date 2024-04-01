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
    $consulta = "SELECT
    `id`,
    `monto`,
    `fecha_ingreso`,
    `caja_id`,
    `usuario_id`,
    `tipo_ingreso`
    FROM `ingreso`";
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
    $tipo_ingreso
  ) {
    $sql = "INSERT INTO `ingreso`
    (`monto`,
     `fecha_ingreso`,
     `caja_id`,
     `usuario_id`,
     `tipo_ingreso`)
      VALUES ('$monto',
      '$fecha_ingreso',
      '$caja_id',
      '$usuario_id',
      '$tipo_ingreso'
      `);";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }
}
