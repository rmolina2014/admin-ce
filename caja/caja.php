<?php
include_once("../bd/conexion.php");
class Caja
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
    $consulta = "SELECT `id`,
    `importe_inicio`,
    `fecha_apertura`,
    `importe_cierre`,
    `fecha_cierre`,
    `estado`,
    `saldo`
                    FROM `caja` order by `fecha_apertura` desc ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function nuevo($importe_inicio,$fecha_apertura,$importe_cierre,$fecha_cierre,
  $estado,$saldo)
  {
    $sql = "INSERT INTO `caja`
    (`importe_inicio`,
     `fecha_apertura`,
     `importe_cierre`,
     `fecha_cierre`,
     `estado`,
     `saldo`)
VALUES (
'$importe_inicio',
'$fecha_apertura',
'$importe_cierre',
'$fecha_cierre',
'$estado',
'$saldo');";

//echo $sql;
//exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    $rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }


  public function cerrarcaja($caja_id, $cierre, $fechacierre, $estado, $saldo)
  {
    $sql = "UPDATE `caja`
              SET 
                `cierre` = '$cierre',
                `fechacierre` = '$fechacierre',
                `estado` = '$estado',
                `saldo` = '$saldo'
              WHERE `id` = '$caja_id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  //obtener cuantas cajas estan abiertas
  public function estadoCajas()
  {
    $consulta = "SELECT COUNT(id) as abiertas FROM caja WHERE estado='Abierta'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  //insertar detalle de apertura
  public function insertarDetalleApertura(
    $cajanueva_id,
    $operacion,
    $tipo,
    $monto,
    $fechahora,
    $detalle,
    $usuario_id
  ) {
    $sql = "INSERT INTO `caja`
            (`cajanueva_id`,
             `operacion`,
             `tipo`,
             `monto`,
             `fechahora`,
             `detalle`,
             `usuario_id`)
              VALUES ('$cajanueva_id',
                      '$operacion',
                      '$tipo',
                      '$monto',
                      '$fechahora',
                      '$detalle',
                      '$usuario_id');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  //10-7-2017 detalle de caja


  public function detalleCaja($id)
  {
    $consulta = " SELECT * FROM `caja` WHERE `cajanueva`.`id`=$id;";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public function listaDetalleCaja($cajanueva_id)
  {
    $consulta = "SELECT * FROM `caja` where caja_id=$cajanueva_id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }
}
