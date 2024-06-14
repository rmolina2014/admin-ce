// validacion.js
function soloNumeros(event) {
    let inputValue = event.target.value;
    let regex = /^[0-9]*\.?[0-9]*$/;
    if (!regex.test(inputValue)) {
        event.target.value = inputValue.slice(0, -1);
    }
}

function validarSumaCierreCaja() {
    //para validar que ingresen solo numeros
    let inputValue = event.target.value;
    let regex = /^[0-9]*\.?[0-9]*$/;
    if (!regex.test(inputValue)) {
        event.target.value = inputValue.slice(0, -1);
    }   


    let dep_caja_fuerte = parseFloat(document.getElementById('dep_caja_fuerte').value) || 0;
    let dep_banco = parseFloat(document.getElementById('dep_banco').value) || 0;
    let dep_mp = parseFloat(document.getElementById('dep_mp').value) || 0;
    let dep_proxima_caja = parseFloat(document.getElementById('dep_proxima_caja').value) || 0;
    
    let total = parseFloat(document.getElementById('ingreso_arendir').innerText);
    
    let suma = dep_caja_fuerte + dep_banco + dep_mp + dep_proxima_caja;
    
    let mensaje = document.getElementById('mensaje');
    let boton = document.getElementById('botonEnviar');

    if (suma === total) {
        mensaje.innerText = "LA SUMA ES CORRECTA";
        mensaje.style.color = "green";
        boton.disabled = false;
    } else {
        mensaje.innerText = "LA SUMA NO COINCIDE. VERIFIQUE.";
        mensaje.style.color = "red";
        boton.disabled = true;
    }
}
Resumen