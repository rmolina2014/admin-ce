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
    $fecha_pago,
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
     `fecha_pago`,
      `detalle`)
      VALUES (
      '$alumno_id',
      '$carrera_id',
      '$cuota_numero',
      '$monto',
      '$estado',
      '$fecha_vencimiento',
      '$fecha_pago',
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

  // pagar cuotas
  public function pagarAlumnoCuota($cuota_id, $estado, $fecha_pago)
  {
    $consulta = "UPDATE `alumno_carrera_cuotas`
    SET 
      `estado` = '$estado',
      `fecha_pago` = '$fecha_pago'
      WHERE `id` = '$cuota_id'";
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


  // INSERTAR INGRESO DE PAGO DE CUOTAS

  /* INSERT INTO `bdce`.`ingreso`
            (`id`,
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
VALUES ('id',
        aja_id',
        'usua'monto',
        'fecha_ingreso',
        'crio_id',
        'ingreso_tipo_id',
        'alumno_id',
        'tipo_pago',
        'descuento',
        'recargo',
        'origen',
        'detalle');*/

  public function insertarIngresoAlumnoCuota($cuota_id,$tipo_pago)
  {
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
        WHERE `id`=" . $cuota_id;
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $monto = $fila['monto'];
        $alumno_id = $fila['alumno_id'];
        $detalle = $fila['detalle'];
      }
    }

    // traer la caja abierta

    $cajadatos = new Alumno();
    $caja_id = $cajadatos->buscarCajaAbierta();

    // datos de ingreso
    $fecha_ingreso=date("Y-m-d");
    $ingreso_tipo_id=6;
    $tipo_pago=$tipo_pago;
    $descuento="0";
    $recargo="0";
    $origen="Alumno";
    $usuario_id="999";

    $consulta="INSERT INTO `ingreso`
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
}
