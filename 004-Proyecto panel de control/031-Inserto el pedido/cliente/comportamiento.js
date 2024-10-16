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
    let plantilla = document.querySelector("#plantilla_itemproducto");
    let destino = document.querySelector("#carrito");
    let instancia = document.importNode(plantilla.content,true);
    
    let suma = 0;
    
    carrito.forEach(function(producto){
        let instancia = document.importNode(plantilla.content,true);
        instancia.querySelector("h4").textContent = producto.nombre
        instancia.querySelector("p").textContent = producto.descripcion
        instancia.querySelector("h5").textContent = producto.precio
        destino.appendChild(instancia);
        suma += parseFloat(producto.precio)
    })
    
    let totales = document.createElement("div")
    totales.textContent = suma.toFixed(2)+" €";
    totales.style.textAlign = "right"
    destino.appendChild(totales)
    
    let procesa = document.createElement("button")
    procesa.classList.add("boton")
    procesa.textContent = "Procesar pedido";
    
    procesa.onclick = function(){
        console.log("vamos a procesar el pedido")
        document.querySelector("#carrito").innerHTML = ""               // Vaciamos el carrito
        let titulo = document.createElement("h3")
        titulo.textContent = "Introduce tus datos de cliente"
        destino.appendChild(titulo)
        fetch("../servidor/?o=columnas&tabla=clientes")
        .then(function(response){
            return response.json()
        })
        .then(function(datos){
            let campos = []
            datos.forEach(function(dato){
                campos.push(document.createElement("input"))
                campos[campos.length-1].setAttribute("placeholder",dato.Field)
                destino.appendChild(campos[campos.length-1])
            })
            let procesaenvia = document.createElement("button")
            procesaenvia.classList.add("boton")
            procesaenvia.textContent = "Enviar";
            procesaenvia.onclick = function(){
                console.log("Ahora si que la vamos a liar muy parda")
                let mensajecliente = {}
                campos.forEach(function(campo){
                    mensajecliente[campo.getAttribute("placeholder")] = campo.value
                })
                console.log(mensajecliente)
                ///////////////////////////// En primer lugar inserto cliente ////////////////////////////////
                fetch("../servidor/?o=insertar&tabla=clientes", {     // lLamo a crear un nuevo registro
                  method: 'POST', 
                  headers: {
                    'Content-Type': 'application/json', 
                  },
                  body: JSON.stringify(mensajecliente)
                })                                                  // Al fetch le envio los datos que quiero insertar
                .then(function(response){
                    return response.json()                          // Ahora mismo no hace nada
                })
                .then(function(datos){
                    console.log(datos)                              // Lanzo los datos por pantalla para debug (quitar)
                    let idinsertado = datos.identificador
                    console.log(datos.identificador)
                    const today = new Date();
                    const yyyy = today.getFullYear();
                    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                    const dd = String(today.getDate()).padStart(2, '0');

                    const formattedDate = `${yyyy}-${mm}-${dd}`;
                    
                    let mensaje = {"Identificador":0,"fecha":formattedDate,"clientes_razonsocial":idinsertado}
                    console.log(mensaje)
                    fetch("../servidor/?o=insertar&tabla=pedidos", {     // lLamo a crear un nuevo registro
                          method: 'POST', 
                          headers: {
                            'Content-Type': 'application/json', 
                          },
                          body: JSON.stringify(mensaje)
                        })                                                  // Al fetch le envio los datos que quiero insertar
                        .then(function(response){
                            return response.json()                          // Ahora mismo no hace nada
                        })
                        .then(function(datos){
                            console.log(datos)
                        })
                    
                })
            }
            destino.appendChild(procesaenvia)
        })
    }
    
    destino.appendChild(procesa)
    
}




