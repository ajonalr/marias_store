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

                <div align="center">
                    <img src="{{asset('logos/recibo.png')}}" alt="{{config('app.name', 'DeCoDev')}}" class="img-fluidd mt-4" style="border-radius: 25px; width: 111px !important; height: 111px !important;" alt="">
                </div>


                <div class="col-8">



                    <div align="center">
                        <div style="font-size: 20px;">
                            <p class="text-uppercase text-center">
                                {{config('app.direccion')}}
                            </p>
                            <p class="text-center">
                                Teléfono 1: <span class="text-info">{{config('app.telefono')}}</span> <br>
                            </p>
                        </div>
                    </div>

                    <div align="center">

                        <h3 class="text-capitalize text-center">Datos De Venta</h3>
                        <div class="text-right" style="font-size: 20px;">
                            <p class="text-uppercase text-center">
                                <b class="text-danger">Recibo No. 000{{$factura->id}}</b><br>
                                Fecha de Venta: {{$fecha}} <br>
                                Vendedor: {{$usuario}}
                            </p>
                        </div>
                    </div>
                </div>

            </div>



            <div align="center">


                <p>Nombre: {{$cliente}} <span class="text-rigth"> <br> Nit: {{$nit}} </span> </p>

                <?php $t =0; ?>
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
                            <td class="precio">Q.{{number_format($deu->total, 2)}} <?php $t += $deu->total; ?></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>




            <div class="row" style="text-align: center; margin-top: 2%">


                @if($factura->descripcion)
                Descripcion: {{$factura->descripcion}}
                @endif


                <div class="col">

                    <h5 class="text-right text-info">
                        <p>Total de Venta: Q. {{number_format($t, 2)}}</p>
                        @if (($descuetoArticulos + $factura->descuento) > 0)
                        <p>Total Descuentos: Q. {{$descuetoArticulos + $factura->descuento}}</p>
                        @endif
                        <p>Total a Cancelar: Q. {{ number_format($t, 2) }}</p>

                    </h5>
                </div>
            </div>

            <!-- <p>NO SÉ ACEPTAN CAMBIOS NI DEVOLUCIONES</p> -->

            <p class="centrado">{{config('app.slogan') }}
                <br>{{config('app.name') }}
            </p>

            <p class="centrado">ES UN GUSTO SERVIRLE</p>


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