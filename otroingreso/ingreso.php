<?php
include_once("../bd/conexion.php");
class Ingreso
{


  public function obtenerId($id)
  {
    $data=array();
    $consulta = "SELECT * FROM egreso where id='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
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

  public function lista($cajaabierta)
  {

    $data=array();
    $consulta = "select e.*,et.nombre from egreso e,egreso_tipo et where e.caja_id='$cajaabierta' and e.egreso_tipo=et.id order by e.id desc";

    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public function nuevo(
    $monto,
    $fecha_egreso,
    $caja_id,
    $usuario_id,
    $egreso_tipo
  ) {
    $sql = "INSERT INTO `egreso`
    (`monto`,
     `fecha_egreso`,
     `caja_id`,
     `usuario_id`,
     `egreso_tipo`)
      VALUES ('$monto',
      '$fecha_egreso',
      '$caja_id',
      '$usuario_id',
      '$egreso_tipo'
      );";
    //echo $sql;
    //exit;
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    //$rs = mysqli_insert_id(conexion::obtenerInstancia());
    return $rs;
  }


    public function editar($egreso_id, $tipoegreso, $monto)
  {
    $sql = "UPDATE `egreso`
    SET 
      `egreso_tipo` = '$tipoegreso',
      `monto` = '$monto'
       WHERE `id` = '$egreso_id'";

    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function listaporcaja($caja)
  {
    $consulta = "SELECT i.*,it.nombre as ingresotipo FROM ingreso i,ingreso_tipo it where i.ingreso_tipo_id=it.id and caja_id='$caja'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }  




  public function buscarCajaAbierta()
  {
    $data = array();
    $consulta = "SELECT
    *
  FROM `caja`
  where `estado`= 'Abierta';";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        //$data[] = $fila;
        $id = $fila["id"];
      }
    }
    return $id;
  }

  
  //lista los ingresos por tipo
  public function listaIngresoTipo()
  {
    $sql = "SELECT * FROM ingreso_tipo order by nombre";
    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
    }
    return $data;

  }

//insertar ingresos de otros ingresos

  public function insertarIngresoOtrosIngresos($monto,
    $fecha_ingreso,
    $caja_id,
    $usuario_id,
    $ingreso_tipo,
    $alumno_id,
    $tipopago,$observacion)
  {

    
    $descuento="0";
    $recargo="0";
    $origen="Socios";
 

    $consulta="INSERT INTO `ingreso`
    (
     `monto`,
     `fecha_ingreso`,
     `caja_id`,
     `usuario_id`,
     `ingreso_tipo_id`,
     `alumno_id`,
     `tipo_pago`,
     `descuento`,
     `recargo`,
     `origen`,`detalle`)
VALUES (
'$monto',
'$fecha_ingreso',
'$caja_id',
'$usuario_id',
'$ingreso_tipo',
'$alumno_id',
'$tipopago',
'$descuento',
'$recargo',
'$origen','$observacion');";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    return $rs;
  }        

//fin insertar de otros ingresos        



}
