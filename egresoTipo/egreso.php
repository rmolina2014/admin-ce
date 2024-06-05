<?php
include_once("../bd/conexion.php");
class Egreso
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


  public function editar($id,$detalle)
  {

    $sql = "UPDATE `egreso_tipo` SET `nombre`='$detalle' WHERE `id`='$id';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }


  public function obtenerTipoEgreso($id)
  {
    $data=array();
    $consulta = "SELECT * FROM egreso_tipo where id='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }  



    public function nuevoEgresoTipo($nombre) {
    $sql = "INSERT INTO `egreso_tipo`
    (`nombre`)
      VALUES ('$nombre');";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }




  //lista los ingresos por tipo
  public function listaEgresoTipo()
   {
      $data=array();
      $sql="SELECT * FROM egreso_tipo";
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
