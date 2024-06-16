<?php
include_once("../bd/conexion.php");
class Caja
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

  public static function busarCajaAbierta()
  {
    $data[] = 0;
    $sql = "SELECT * FROM caja where estado='Abierta'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public static function totalesIngresoCaja($idcaja)
  {
    $totalIngresos = 0;

    $sql = "SELECT
    sum(ingreso.monto) as totalingresos
    FROM
        `ingreso`
            WHERE `ingreso`.`caja_id`='$idcaja'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);

    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $totalIngresos += $fila['totalingresos']; // Add the income amount to the total
      }
    }

    return $totalIngresos;
  }

  public static function totalesEgresoCaja($idcaja)
  {
    $totalEgreso = 0;
    $sql = "SELECT
    sum(egreso.monto) as totalegreso
    FROM
        `egreso`
            WHERE `egreso`.`caja_id`='$idcaja'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);

    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $totalEgreso += $fila['totalegreso']; // Add the income amount to the total
      }
    }

    return $totalEgreso;
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


  public function abrircaja($fecha_apertura, $ingreso_total, $egreso_total, $fecha_cierre, $estado, $saldo)
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

  // 26052024 cerrar caja y hacer los depositos  
  public function cerrarcaja(
    $id,
    $fecha_cierre,
    $estado,
    $saldo_efectivo,
    $saldo_virtual,
    $dep_caja_fuerte,
    $dep_banco,
    $dep_mp,
    $dep_proxima_caja
  ) {
    $sql = "UPDATE `caja`
    SET 
      `fecha_cierre` = '$fecha_cierre',
      `estado` = '$estado',
      `saldo_efectivo` = '$saldo_efectivo',
      `saldo_virtual` = '$saldo_virtual',
      `dep_caja_fuerte` = '$dep_caja_fuerte',
      `dep_banco` = '$dep_banco',
      `dep_mp` = '$dep_mp',
      `dep_proxima_caja` = '$dep_proxima_caja'
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
    $data = [];
    $consulta = "SELECT
    ingreso.id,
    ingreso.monto,
    ingreso.fecha_ingreso,
    ingreso.caja_id,
    ingreso.usuario_id,
    ingreso.ingreso_tipo_id,
    ingreso.alumno_id,
    ingreso.tipo_pago,
    ingreso.descuento,
    ingreso.recargo,
    ingreso.origen,
    ingreso.detalle,
    persona.apellidonombre,
    ingreso_tipo.nombre as tipo_de_ingreso
  FROM `ingreso`,`persona`,`alumno`,`ingreso_tipo`
  WHERE `caja_id`=$caja_id and ingreso.alumno_id=alumno.id and alumno.persona_id=persona.id and ingreso.ingreso_tipo_id=ingreso_tipo.id 
  order by ingreso.id desc;";

    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // listado de egresos
  public function listadoEgresos($caja_id)
  {
    $data = [];
    $consulta = "SELECT
    egreso.`id` AS id,
egreso.`caja_id` AS caja_id,
egreso.`fecha_egreso` AS fecha_egreso,
egreso.`monto` AS monto,
egreso_tipo.`nombre` AS egreso_tipo
FROM
    `egreso`
    INNER JOIN `egreso_tipo` 
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


  public function totalIngresos($caja_id)
  {
    $consulta = "SELECT sum(monto) as totalingresos 
  FROM `ingreso`
  WHERE `caja_id`=$caja_id;";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function totalEgresos($caja_id)
  {
    $consulta = "SELECT sum(monto) as totalegresos
FROM
    `egreso`
    WHERE egreso.`caja_id` =$caja_id
  ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // 09062024 insertar ingreso inicial de caja
  public function insertar_ingreso(
    $monto,
    $fecha_ingreso,
    $caja_id,
    $usuario_id,
    $ingreso_tipo_id,
    $alumno_id,
    $detalle,
    $tipo_pago,
    $origen
  ) {
    $sql = "INSERT INTO `ingreso`
    (`monto`,
     `fecha_ingreso`,
     `caja_id`,
     `usuario_id`,
     `ingreso_tipo_id`,
     `alumno_id`,
     `detalle`,
     `tipo_pago`,
     `origen`
     )
      VALUES ('$monto',
      '$fecha_ingreso',
      '$caja_id',
      '$usuario_id',
      '$ingreso_tipo_id',
      '$alumno_id',
      '$detalle',
      '$tipo_pago',
      '$origen'
      );";
    //echo $sql;
    //exit;
    $rs = mysqli_query(
      conexion::obtenerInstancia(),
      $sql
    );
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }
}
