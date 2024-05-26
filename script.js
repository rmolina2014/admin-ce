function printDiv() {
    var objeto = document.getElementById('imprimir');
    var ventana = window.open('', '_blank');
    ventana.document.write('<DOCTYPE html><html><head><link rel="stylesheet" href="../assets/css/app.css" type="text/css" media="print"><title>Impresión</title></head><body>');
    ventana.document.write(objeto.innerHTML);
    ventana.document.write('</body></html>');
    ventana.document.close();
    ventana.print();
    ventana.close();
    
}