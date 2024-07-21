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


   //para revertir el ultimo aumento sabiendo el porcentaje
    //seria asi "UPDATE `carrera` 
//SET `costo_carrera` = CEIL(ROUND(`costo_carrera` / (1 + $porcentaje_aumento que se uso/100), -1)),
//    `inscripcion` = CEIL(ROUND(`inscripcion` / (1 + $porcentaje_aumento que se uso/100), -1))
//WHERE `id` = '$id'"

public function actualizarprecios($id, $porcentaje_aumento)
{
    $conexion = conexion::obtenerInstancia();
    
    // Iniciar transacción
    mysqli_begin_transaction($conexion);

    try {
        // Primer UPDATE (carrera)
        $sql = "UPDATE `carrera` 
                SET `costo_carrera` = CEIL(ROUND(`costo_carrera` * (1 + $porcentaje_aumento/100), -1)),
                    `inscripcion` = CEIL(ROUND(`inscripcion` * (1 + $porcentaje_aumento/100), -1))
                WHERE `id` = '$id'";
        
        $rs = mysqli_query($conexion, $sql);
        
        if (!$rs) {
            throw new Exception("Error en la actualización del curso: " . mysqli_error($conexion));
        }
        
        // Verificar si se actualizó alguna fila
        if (mysqli_affected_rows($conexion) == 0) {
            throw new Exception("No se encontró el curso con ID: $id");
        }
        
        // Segundo UPDATE (cuotas)
        $sqlcuotas = "UPDATE `alumno_carrera_cuotas` 
                      SET `monto` = CEIL(ROUND(`monto` * (1 + $porcentaje_aumento/100), -1))
                      WHERE `carrera_id` = '$id' AND estado='IMPAGA'";
        
        $rs = mysqli_query($conexion, $sqlcuotas);
        
        if (!$rs) {
            throw new Exception("Error en la actualización de las cuotas: " . mysqli_error($conexion));
        }
        
        // Confirmar transacción
        mysqli_commit($conexion);
        
        return true; // Ambas actualizaciones se realizaron con éxito
    } catch (Exception $e) {
        // Revertir cambios si hubo algún error
        mysqli_rollback($conexion);
        return $e->getMessage(); // Devolver mensaje de error
    }
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
