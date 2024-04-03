<?php
error_reporting(E_ALL);

include_once("bd/conexion.php");
include("usuarios/usuario.php");

if ($_POST['usuario']) {
  $usuario = conexion::secure_data($_POST['usuario']);
  $password = MD5($_POST['password']);
  //echo $usuario.' '.$password;
  //exit;
  $objecto = new Usuario();
  $usuarios = $objecto->obtenerUsuario($usuario);
  if ($usuarios) {

    foreach ($usuarios as $item) {
      if ($item['pass'] == $password) {
        // crear sesion y guardar datos
        //session_name("sesion_sj2023");
        // incia sessiones
        session_start();
        $_SESSION['sesion_usuario'] = $item['usuario'];
        $usuario_id = $_SESSION['sesion_id'] = $item['id'];
        //$_SESSION['sesion_nombre'] = $item['apellido_nombre'];
        //$_SESSION['sesion_permisos'] = $item['id_perfil'];
        //$_SESSION['sesion_empresa'] = $item['empresa_id'];
        // var_dump($_SESSION);
        // exit;

        // registro el usuario 
        /*$fecha = date("Y-m-d");
            $hora = date("H:i:s");
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
              {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
              }
              elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
              {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
              }
              else
              {
                $ip=$_SERVER['REMOTE_ADDR'];
              }

             $sql2 = "INSERT INTO login (usuario_id,fecha,hora,ip) VALUES ('$usuario_id', '$fecha', '$hora', '$ip')";
             $rs= mysqli_query($objCon,$sql2);
*/
        //preguntar por grupo permiso 1 ver todos los documentos, 2 solos el area


        //echo "<script language=Javascript> location.href=\"panelcontrol/index.php\"; </script>";
        //exit();
        header("location: panelcontrol/index.php");
      } //fin if paswword
      else {
        //echo '<script> alert("Clave Incorrecta."); window.location="index.php"; </script>'; //Password incorrecto';
        echo '<script> window.location="index.php?mensaje=1";</script>'; //Password incorrecto';
        //header("location:index.php");
        exit();
      }
    } //fin del forech
  }
  //echo '<script> alert("Usuario Incorrecto."); window.location="index.php";</script>'; //Password incorrecto';
  echo '<script> window.location="index.php?mensaje=1";</script>'; //Password incorrecto';
  //header("location:index.php");
  exit();
}
echo '<script> alert("Datos Incorrecto final."); window.location="index.php";</script>'; //Password incorrecto'
