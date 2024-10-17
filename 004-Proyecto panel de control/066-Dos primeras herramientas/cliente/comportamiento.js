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
    
     /////////////////////////// ENVIAR CORREO ////////////////////////////////
    let botonenviarcorreo = document.querySelector("#enviarcorreo")
    
    botonenviarcorreo.onclick = function(){
        let nombre = document.querySelector("#nombre").value
        let correo = document.querySelector("#correo").value
        let mensaje = document.querySelector("#mensaje").value
        
        let paquete = {
            "nombre":nombre,
            "correo":correo,
            "mensaje":mensaje
        }
        console.log(paquete)
        fetch("../servidor/?o=mail", {     // lLamo a crear un nuevo registro
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json', 
          },
          body: JSON.stringify(paquete)
        })
        .then(function(response){
            return response.text()  
        })
        .then(function(datos){
            console.log(datos)
        })
    }
    
    /////////////////////////// ENVIAR CORREO ////////////////////////////////
    
}

function pueblaCarrito(){
    document.querySelector("#carrito").innerHTML = ""                       // En primer lugar vacio el carrito
    let plantilla = document.querySelector("#plantilla_itemproducto");      // Cargo la plantilla de un elemento del carrito
    let destino = document.querySelector("#carrito");                       // Indico donde voy a poner esa plantilla 
    
    let suma = 0;                                                           // inicializo la suma del carrito que es cero
    
    carrito.forEach(function(producto){                                     // Para cada uno de los elementos del carrito
        let instancia = document.importNode(plantilla.content,true);        
        instancia.querySelector("h4").textContent = producto.nombre
        instancia.querySelector("p").textContent = producto.descripcion
        instancia.querySelector("h5").textContent = producto.precio
        destino.appendChild(instancia);                                     // Pongo el producto en el template
        suma += parseFloat(producto.precio)                                 // Actualizo el total del pedido
    })
    
    let totales = document.createElement("div")                             // Creo un elemento
    totales.textContent = suma.toFixed(2)+" €";
    totales.style.textAlign = "right"
    destino.appendChild(totales)                                            // Le pongo el total al pedido
    
    let procesa = document.createElement("button")                          // Creo un boton
    procesa.classList.add("boton")
    procesa.textContent = "Procesar pedido";                                // Le pongo texto al boton
    
    procesa.onclick = function(){                                           // Esto es lo que ocurre cuuando pulso el boton de procesar
        console.log("vamos a procesar el pedido")
        document.querySelector("#carrito").innerHTML = ""                   // Vaciamos el carrito
        let titulo = document.createElement("h3")                           // Pongo un titulo
        titulo.textContent = "Introduce tus datos de cliente"
        destino.appendChild(titulo)                                         // Añado el titulo
        fetch("../servidor/?o=columnas&tabla=clientes")                     // Recupero el modelo de datos de cliente
        .then(function(response){
            return response.json()
        })
        .then(function(datos){
            let campos = []                                                 // Creo un array vacio
            datos.forEach(function(dato){                                   // Para cada uno de los campos
                campos.push(document.createElement("input"))                // Creo un elemento de formulario
                campos[campos.length-1].setAttribute("placeholder",dato.Field)
                destino.appendChild(campos[campos.length-1])
            })
            let procesaenvia = document.createElement("button")             // Creo un boton de enviar
            procesaenvia.classList.add("boton")
            procesaenvia.textContent = "Enviar";
            procesaenvia.onclick = function(){                              // cuando pulse el boton
                console.log("Ahora si que la vamos a liar muy parda")
                let mensajecliente = {}                                     // Formateo un objeto
                campos.forEach(function(campo){                             // PAra cada uno de los campos
                    mensajecliente[campo.getAttribute("placeholder")] = campo.value // Meto el campo en el objeto
                })
                console.log(mensajecliente)
                
                ///////////////////////////// En primer lugar inserto cliente ////////////////////////////////
                
                fetch("../servidor/?o=insertar&tabla=clientes", {     // Envio los datos de cliente al servidor
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
                    let idinsertado = datos.identificador           // Atrapo el id de cliente insertado
                    console.log(datos.identificador)
                    const today = new Date();                       // Formteo una nueva fecha para el pedido
                    const yyyy = today.getFullYear();
                    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                    const dd = String(today.getDate()).padStart(2, '0');

                    const formattedDate = `${yyyy}-${mm}-${dd}`;
                    
                    ///////////////////////////// En segundo lugar inserto pedido ////////////////////////////////
                    
                    let mensaje = {"Identificador":0,"fecha":formattedDate,"clientes_razonsocial":idinsertado} // Creo un mensaje para el epdido
                    console.log(mensaje)
                    fetch("../servidor/?o=insertar&tabla=pedidos", {     // lEnvio el mensaje para insertar pedido
                          method: 'POST', 
                          headers: {
                            'Content-Type': 'application/json', 
                          },
                          body: JSON.stringify(mensaje)
                        })                                                  // Al fetch le envio los datos que quiero insertar
                        .then(function(response){
                            return response.json()                          // Ahora mismo no hace nada
                        })
                        .then(function(datos){                                              // Cuando el servidor me responde
                            console.log(datos)
                        
                            ///////////////////////////// En tercer lugar inserto lineas de pedido ////////////////////////////////
                        
                            let idpedido = datos.identificador                              // Obtengo el id de pedido
                            carrito.forEach(function(productocarrito){                      // PAra cada uno de los productos en el carrito
                                let mensajeproductocarrito = {}                             // Creo un mensaje
                                mensajeproductocarrito.Identificador = 0
                                mensajeproductocarrito.pedidos_fecha = idpedido
                                mensajeproductocarrito.productos_nombre = productocarrito.identificador
                                mensajeproductocarrito.cantidad = 1
                                console.log(mensajeproductocarrito)
                                fetch("../servidor/?o=insertar&tabla=lineaspedido", {     // Envio el mensaje al servidor para insertar linea de pedido
                                  method: 'POST', 
                                  headers: {
                                    'Content-Type': 'application/json', 
                                  },
                                  body: JSON.stringify(mensajeproductocarrito)
                                }) 
                            })
                        setTimeout(function(){
                            destino.innerHTML = "<div class='ok'>👍</div><h3>Pedido correctamente realizado</h3>"
                            
                            setTimeout(function(){
                                destino.style.display = "none"
                                carrito = []
                            },5000)
                        },1000)
                    })
                    
                })
            }
            destino.appendChild(procesaenvia)
        })
    }
    
    destino.appendChild(procesa)
    
    
   
    
}




