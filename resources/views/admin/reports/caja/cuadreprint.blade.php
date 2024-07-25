<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="style.css">
   <title>Recibo</title>
   <!-- <link rel="shortcut icon" href="{{asset('assets/images/logo.ico')}}" type="image/x-icon"> -->
   <link rel="shortcut icon" href="{{asset('assets/images/logo.ico')}}" type="image/x-icon">
   <script src="{{asset('assets/theme/js/fontaweson.js')}}" crossorigin="anonymous"></script>


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
      font-family: 'Times New Roman';
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
      margin: 0px;
   }
</style>

<body align="center">
   <div class="ticket">
      <div class="row">

         <img src="{{asset('logos/recibo.png')}}" alt="{{config('app.name', 'DeCoDev')}}" class="img-fluidd mt-4" style="border-radius: 25px;    width: 273px !important;  height: 95px !important;" alt="">

         <div class="col-8">


            <!-- cambiar redes sociales -->
            <div align="center">

               <p> <b>CUADRE DE CAJA</b></p>

            </div>

            <div align="center">
               <div class="text-right" style="font-size: 20px;">
                  <p class="text-uppercase text-center">
                     <b class="text-danger">Cuadre No. 000{{$data->id}}</b><br>
                     Fecha de Venta: {{$data->created_at}} <br>
                  </p>
               </div>
            </div>
         </div>

      </div>



      <div align="center">
         <p><b>Total a Cuadrar</b>: Q. {{number_format($data->cuadre, 2)}}</p>
         ---------------

         <p>Caja Chica: Q. {{number_format($data->entrada, 2)}}</p>
         <p>Gastos: Q. {{number_format($data->salida, 2)}}</p>

         ----------
         <p>Depositos: Q. {{number_format($data->depositos, 2)}}</p>

         ---------------

         <p>Efectivo: Q. {{number_format($data->totalEfectico, 2)}}</p>
         <p>Visas: Q. {{number_format($data->totalVisas, 2)}}</p>

         ---------------
         <p>Faltante: Q. {{number_format($data->faltante, 2)}}</p>


      </div>



      <p class="centrado">
         <br>{{config('app.name') }}
      </p>





   </div>

   <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>


   <script>
      function imprimir() {
         window.print();
      }
   </script>

</body>

</html>
