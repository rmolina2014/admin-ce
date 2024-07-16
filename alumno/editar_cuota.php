<?php
include("../sesion.php");
include("alumno.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cuota_id'], $_POST['nuevo_monto'], $_POST['alumno_id']) && 
        !empty($_POST['cuota_id']) && !empty($_POST['nuevo_monto']) && !empty($_POST['alumno_id'])) {
        
        $cuota_id = (int)$_POST['cuota_id'];
        $nuevo_monto = (float)$_POST['nuevo_monto'];
        $alumno_id = (int)$_POST['alumno_id'];

        // Validar que el nuevo monto sea positivo
        if ($nuevo_monto <= 0) {
            $_SESSION['error'] = "El monto debe ser un valor positivo.";
            header("Location: alumno_carrera_cuotas.php?id=" . $alumno_id);
            exit();
        }

        $objeto = new Alumno();
        
        // Actualizar el monto de la cuota
        $resultado = $objeto->actualizarMontoCuota($cuota_id, $nuevo_monto);

        if ($resultado) {
            $_SESSION['success'] = "El monto de la cuota ha sido actualizado correctamente.";
        } else {
            $_SESSION['error'] = "Hubo un error al actualizar el monto de la cuota.";
        }
    } else {
        $_SESSION['error'] = "Datos incompletos o inválidos.";
    }
} else {
    $_SESSION['error'] = "Método de solicitud no válido.";
}

// Redirigir de vuelta a la página de cuotas del alumno
header("Location: alumno_carrera_cuotas.php?id=" . $alumno_id);
exit();
?>