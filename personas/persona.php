<?php
include_once("../bd/conexion.php");
class Persona
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

  public function obtenerNombre($nombre)
  {
    $consulta = "SELECT * FROM persona where apellidonombre='$nombre'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else return $rs;
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
  
  public function lista()
  {
    //mayor a 1 para que no muestra a la persona Instituto que esta jarcodeada
    $consulta = "SELECT * FROM persona where id>1";
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
  $stmt = mysqli_prepare(conexion::obtenerInstancia(), $sql);

if (!$stmt) {
  echo "Error al preparar la consulta: " . mysqli_error(conexion::obtenerInstancia()) . "\n";
  return false;
} else {
  // Vincular valores y ejecutar la consulta
  $stmt->execute();
        if ($stmt->errno) {
            if ($stmt->errno == 1062) {
                // Registrar el error en un archivo de errores o usar una función personalizada para manejar el error.
                error_log("Error al insertar el usuario: DNI duplicado", 0);
                
                // Mostrar un mensaje de error personalizado al usuario.
                trigger_error("El DNI introducido ya está registrado.", E_USER_ERROR);    
                return false;
            } else {
                echo "Error al insertar el usuario: " . $stmt->error . "\n";
                // Mostrar un mensaje de error personalizado al usuario.
                trigger_error("El DNI introducido ya está registrado.", E_USER_ERROR); 
                return false;
            }
        } else {
            $inserted_id = mysqli_insert_id(conexion::obtenerInstancia());
            echo "Usuario insertado correctamente. ID: " . $inserted_id . "\n";
            return $inserted_id;
        }
}
  }


  public function editar($id,$domicilio, $cel1, $cel2, $mail)
  {

    $sql = "UPDATE `persona` SET `domicilio`='$domicilio',`cel1`='$cel1',`cel2`='$cel2',`mail`='$mail' WHERE `id`='$id';";
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