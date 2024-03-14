<?php
include_once("../bd/conexion.php");
class Persona
{
  public function obtenerPersona($dni)
  {
    $consulta = "SELECT * FROM persona where dni='$dni'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else return $rs;
  }

  public function lista()
  {
    $consulta = "SELECT * FROM persona";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function nuevo($apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail)
  {

    $sql = "INSERT INTO `persona`
            (`apellidonombre`, `dni`, `domicilio`, `cel1`, `cel2`, `mail`)
        VALUES (
                '$apellidonombre',
                '$dni',
                '$domicilio',
                '$cel1',
                '$cel2',
                '$mail');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }


  public function editar($id,$apellidonombre, $dni, $domicilio, $cel1, $cel2, $mail)
  {

    $sql = "UPDATE `persona` SET `apellidonombre`='$apellidonombre',`dni`='$dni',`domicilio`='$domicilio',`cel1`='$cel1',`cel2`='$cel2',`mail`='$mail' WHERE `id`='$id';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
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

  public function eliminar($id)
  {
    $sql = "DELETE FROM persona WHERE id ='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }


}
