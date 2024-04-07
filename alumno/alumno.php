<?php
include_once("../bd/conexion.php");
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
            ON (`alumno`.`persona_id` = `persona`.`id`);";
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
    $estado
  ) {
    $sql = "INSERT INTO `alumno`
    (`edad`,
     `gruposanguineo`,
     `persona_id`,
     `carrera_id`,
     `estado`)
VALUES (
'$edad',
'$gruposanguineo',
'$persona_id',
'$carrera_id',
'$estado');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
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
}
