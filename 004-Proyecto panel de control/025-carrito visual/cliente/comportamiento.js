/////////////////////////// VARIABLES GLOBALES ////////////////////////////////

var carrito = []

/////////////////////////// VARIABLES GLOBALES ////////////////////////////////

window.onload = function(){
    console.log("web preparada")
    
    function cargaBlog(){
        /////////////////////////// CARGAR ARTÍCULOS DEL BLOG ////////////////////////////////

        console.log("hola")
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
        
    }
    
    function cargaProductos(){
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
                    document.querySelector("#carrito").style.display = "block"
                    let atributos = this.attributes
                    let mensaje = {}
                    console.log(atributos)
                    for(let i = 0;i<atributos.length;i++){
                        mensaje[atributos[i].name] = this.getAttribute(atributos[i].name)
                    }
                    carrito.push(mensaje)
                    console.log(carrito)
                    pueblaCarrito()
                }

                destino.appendChild(instancia);
            })
        })

        /////////////////////////// CARGAR PRODUCTOS DE LA TIENDA ONLINE ////////////////////////////////
    }
    /////////////////////////// NAVEGACION ////////////////////////////////
    
        let botones = document.querySelectorAll("nav ul li a")                  // Selecciono todos los elementos del menu
        botones.forEach(function(boton){                                        
            boton.onclick = function(){
                console.log("vamos a alguna parte")
                let secciones = document.querySelectorAll("section")
                secciones.forEach(function(seccion){
                    seccion.style.display = "none"
                })
                let identificador = this.getAttribute("href")
                
                switch(identificador){
                    case "#blog":
                        cargaBlog()
                        break;
                    case "#tienda":
                        cargaProductos()
                        break;
                }
                
                document.querySelector(identificador).style.display = "block"
            }
        })
    
    /////////////////////////// NAVEGACION ////////////////////////////////
    
    
}

function pueblaCarrito(){
    document.querySelector("#carrito").innerHTML = ""                       // En primer lugar vacio el carrito
    carrito.forEach(function(producto){
        document.querySelector("#carrito").innerHTML += producto.nombre+"<br>"
    })
}




