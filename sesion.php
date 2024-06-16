<?php
session_start();
//var_dump($_SESSION);
//exit;
//session_name("sesion_sj2023");

if (isset($_SESSION['sesion_usuario'])) {
  $ID = $_SESSION['sesion_id'];
  $USUARIO = $_SESSION['sesion_usuario'];
  //   $NOMBRE=$_SESSION['sesion_nombre'];
  // $PERMISO=$_SESSION['sesion_permisos'];
} else {
  echo 1;
  exit();
  echo "<script language=Javascript> location.href=\"../index.php\"; </script>";
}
?>
