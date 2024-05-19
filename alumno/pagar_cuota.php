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
    
        ?>
        
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
        }

        .logo {
            max-width: 150px;
            height: auto;
        }

        .company-info {
            margin-bottom: 20px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f0f0f0;
        }

        .total-amount {
            font-weight: bold;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        #printBtn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo">
            <h2>Recibo de pago</h2>
        </div>

        <div class="company-info">
            <p>Nombre de la empresa</p>
            <p>Dirección</p>
            <p>Teléfono</p>
            <p>Correo electrónico</p>
        </div>

        <div class="invoice-details">
            <p>Número de factura: #12345</p>
            <p>Fecha de emisión: 2024-05-18</p>
            <p>Cliente: Juan Pérez</p>
            <p>Dirección: Calle 123, Ciudad, País</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Producto 1</td>
                    <td>1</td>
                    <td>$100</td>
                    <td>$100</td>
                </tr>
                <tr>
                    <td>Producto 2</td>
                    <td>2</td>
                    <td>$50</td>
                    <td>$100</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td></td>
                    <td>$200</td>
                </tr>
                <tr>
                    <td>IVA (10%)</td>
                    <td></td>
                    <td></td>
                    <td>$20</td>
                </tr>
                <tr>
                    <td class="total-amount">Total</td>
                    <td></td>
                    <td></td>
                    <td>$220</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Gracias por su compra.</p>
            <p>¡Esperamos volver a verle pronto!</p>
        </div>

        <button id="printBtn" class="btn btn-primary">Imprimir recibo</button>
    </div>

    <script>
        const printBtn = document.getElementById('printBtn');

        printBtn.addEventListener('click', function() {
            window.print();
        });
    </script>
</body>
</html>

        
        
        <?php

        //echo "<script language=Javascript> location.href=\"alumno_carrera_cuotas.php?id=" . $alumno_id . "\"; </script>";
        //header('Location: listado.php');
        //exit;
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