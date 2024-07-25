<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>
</head>

<style>
    @media print {

        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
    }

    * {
        font-size: 12px;
        font-family: sans-serif;
        font-weight: 800;
    }

    img {
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.producto,
    th.producto {
        width: 150px;
        max-width: 150px;
    }

    td.cantidad,
    th.cantidad {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.precio,
    th.precio {
        width: 82px;
        max-width: 100px;
        word-break: break-all;
    }

    .centrado {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 285px;
        max-width: 357px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    p {
        margin-bottom: 0px;
        margin-top: 0px;
    }
</style>

<body>


    <div>
        <div class="ticket">
            <div class="row">

            Datos de Comanda
            </div>



            <div align="center">
                <table>
                    <thead>
                        <tr>
                            <th class="cantidad">CANT</th>
                            <th class="producto">PRODUCTO</th>
                            <th class="precio">Sub. Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($deuda as $deu)

                        <tr>#
                            <td class="cantidad">{{$deu->cantidad}}</td>
                            <td class="producto">{{$deu->nomArt}}
                                @php
                                echo $deu->descripcion;
                                @endphp
                                {{$deu->catNombre}} Q.{{number_format($deu->total / $deu->cantidad, 2)}} </td>
                            <td class="precio">Q.{{number_format($deu->total, 2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>




       

        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>

    </div>


    <script>
        function imprimir() {
            window.print();
        }
    </script>



</body>

</html>