<?php
include_once("../bd/conexion.php");
// da error include("../sesion.php");
class Alumno
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
    persona.`apellidonombre` AS apellidonombre,
    persona.`dni` AS dni,
    alumno.`edad` AS edad,
    alumno.`estado` AS estado,
    carrera.`nombre` AS carrera,
    alumno.`id` AS id
    FROM
        `alumno` 
        INNER JOIN `carrera` 
            ON (`alumno`.`carrera_id` = `carrera`.`id`)
        INNER JOIN `persona` 
            ON (`alumno`.`persona_id` = `persona`.`id` and `persona`.`id`>1 );";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public function nuevo(
    $edad,
    $gruposanguineo,
    $persona_id,
    $carrera_id,
    $estado,
    $observacion,
    $fecha_ingreso
  ) {
    $sql = "INSERT INTO `alumno`
    (
     `edad`,
     `gruposanguineo`,
     `persona_id`,
     `carrera_id`,
     `estado`,
     `observacion`,
     `fecha_ingreso`)
      VALUES (
      '$edad',
      '$gruposanguineo',
      '$persona_id',
      '$carrera_id',
      '$estado',
      '$observacion',
      '$fecha_ingreso');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);

    $alumno_id = mysqli_insert_id(conexion::obtenerInstancia());

    // retornar el id del alumno

    return $alumno_id;
  }

  //lista los ingresos por tipo
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

  public function editar($id, $edad, $gruposanguineo, $carrera_id, $estado)
  {
    $sql = "UPDATE `alumno`
    SET 
      `edad` = '$edad',
      `gruposanguineo` = '$gruposanguineo',
      `carrera_id` = '$carrera_id',
      `estado` = '$estado'
       WHERE `id` = '$id'";

    //echo $sql;
    //exit;   
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function obtenerId($id)
  {
    $sql = "SELECT
    persona.`apellidonombre` AS apellidonombre,
    persona.`dni` AS dni,
    alumno.`edad` AS edad,
    alumno.`gruposanguineo` AS gruposanguineo,
    alumno.`estado` AS estado,
    carrera.`nombre` AS carrera,
    carrera.`id` AS carrera_id,
    alumno.`id` AS alumno_id
    FROM
        `alumno`
        INNER JOIN `carrera` 
            ON (`alumno`.`carrera_id` = `carrera`.`id`)
        INNER JOIN `persona` 
            ON (`alumno`.`persona_id` = `persona`.`id`)
            where alumno.`id`='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public function eliminar($id)
  {
    $sql = "DELETE FROM usuario WHERE id ='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  //27-07-2018 devuelve si esta repetido un dni
  public function buscarDNI($dni)
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


  public function buscarDNIalumno($dni)
  {
    $data = array();
    $sql = "SELECT a.id,p.apellidonombre FROM persona p,alumno a WHERE p.dni ='$dni' and p.id=a.persona_id  ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  //verifica si el dni de la persona esta creado como usuario
  public function buscarDNIenusuario($dni)
  {
    $data = array();
    $sql = "SELECT persona.id,apellidonombre FROM persona,usuario WHERE dni ='$dni' and persona.id=usuario.rela_persona  ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // cantidaCuotasCarrera
  public function cuotasCostoCarrera($carrera_id)
  {
    $data = array();
    $sql = "SELECT cantidad_cuotas,costo_carrera,inscripcion FROM carrera WHERE id ='$carrera_id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        //$data = $fila['cantidad_cuotas'];
        $data[] = $fila;
      }
    }
    return $data;
  }

  // insertar en alumno_carrra_cuota
  public function insertar_cuotas_alumno(
    $alumno_id,
    $carrera_id,
    $cuota_numero,
    $monto,
    $estado,
    $fecha_vencimiento,
    $detalle
  ) {
    $sql = "INSERT INTO `alumno_carrera_cuotas`
    (
     `alumno_id`,
     `carrera_id`,
     `cuota_numero`,
     `monto`,
     `estado`,
     `fecha_vencimiento`,
     `detalle`)
      VALUES (
      '$alumno_id',
      '$carrera_id',
      '$cuota_numero',
      '$monto',
      '$estado',
      '$fecha_vencimiento',
      '$detalle'); ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);

    return $rs;
  }

  public function listaAlumnoCarreraCuota($alumno_id)
  {
    $data = array();
    $consulta = "SELECT
        `id`,
        `alumno_id`,
        `carrera_id`,
        `cuota_numero`,
        `monto`,
        `estado`,
        `fecha_vencimiento`,
        `fecha_pago`,
        `detalle`
      FROM `alumno_carrera_cuotas`
      where `alumno_id`=$alumno_id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  //consultar saldo de una cuota de alumno

  public function saldoCuotaAlumno($id_cuota)
  {
    $data = array();
    $consulta = "SELECT c.id, c.detalle, c.monto, COALESCE(SUM(p.descuento_a10)+SUM(p.descuento_tp)+SUM(p.pago), 0) AS total_pagado,
       (c.monto - COALESCE(SUM(p.descuento_a10)+SUM(p.descuento_tp)+SUM(p.pago), 0)) AS saldo
FROM alumno_carrera_cuotas c
LEFT JOIN pagos_parciales p ON c.id = p.rela_cuota
WHERE c.id = $id_cuota GROUP BY c.id;";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  // pagar cuotas

  public function pagarAlumnoCuota($cuota_id, $fecha_pago, $descuento_tipo_pago, $descuento_antes_dia_10, $apagar, $usuario)
  {
    /*$consulta = "UPDATE `alumno_carrera_cuotas`
    SET 
      `estado` = '$estado',
      `fecha_pago` = '$fecha_pago',
      `descuento_tipo_pago` = '$descuento_tipo_pago',
      `descuento_antes_dia_10` = '$descuento_antes_dia_10',
      `apagar` = '$apagar',
      `usuario` = '$usuario'
      WHERE `id` = '$cuota_id'";*/
     //genera el registro en pagos_parciales
      $fecha_pago = date('Y-m-d H:i:s');
    $consulta = "INSERT INTO `pagos_parciales` (`rela_cuota`, `descuento_tp`, `descuento_a10`, `pago`, `fecha_pago`, `usuario`) VALUES ('$cuota_id','$descuento_tipo_pago','$descuento_antes_dia_10','$apagar','$fecha_pago','$usuario');";  
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);

    return $rs;
  }


  public function estadoCuota($cuota_id, $estado)
  {
    $consulta = "UPDATE `alumno_carrera_cuotas`
    SET 
      `estado` = '$estado' WHERE `id` = '$cuota_id'";
     //cambia el estado de la cuota 
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);

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

  public function insertarIngresoAlumnoCuota($cuota_id, $tipo_pago, $apagar, $alumno_id, $usuario_id, $detalle, $descuento)
  {
    $monto = $apagar;
    $alumno_id = $alumno_id;
    $origen = "Alumno";
    $detalle = $detalle;
    $cuota_id = $cuota_id;

    // traer la caja abierta

    $cajadatos = new Alumno();
    $caja_id = $cajadatos->buscarCajaAbierta();

    // datos de ingreso
    $fecha_ingreso = date("Y-m-d");
    $ingreso_tipo_id = 6;
    $tipo_pago = $tipo_pago;
    $descuento = $descuento;
    $recargo = "0";

    $usuario_id = $usuario_id;

    $consulta = "INSERT INTO `ingreso`
    (
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
     `detalle`)
VALUES (
'$monto',
'$fecha_ingreso',
'$caja_id',
'$usuario_id',
'$ingreso_tipo_id',
'$alumno_id',
'$tipo_pago',
'$descuento',
'$recargo',
'$origen',
'$detalle');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    return $rs;
  }

  public function obtenerCuotaId($id)
  {
    $data = array();
    $consulta = "SELECT
    persona.`apellidonombre` AS apellidonombre,
    persona.`dni` AS dni,
    carrera.`nombre` AS carrera,
    alumno_carrera_cuotas.`cuota_numero` AS cuota_numero,
    alumno_carrera_cuotas.`detalle` AS cuota_detalle,
    alumno_carrera_cuotas.`monto` AS cuota_monto,
    alumno_carrera_cuotas.`id` AS cuota_id,
    alumno.`id` AS alumno_id
    FROM
        `alumno_carrera_cuotas`
        INNER JOIN `alumno` 
            ON (`alumno_carrera_cuotas`.`alumno_id` = `alumno`.`id`)
        INNER JOIN `carrera` 
            ON (`alumno_carrera_cuotas`.`carrera_id` = `carrera`.`id`)
        INNER JOIN `persona` 
            ON (`alumno`.`persona_id` = `persona`.`id`)
      where alumno_carrera_cuotas.`id`=$id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }
}
