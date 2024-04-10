<?php
include_once("../bd/conexion.php");
class Carrera
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


  public function editar($id,$nombre,$monto)
  {

    $sql = "UPDATE `carrera` SET `nombre`='$nombre',`costo`='$monto' WHERE `id`='$id';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }


  public function obtenerCarrera($id)
  {
    $data=array();
    $consulta = "SELECT * FROM carrera where id='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }  



    public function nuevaCarrera($nombrecarrera,$monto) {
    $sql = "INSERT INTO `carrera`
    (`nombre`,`costo`)
      VALUES ('$nombrecarrera','$monto');";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }




  
  public function listaCarrera()
   {
      $data=array();
      $sql="SELECT * FROM carrera";
      $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
      if(mysqli_num_rows($rs) >0)
      {
        while($fila = mysqli_fetch_assoc($rs))
        {
          $data[] = $fila;
        }
      }
      return $data;
      
    }
}
