<?php
 session_start();
 var_dump($_SESSION['sesion_usuario']);
 exit;
 
session_name("sesion_sj2023");
 
 if (isset($_SESSION['sesion_usuario']))
 {
   echo $ID= $_SESSION['sesion_id'];
   $USUARIO=$_SESSION['sesion_usuario'];
   $NOMBRE=$_SESSION['sesion_nombre'];
   $PERMISO=$_SESSION['sesion_permisos'];
 }
 else { header ("Location:../index.php"); }

 ?>