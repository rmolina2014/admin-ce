function calcularPorcentaje(monto, porcentaje) {
  valor = (monto * porcentaje) / 100;
  //console.log(valor);
  // Redondear el resultado a dos decimales (opcional)
  resultado = valor.toFixed(2);
  console.log(resultado);
  return resultado;
}
