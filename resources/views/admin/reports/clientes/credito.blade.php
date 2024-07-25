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
        width: 175px;
        max-width: 175px;
    }

    td.cantidad,
    th.cantidad {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.precio,
    th.precio {
        width: 40px;
        max-width: 40px;
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
                    <img src="{{asset('logos/main.png')}}" alt="{{config('app.name', 'DeCoDev')}}" class="img-fluidd mt-4" style="border-radius: 25px; width: 160px !important; height: 125px !important;" alt="">
                </div>


                <div class="col-8">



                    <div align="center">
                        <div style="font-size: 20px;">
                            <p class="text-uppercase text-center">
                                {{config('app.direccion')}}
                            </p>
                            <p class="text-center">
                                Teléfono 1: <span class="text-info">{{config('app.telefono')}}</span> <br>
                                Teléfono 2: <span class="text-info">{{config('app.telefono2')}}</span>
                            </p>
                        </div>
                    </div>

                    <div align="center">

                        <h3 class="text-capitalize text-center">Datos De Credito</h3>
                        <div class="text-right" style="font-size: 20px;">
                            <p class="text-uppercase text-center">
                                <b class="text-danger">Credito No. 000{{$data->id}}</b><br>
                                Fecha de Venta: {{$data->created_at}} <br>
                            </p>
                        </div>
                    </div>
                </div>

            </div>



            <div align="center">


                <p>Nombre: {{$data->cliente->nombre}} <span class="text-rigth"> <br> Nit: {{$data->cliente->nit}} </span> </p>

                <h2>Dato de Credito</h2>

                <div class="card">
                    <p class="card-text">{{$data->descripcion}}</p>
                </div>

            </div>




            <div class="row" style="text-align: center; margin-top: 2%">



                <div class="col">

                    <h5 class="text-right text-info">
                       
                        Total a de Credito: Q. {{ number_format($data->total, 2) }}

                    </h5>
                </div>
            </div>

            <p>NO SÉ ACEPTAN CAMBIOS NI DEVOLUCIONES</p>

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