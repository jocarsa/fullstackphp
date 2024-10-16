window.onload = function(){
    console.log("web preparada")
    
    /////////////////////////// CARGAR ARTÍCULOS DEL BLOG ////////////////////////////////
    
    fetch("../servidor/?o=tabla&tabla=blog")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        datos.forEach(function(dato){
            let plantilla = document.querySelector("#plantilla_articulo");
            let destino = document.querySelector("#blog");
            let instancia = document.importNode(plantilla.content,true);
            
            instancia.querySelector("h4").innerHTML = dato.titulo
            instancia.querySelector("p").innerHTML = dato.texto
            instancia.querySelector("time").innerHTML = dato.fecha
            
            destino.appendChild(instancia);
        })
    })
    
    /////////////////////////// CARGAR ARTÍCULOS DEL BLOG ////////////////////////////////
    
    /////////////////////////// CARGAR PRODUCTOS DE LA TIENDA ONLINE ////////////////////////////////
    
    fetch("../servidor/?o=tabla&tabla=productos")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        datos.forEach(function(dato){
            let plantilla = document.querySelector("#plantilla_producto");
            let destino = document.querySelector("#tienda");
            let instancia = document.importNode(plantilla.content,true);
            
            instancia.querySelector("h4").innerHTML = dato.nombre
            instancia.querySelector("p").innerHTML = dato.descripcion
            instancia.querySelector("h5").innerHTML = "🛒 "+dato.precio+" €"    // Esto es la estética del boton
            let claves = Object.keys(dato);                                     // Tomo todas las claves del objeto
            let valores = Object.values(dato);                                  // Tomo todos los valores del objeto
            for(let i = 0;i<claves.length;i++){                                 // PAra cada una de las claves
                instancia.querySelector("h5").setAttribute(claves[i],valores[i])// Pongo su contenido como atributo del boton
            }
            
            instancia.querySelector("h5").onclick = function(){                 // Cuando sobre el boton haga click
                console.log("ok vas a comprar un producto")                     // De momento lanzo un mensaje
            }
            
            destino.appendChild(instancia);
        })
    })
    
    /////////////////////////// CARGAR PRODUCTOS DE LA TIENDA ONLINE ////////////////////////////////
}