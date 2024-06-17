<?php
include_once ("../bd/conexion.php");
class Usuario
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

    public function listaPermisos()
  {
    $consulta = "SELECT * FROM permiso";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }

  public function detallePermisos($id)
  {
    $consulta = "SELECT * FROM detalle_permiso WHERE rela_usuario = $id";
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
    $consulta = "SELECT
usuario.`id` AS id,
usuario.`usuario` AS usuario,
usuario.`estado` AS estado,
usuario.`pass` AS pass,
persona.`apellidonombre` AS apellidonombre
FROM
    `usuario`
    INNER JOIN `persona` 
        ON (`usuario`.`rela_persona` = `persona`.`id`)";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function nuevo($rela_persona, $usuario, $pass, $estado, $fechaingreso)
  {
    $sql = "INSERT INTO `usuario`
            (`rela_persona`,
             `usuario`,
             `pass`,
             `estado`,
             `fechaingreso`)
VALUES (
        '$rela_persona',
        '$usuario',
        '$pass',
        '$estado',
        '$fechaingreso');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

public function nuevosPermisos($id_user, $permiso)
  {
    $sql = "INSERT INTO detalle_permiso(rela_usuario, rela_permiso) VALUES ($id_user,$permiso);";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function editar($id, $usuario, $bloqueado)
  {
    $sql = "UPDATE `usuario`
            SET `usuario` = '$usuario',
                `estado` = '$bloqueado' WHERE `id` = '$id';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function obtenerId($id)
  {
    $sql = "SELECT * FROM usuario where id='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function usuariosLista($id)
  {
    $consulta = "SELECT
usuario.`id` AS id,
usuario.`usuario` AS usuario,
usuario.`estado` AS estado,
usuario.`pass` AS pass,
persona.`apellidonombre` AS apellidonombre,
persona.`dni` AS dni
FROM
    `usuario`
    INNER JOIN `persona` 
        ON (`usuario`.`rela_persona` = `persona`.`id`) where usuario.id=$id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
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

    public function eliminarPermisos($id)
  {
    $sql = "DELETE FROM detalle_permiso WHERE rela_usuario = '$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function listaPerfil()
  {
    $consulta = "SELECT * FROM t_perfiles";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
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