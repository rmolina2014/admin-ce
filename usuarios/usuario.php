<?php
include_once("../bd/conexion.php");
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
    } else return $rs;
  }

  public function lista()
  {
    $consulta = "SELECT * FROM usuario";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }


  public function nuevo($codigo, $usuario, $dni_nro, $apellido_nombre, $password, $id_perfil, $email, $bloqueado)
  {

    $sql = "INSERT INTO `usuario`
            (`codigo`,
             `usuario`,
             `dni_nro`,
             `apellido_nombre`,
             `password`,
             `id_perfil`,
             `email`,
             `bloqueado`)
        VALUES (
                '$codigo',
                '$usuario',
                '$dni_nro',
                '$apellido_nombre',
                '$password',
                '$id_perfil',
                '$email',
                '$bloqueado');";
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
    $sql = "SELECT * FROM usuario where id_usuario='$id'";
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
}
