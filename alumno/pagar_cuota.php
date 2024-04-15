<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['id']) && !empty($_POST['id']))
{
 $cuota_id = $_POST['id'];

 // continuar para pagar una cuota

   /* $carrera_id = $_POST['carrera_id'];
    $gruposanguineo = $_POST['gruposanguineo'];
    $alumno_id = $_POST['alumno_id'];
    $estado = $_POST['estado'];

    //$fechaingreso = date("Y-m-d");
    //$estado = 'Activo';

    $todobien = $objeto->editar($alumno_id, $edad, $gruposanguineo, $carrera_id, $estado);
    if ($todobien) {
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
        //header('Location: listado.php');
        exit;
    } else {
?>
        <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Lo sentimos, no se pudo guardar ...
        </div>
<?php
    }*/
}
?>