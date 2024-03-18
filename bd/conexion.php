<?php
class Conexion
{

	private static $objCon = null;
	private static $instancia = null;

	public static function obtenerInstancia()
	{
		if (self::$objCon == null) {
			self::$instancia = new Conexion();
			// mysqli_connect("localhost"," nombre usuario","clve de la base de datos","nombre de la base de datos");
			self::$objCon = mysqli_connect("localhost", "root", "", "bdce");
			//self::$objCon = mysqli_connect("localhost","c2431315_ce","rake88loNI","c2431315_ce");
		}
		return self::$objCon;
	}

	function __destruct()
	{
		mysqli_close(conexion::obtenerInstancia());
	}

	/***para sacar los espacios y caracteres especiales */
	public static function secure_data($data)
	{
		$data = preg_replace('/[^a-zA-Z0-9 ]/', '', $data);
		return $data;
	}
}
$rs = conexion::obtenerInstancia();