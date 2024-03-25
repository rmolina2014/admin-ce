<?php
 include("../cabecera.php");
 include("../menu.php");
//session_start();
include_once ("../bd/conexion.php");
include("usuario.php");
$id = $_GET['id'];
$objeto = new Usuario();
$sqlpermisos= $objeto->listaPermisos();
//$sqlpermisos = mysqli_query($conexion, "SELECT * FROM permisos");
$usuarios = $objeto->obtenerUsuario($id);
$consulta = $objeto->detallePermisos($id);
//$consulta = mysqli_query($conexion, "SELECT * FROM detalle_permiso WHERE rela_usuario = $id");
$resultUsuario = mysqli_num_rows($usuarios);
var_dump($resultUsuario);
if (empty($resultUsuario)) {
   // header("Location: index.php");
    //echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}
$datos = array();
foreach ($consulta as $asignado) {
    $datos[$asignado['rela_permiso']] = true;
}
//var_dump($datos);
//exit();

if (isset($_POST['permisos'])) {
    $id_user = $_GET['id'];
    $permisos = $_POST['permisos'];
    $eliminarpermisos = $objeto->eliminarPermisos($id_user);
    //mysqli_query($conexion, "DELETE FROM detalle_permiso WHERE rela_usuario = $id_user");
    if ($permisos != "") {
        foreach ($permisos as $permiso) {
            $sql = $objeto->nuevosPermisos($id_user,$permiso);
            //$sql = mysqli_query($conexion, "INSERT INTO detalle_permisos(rela_usuario, rela_permiso) VALUES ($id_user,$permiso)");
        }
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Permisos Asignados
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        //header("Location: index.php"); 
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";            
        exit();           
    }
}
//include_once "includes/header.php";
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card shadow-lg">
            <div class="card-header card-header-primary">
                Permisos
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <?php echo (isset($alert)) ? $alert : '' ; ?>
                    <?php foreach ($sqlpermisos as $row) { ?>
                        <div class="form-check form-check-inline m-4">
                            <label for="permisos" class="p-2 text-uppercase"><?php echo $row['nombre']; ?></label>
                            <input id="permisos" type="checkbox" name="permisos[]" value="<?php echo $row['id']; ?>" <?php if (isset($datos[$row['id']])) {                                                                                                                        echo "checked";                                                                                   } ?>>
                        </div>
                    <?php } ?>
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("../pie.php"); ?>