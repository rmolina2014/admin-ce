<?php
include_once("../bd/conexion.php");
class Perfil
{

  public function ingresosalumnosporcarrera($dni)
  {
    $consulta = "SELECT i.*,carr.nombre as carrera_nombre,it.nombre as ingresotipo,p.apellidonombre as alumno,p.dni FROM ingreso i,ingreso_tipo it,alumno a,persona p,carrera carr where i.ingreso_tipo_id=it.id and i.alumno_id=a.id and a.persona_id=p.id and p.dni='$dni' and carr.id=i.carrera_id order by i.id desc";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }


    public function obtenerPersona($dni)
    {
        $consulta = "SELECT * FROM persona where dni='$dni'";
        $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
        if (mysqli_num_rows($rs) > 0) {
            while ($fila = mysqli_fetch_assoc($rs)) {
                $data[] = $fila;
            }
            return $data;
        } else
            return $rs;
    }

  public function obtenerAlumnoCursos($dni)
  {
    $data = array();
    $consulta = "SELECT
    persona.`apellidonombre` AS apellidonombre,
    persona.`dni` AS dni,
    alumno.`fecha_nacimiento` AS fecha_nacimiento,
    alumno.`estado` AS estado,
    carrera.`nombre` AS carrera,
    alumno.`id` AS id,
    persona.`domicilio` AS domicilio,
    persona.`cel1` AS cel1,
    persona.`cel2` AS cel2,
    persona.`mail` AS mail

    FROM
        `alumno` 
        INNER JOIN `carrera` 
            ON (`alumno`.`carrera_id` = `carrera`.`id`)
        INNER JOIN `persona` 
            ON (`alumno`.`persona_id` = `persona`.`id` and `persona`.`id`>1 and `persona`.`dni`=$dni );";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


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

    public function obtenerId($id)
    {
        $sql = "SELECT * FROM persona where id='$id'";
        $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
        if (mysqli_num_rows($rs) > 0) {
            while ($fila = mysqli_fetch_assoc($rs)) {
                $data[] = $fila;
            }
        }
        return $data;
    }




}
