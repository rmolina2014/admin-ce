<?php
include_once ("../bd/conexion.php");
class Usuario
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

  public function editar($id, $usuario, $nivel, $nombrereal, $password)
  {
    $sql = "UPDATE `usuario`
            SET `usuario` = '$usuario',
                `nombrereal` = '$nombrereal',`nivel` = '$nivel',`password` = '$password'
            WHERE `id` = '$id';";
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
}
