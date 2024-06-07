<?php
include_once("../bd/conexion.php");
class Carrera
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


  public function editar($id,$nombre,$cantidadcuotas,$costocurso,$costoinscripcion,$detalles)
  {

    $sql = "UPDATE `carrera` SET `nombre`='$nombre',`cantidad_cuotas`='$cantidadcuotas',`costo_carrera`='$costocurso',`inscripcion`='$costoinscripcion',`detalles`='$detalles' WHERE `id`='$id';";
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



    public function nuevaCarrera($nombrecarrera,$cantidadcuotas,$costocurso,$costoinscripcion,$detalles) {
    $sql = "INSERT INTO `carrera`
    (`nombre`,`cantidad_cuotas`,`costo_carrera`,`inscripcion`,`detalles`)
      VALUES ('$nombrecarrera','$cantidadcuotas','$costocurso','$costoinscripcion','$detalles');";
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
