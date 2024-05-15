<?php
include("../cabecera.php");
include("../menu.php");
include("alumno.php");
$objeto = new Alumno();
if (isset($_POST['cuota_id']) && !empty($_POST['cuota_id'])) {
    $cuota_id = $_POST['cuota_id'];
    $fecha_pago = date("Y-m-d H:i:s");
    $estado = 'PAGADO';
    $alumno_id = $_POST['alumno_id'];
    $detalle = $_POST['detalle'];
    $tipo_pago = $_POST['tipo_pago'];
    $descuento_tipo_pago = $_POST['descuentoFormaPago'];
    $descuento_antes_dia_10 = $_POST['descuentoPagoaAntesDiaDiez'];
    $apagar=$_POST['apagar'];
    $usuario=$USUARIO;

    $pagar_cuota = $objeto->pagarAlumnoCuota($cuota_id, $estado, $fecha_pago, $descuento_tipo_pago, $descuento_antes_dia_10,$apagar,$usuario);

    if ($pagar_cuota) {
        
         $descuento=$descuento_tipo_pago+$descuento_antes_dia_10;
        //-------- generar el movimiento en la caja-------
        $insertarIngreso = $objeto->insertarIngresoAlumnoCuota($cuota_id, $tipo_pago,$apagar,$alumno_id,$usuario,$detalle,$descuento);

        echo "<script language=Javascript> location.href=\"alumno_carrera_cuotas.php?id=" . $alumno_id . "\"; </script>";
        //header('Location: listado.php');
        exit;
    } else {
?>
        <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Lo sentimos, no se pudo guardar ...
        </div>
<?php
    }



}



?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
    

  </div>

  <button id="btnImprimir">Imprimir</button>

</div>        




<script>

document.getElementById('btnImprimir').addEventListener('click', generarContenidoImpresion);

    function generarContenidoImpresion() {
  const contenido = document.getElementById('contenidoParaImprimir').innerHTML;
  const ventanaImpresion = window.open('', '', 'width=800,height=600');
  ventanaImpresion.document.write(`
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Impresión</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYdAe6z0nPJ5oW8YDqQjpeRjU1MC/sQS9kXcQzK3F9yBmIWFzVJeD6Mi+mQ5k9rY" crossorigin="anonymous">
    </head>
    <body>
      ${contenido}
    </body>
    </html>
  `);
  ventanaImpresion.print();
  ventanaImpresion.close();
}
</script>