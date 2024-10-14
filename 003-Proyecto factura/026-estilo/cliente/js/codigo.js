window.onload = function(){
    console.log("js preparado");
    
    ///////////////////////////// ATRAPO DATOS DE CLIENTE ////////////////////////////////
    
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
    
    ///////////////////////////// ATRAPO DATOS DE FACTURA ////////////////////////////////
    
    fetch("../servidor/datosfactura.php?id=1")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        document.querySelector("#fecha").textContent = datos.fecha
        document.querySelector("#numerofactura").textContent = datos.Identificador
        
    })
    
    ///////////////////////////// ATRAPO LINEAS DE FACTURA ////////////////////////////////
    
    fetch("../servidor/lineasdepedido.php?id=1")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        let tabla = document.querySelector("main table tbody")
        datos.forEach(function(dato){
            let filatr = document.createElement("tr")

            let celda = document.createElement("td")
            celda.textContent = dato.cantidad
            filatr.appendChild(celda)

            celda = document.createElement("td")
            celda.textContent = dato.nombre
            filatr.appendChild(celda)
            
            celda = document.createElement("td")
            celda.textContent = dato.precio
            filatr.appendChild(celda)
            
            celda = document.createElement("td")
            celda.textContent = dato.subtotal
            filatr.appendChild(celda)

            tabla.appendChild(filatr)
        })
        
        
        
        
        
        
    })
    
    /////////////////////////////  TOTALES DE LA FACTURA ////////////////////////////////
    
    fetch("../servidor/totalespedido.php?id=1")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        document.querySelector("#subtotal").textContent = datos[0].subtotal
        document.querySelector("#impuesto").textContent = datos[0].impuesto
        document.querySelector("#total").textContent = datos[0].total
        
    })
    
}