window.onload = function(){
    console.log("js preparado");
    fetch("../servidor/datosdecliente.php?id=1")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        document.querySelector("#receptor .razonsocial").textContent = datos.razonsocial
        document.querySelector("#receptor .direccion").textContent = datos.direccion
        document.querySelector("#receptor .cp").textContent = datos.cp + "-" + datos.poblacion
        document.querySelector("#receptor .identificacionfiscal").textContent = datos.identificacionfiscal
        document.querySelector("#receptor .email").textContent = datos.email
        document.querySelector("#receptor .telefono").textContent = datos.telefono
    })
    
    fetch("../servidor/datosfactura.php?id=1")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        document.querySelector("#fecha").textContent = datos.fecha
        document.querySelector("#numerofactura").textContent = datos.Identificador
        
    })
    
}