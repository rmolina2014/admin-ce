<?php
include_once("../bd/conexion.php");
class Alumno
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
    alumno.`fecha_nacimiento` AS fecha_nacimiento,
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
    $fecha_nacimiento,
    $persona_id,
    $carrera_id,
    $estado,
    $observacion,
    $fecha_ingreso,
    $redes_sociales
  ) {
    $db = conexion::obtenerInstancia(); // Obtener la instancia de conexión

    $sql = "INSERT INTO `alumno`
    (
     `fecha_nacimiento`,
     `persona_id`,
     `carrera_id`,
     `estado`,
     `observacion`,
     `fecha_ingreso`,
     `redes_sociales`
     )
      VALUES (
      '$fecha_nacimiento',
      '$persona_id',
      '$carrera_id',
      '$estado',
      '$observacion',
      '$fecha_ingreso','$redes_sociales');";
       // Ejecutar la consulta
        $rs = mysqli_query($db, $sql);

        // Verificar si la consulta fue exitosa
        if ($rs) {
            $alumno_id = mysqli_insert_id($db);
            return $alumno_id;
        } else {
            // Verificar si el error es debido a una clave única duplicada
            if (mysqli_errno($db) == 1062) {
                // Lanzar una excepción con un mensaje específico para clave duplicada
                throw new Exception("Error: El alumno ya está inscrito en este curso.");
            } else {
                // Lanzar una excepción con el mensaje de error de MySQL
                throw new Exception("Error: " . mysqli_error($db));
            }
        }
    
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

  public function editar($id, $fecha_nacimiento, $redes_sociales,  $estado,$observacion)
  {
    $sql = "UPDATE `alumno`
    SET 
      `fecha_nacimiento` = '$fecha_nacimiento',
      `redes_sociales` = '$redes_sociales',
      `estado` = '$estado',
      `observacion` = '$observacion'
       WHERE `id` = '$id'";

    //echo $sql;
    //exit;   
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }


  public function actualizarMontoCuota($cuota_id, $nuevo_monto)
  {
    $sql = "UPDATE `alumno_carrera_cuotas`
    SET 
      `monto` = '$nuevo_monto'
       WHERE `id` = '$cuota_id'";

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
    alumno.`fecha_nacimiento` AS fecha_nacimiento,
    alumno.`gruposanguineo` AS gruposanguineo,
    alumno.`redes_sociales` AS redes_sociales,
    alumno.`estado` AS estado,
    alumno.`observacion` AS observacion,
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

  //verifica si existe el alumno en un curso determinado
public function buscarAlumnoCarrera($id_persona,$id_carrera)
  {
    //$data = array();
    $sql = "SELECT a.id FROM alumno a WHERE a.persona_id='$id_persona' and a.carrera_id='$id_carrera'  ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      return true;
    }else{
    return false;
         }
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


  public function actualizarCaja($ingreso)
  {

    // traer la caja abierta

    $cajadatos = new Alumno();
    $caja_id = $cajadatos->buscarCajaAbierta();

    // datos de ingreso
    $consulta = "SELECT * FROM `caja` where id=$caja_id";
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
            WHERE `id` = '$caja_id';";
      $result = mysqli_query(conexion::obtenerInstancia(), $sql);
      return $result;
    }
  }


  // inserta un ingreso y devuel el id que sera usado en el comprobante o recibo 
  public function insertarIngresoAlumnoCuota($cuota_id, $tipo_pago, $apagar, $alumno_id, $usuario_id, $detalle, $descuento,$carrera_id)
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
     `detalle`,
     `carrera_id`)
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
'$detalle',
'$carrera_id');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);

    return mysqli_insert_id(conexion::obtenerInstancia());
  }


  public function obtenerCuotaId($id)
  {
    $data = array();
    $consulta = "SELECT
    persona.`apellidonombre` AS apellidonombre,
    persona.`dni` AS dni,
    carrera.`nombre` AS carrera,
    carrera.`id` AS carrera_id,
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

  // datos para el recibo de pago
  public function datosRecivoPago($cuota_id,$ingreso_id)
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
    alumno.`id` AS alumno_id,
    ingreso.`monto` AS monto_pagado,
    ingreso.`id` AS ingreso_id
    FROM
        `alumno_carrera_cuotas`
        INNER JOIN `alumno` 
            ON (`alumno_carrera_cuotas`.`alumno_id` = `alumno`.`id`)
        INNER JOIN `carrera` 
            ON (`alumno_carrera_cuotas`.`carrera_id` = `carrera`.`id`)
        INNER JOIN `persona` 
            ON (`alumno`.`persona_id` = `persona`.`id`)
            INNER JOIN `ingreso` 
        ON (`alumno_carrera_cuotas`.`alumno_id` = `ingreso`.`alumno_id`)
      WHERE ingreso.`id`=$ingreso_id AND alumno_carrera_cuotas.`id`=$cuota_id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }










}
