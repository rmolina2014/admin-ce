<?php
include_once("../bd/conexion.php");
//include_once("../sesion.php");
class Ingreso
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

  public function obtenerId($id)
  {
    $data=array();
    $consulta = "SELECT * FROM ingreso where id='$id'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if (mysqli_num_rows($rs) > 0) {
      while ($fila = mysqli_fetch_assoc($rs)) {
        $data[] = $fila;
      }
      return $data;
    } else
      return $rs;
  }


    public function obtenerIdconalumno($id)
  {
    $data=array();
    $consulta = "SELECT i.*,p.dni FROM ingreso i,alumno a,persona p where i.id='$id' and a.persona_id=p.id and i.alumno_id = a.id ";
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

   
    public function editar($ingreso_id, $tipoingreso, $monto,$id_alumno,$tipo_pago,$origen)
  {
    $sql = "UPDATE `ingreso`
    SET 
      `ingreso_tipo_id` = '$tipoingreso',
      `monto` = '$monto',
      `alumno_id` = '$id_alumno',
      `tipo_pago` = '$tipo_pago',
      `origen` = '$origen'
       WHERE `id` = '$ingreso_id'";

    $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
  }

  public function listaporcaja($caja)
  {
    $consulta = "SELECT i.*,it.nombre as ingresotipo,p.apellidonombre as alumno,p.dni FROM ingreso i,ingreso_tipo it,alumno a,persona p where i.ingreso_tipo_id=it.id and i.alumno_id=a.id and a.persona_id=p.id and caja_id='$caja' order by i.id desc";
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
    if ($alumno_id == 1){
       $origen="Socios";
     }else
     {
        $origen="Alumno";
     }
 

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
