<!doctype html>
<html lang="es">
    <head>
        <title>Factura</title>
        <meta charset="utf-8">
        <style>
            body{
                background:rgb(220,220,220);
            }
            header,main,footer{
                width:800px;
                margin:auto;
                background:white;
                padding:20px;
                font-family: sans-serif;
            }
            header section{
                width:47%;
                display:inline-block;
                border:1px solid grey;
                box-sizing: border-box;
                padding:10px;
                margin:10px;
                border-top:20px solid grey;
                position: relative; 
            }
            header section::before {
                content: attr(data-text); /* Use custom text from data attribute */
                position: absolute;
                top: -15px; /* Position above the top border */
                left: 10px;
                padding: 0 5px;
                font-size: 12px;
                color: white;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <header>
            <section id="emisor" data-text="Emisor">
                <h1>Razon Social</h1>
                <h2>Direccion</h2>
                <h3>CP y Población</h3>
                <h4>Identificacion fiscal</h4>
            </section>
            <section id="receptor" data-text="Receptor">
                <h1>Razon Social</h1>
                <h2>Direccion</h2>
                <h3>CP y Población</h3>
                <h4>Identificacion fiscal</h4>
            </section>
            <section id="fecha" data-text="Fecha de la factura">
                Fecha de la factura
            </section>
            <section id="numerofactura" data-text="Número de la factura">
                Número de la factura
            </section>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Producto 1</td>
                        <td>4.30</td>
                        <td>4.30</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            <table>
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Producto 1</td>
                        <td>4.30</td>
                        <td>4.30</td>
                    </tr>
                </tbody>
            </table>
            <section id="comentarios">
                Esto es un comentario
            </section>
        </footer>
    </body>
</html>