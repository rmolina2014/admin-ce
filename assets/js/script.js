// calcular el porcetaje 
/*
unción calcularPorcentaje:
Recibe dos argumentos: monto (el monto base) y porcentaje (el porcentaje a calcular).
Valida si los argumentos son números válidos utilizando isNaN. Si no lo son, lanza un error.
Convierte el porcentaje a decimal dividiendo por 100.
Calcula el porcentaje del monto multiplicando monto por porcentajeDecimal.
(Opcional) Redondea el resultado a dos decimales utilizando toFixed(2).
Devuelve el resultado.
*/
function calcularPorcentaje(monto, porcentaje) {
    // Validar si los argumentos son números
    if (isNaN(monto) || isNaN(porcentaje)) {
      throw new Error("Los argumentos deben ser números válidos");
    }
  
    // Convertir el porcentaje a decimal
    porcentajeDecimal = porcentaje / 100;
  
    // Calcular el porcentaje del monto
    resultado = monto * porcentajeDecimal;
  
    // Redondear el resultado a dos decimales (opcional)
    resultado = resultado.toFixed(2);
  
    return resultado;
  }
  