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
    $data = array();

    $consulta = "SELECT * FROM `caja` order by `fecha_apertura` desc ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function nuevo($fecha_apertura, $ingreso_total, $egreso_total, $fecha_cierre, $estado, $saldo)
  {
    $sql = "INSERT INTO `caja`
            (
             `fecha_apertura`,
             `ingreso_total`,
             `egreso_total`,
             `fecha_cierre`,
             `estado`,
             `saldo`)
VALUES (
        '$fecha_apertura',
        '$ingreso_total',
        '$egreso_total',
        '$fecha_cierre',
        '$estado',
        '$saldo');";

    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    $rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }


  public function cerrarcaja($id, $fecha_apertura, $ingreso_total, $egreso_total, $fecha_cierre, $estado, $saldo)
  {
    $sql = "UPDATE `caja`
            SET 
              `fecha_apertura` = '$fecha_apertura',
              `ingreso_total` = '$ingreso_total',
              `egreso_total` = '$egreso_total',
              `fecha_cierre` = '$fecha_cierre',
              `estado` = '$estado',
              `saldo` = '$saldo'
            WHERE `id` = '$id';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function actualizaringresocaja($id, $ingreso)
  {
    //$data=array();
    $consulta = "SELECT * FROM `caja` where id=$id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        
        $ingreso_total = $fila['ingreso_total'];
        $saldo_total = $fila['saldo'];
      }
    
    $ingreso_final = $ingreso_total + $ingreso;
    $saldo_final = $saldo_total + $ingreso;

    $sql = "UPDATE `caja`
            SET 
              `ingreso_total` = '$ingreso_final',
              `saldo` = '$saldo_final'
            WHERE `id` = '$id';";
    $result = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $result;

    }

  }

  public function actualizaregresocaja($id, $egreso)
  {
    //$data=array();
    $consulta = "SELECT * FROM `caja` where id=$id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        
        $egreso_total = $fila['egreso_total'];
        $saldo_total = $fila['saldo'];
      }
    
    $egreso_final = $egreso_total + $egreso;
    $saldo_final = $saldo_total - $egreso;

    $sql = "UPDATE `caja`
            SET 
              `egreso_total` = '$egreso_final',
              `saldo` = '$saldo_final'
            WHERE `id` = '$id';";
    $result = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $result;

    }
        

  }


  //obtener cuantas cajas estan abiertas
  public function cajasAbiertas()
  {
    $consulta = "SELECT COUNT(id) as abiertas FROM caja WHERE estado='Abierta'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data = $fila['abiertas'];
      }
    }
    return $data;
  }

  public function listaDetalleCaja($cajanueva_id)
  {
    $consulta = "SELECT * FROM `caja` where id=$cajanueva_id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // 11042024 detalle de la caja
  public function detalleCaja($caja_id)
  {
    $consulta = "SELECT
    *
    FROM
        `ingreso`
        INNER JOIN `caja` 
            ON (`ingreso`.`caja_id` = `caja`.`id`)
        INNER JOIN `ingreso_tipo` 
            ON (`ingreso`.`ingreso_tipo_id` = `ingreso_tipo`.`id`)
        INNER JOIN `egreso` 
            ON (`egreso`.`caja_id` = `caja`.`id`)
        INNER JOIN `egreso_tipo` 
            ON (`egreso`.`egreso_tipo` = `egreso_tipo`.`id`)
            WHERE `caja`.`id`=$caja_id
            ORDER BY ingreso.`fecha_ingreso`,egreso.`fecha_ingreso`  ASC;";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // listado de ingresos
  public function listadoIngresos($caja_id)
  {
    $consulta = "SELECT
    `id`,
    `monto`,
    `fecha_ingreso`,
    `caja_id`,
    `usuario_id`,
    `ingreso_tipo_id`,
    `alumno_id`,
    `tipo_pago`,
    `descuento`,
    `recargo`,
    `origen`,
    `detalle`
  FROM `ingreso`
  WHERE `caja_id`=$caja_id
  order by fecha_ingreso desc;";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // listado de ingresos
  public function listadoEgresos($caja_id)
  {
    $consulta = "SELECT
    egreso.`id` AS id,
egreso.`caja_id` AS caja_id,
egreso.`fecha_egreso` AS fecha_egreso,
egreso.`monto` AS monto,
egreso_tipo.`nombre` AS egreso_tipo
FROM
    `egreso`
    INNER JOIN `bdce`.`egreso_tipo` 
        ON (`egreso`.`egreso_tipo` = `egreso_tipo`.`id`)
  WHERE egreso.`caja_id` =$caja_id
  order by fecha_egreso Desc";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


}
