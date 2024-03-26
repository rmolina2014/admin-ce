<?php
include_once("../bd/conexion.php");
class Perfil
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
        } else
            return $rs;
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
