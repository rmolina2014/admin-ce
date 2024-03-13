<?php
class Conexion{

	private static $objCon = null;
	private static $instancia = null;

	public static function obtenerInstancia(){
	if(self::$objCon == null){
			self::$instancia = new Conexion();
			// mysqli_connect("localhost"," nombre usuario","clve de la base de datos","nombre de la base de datos");
    		self::$objCon = mysqli_connect("localhost","root","","bdce");
		}
		return self::$objCon;
	}

	function __destruct(){
		mysqli_close(conexion::obtenerInstancia());
	}

	/***para sacar los espacios y caracteres especiales */
	function secure_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
		$data=str_ireplace("<script>","",$data);
		$data=str_ireplace("</script>","",$data);
        return $data;
    }

}
$rs = conexion::obtenerInstancia();
?>