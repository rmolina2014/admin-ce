<?php
include_once("../bd/conexion.php");
class DetalleCaja
{
 
  public function listaDetalleCaja($cajanueva_id)
  {
    $consulta="SELECT * FROM `cajadetalle` where cajanueva_id=$cajanueva_id";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if(mysqli_num_rows($rs) >0)
    {
      while($fila = mysqli_fetch_assoc($rs))
      {
        $data[] = $fila;
      }
    }
    return $data;
  }



public static function ingresoDetalleCaja($cajanueva_id)
  {
    $data[] = 0;
    $consulta="SELECT SUM(`monto`) AS sumatoria 
              FROM `cajadetalle`
              WHERE cajanueva_id=$cajanueva_id and tipo='Ingreso'";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if(mysqli_num_rows($rs) >0)
    {
      while($fila = mysqli_fetch_assoc($rs))
      {
        $data[] = $fila;
      }
    }
    return $data;
  }

  public static function egresoDetalleCaja($cajanueva_id)
  {
     $data[] = 0;
    $consulta="SELECT SUM(`monto`) AS sumatoria 
              FROM `cajadetalle`
              WHERE cajanueva_id=$cajanueva_id and tipo='Egreso' ";
    $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
    if(mysqli_num_rows($rs) >0)
    {
      while($fila = mysqli_fetch_assoc($rs))
      {
        $data[] = $fila;
      }
    }
    return $data;
  }




  public function nuevo($cajanueva_id,$operacion,$tipo,$monto,$fechahora,
                      $detalle,$usuario_id)
  {
	  $sql="INSERT INTO `cajadetalle`
            (`cajanueva_id`,
             `operacion`,
             `tipo`,
             `monto`,
             `fechahora`,
             `detalle`,
             `usuario_id`)
              VALUES ('$cajanueva_id',
                      '$operacion',
                      '$tipo',
                      '$monto',
                      '$fechahora',
                      '$detalle',
                      '$usuario_id');";
      $rs = mysqli_query(conexion::obtenerInstancia(), $sql);
    return $rs;
	}

  public static function busarCajaAbierta()
	{
     $data[]=0;
	 $sql="SELECT * FROM cajanueva where estado='Abierta'";
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

     //obtener cuantas cajas estan abiertas
  public static function estadoCajas()
  {
   $consulta="SELECT COUNT(id) as abiertas FROM cajanueva WHERE estado='Abierta'";
   $rs = mysqli_query(conexion::obtenerInstancia(), $consulta);
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
?>