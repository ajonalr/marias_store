<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="style.css">
   <title>{{config('app.name')}}</title>
   <!-- <link rel="shortcut icon" href="{{asset('assets/images/logo.ico')}}" type="image/x-icon"> -->
   <link rel="shortcut icon" href="{{asset('assets/images/logo.ico')}}" type="image/x-icon">


</head>



<body id="imp1" align="center">
   <div class="ticket" align="center">
      <div class="row">

         <img src="{{asset('logos/recibo.png')}}" alt="{{config('app.name', 'DeCoDev')}}" class="img-fluidd mt-4" style="border-radius: 25px;    width: 273px !important;  height: 95px !important;" alt="">

         <div class="col-8">


            <br>


            <div align="center">
               <div style="font-size: 20px;">
                  <p class="text-uppercase text-center">
                     {{config('app.direccion')}}
                  </p>
                  <p class="text-center">
                     TELEFONO: <span class="text-info">{{config('app.telefono')}}</span>
                  </p>
               </div>
            </div>


            <br>
            <div align="center">
               <div class="text-right" style="font-size: 20px;">
                  <p class="text-uppercase text-center">
                     <b class="text-danger">RECIBO. 000{{$ab->id}}</b><br>
                     FECHA: {{$ab->created_at }} <br>
                  </p>
               </div>
            </div>
         </div>

      </div>

      <br>



      <p>NOMBRE: {{$pc->cliente->nombre}} <span class="text-rigth"> <br> </span> </p>
      <p>TELEFONO: {{$pc->cliente->telefono1}} <span class="text-rigth"> <br> </span> </p>
      <p>DIRECCION: {{$pc->cliente->direccion}} <span class="text-rigth"> <br> </span> </p>
      <br>
      <div align="center">
         <table>
            <thead>
               <tr>
                  <th class="cantidad">TIPO</th>
                  <th class="producto">DESCRIPCION</th>
                  <th class="precio">TOTAL</th>
               </tr>
            </thead>
            <tbody>
               <tr></tr>
               <tr>
                  <td class="cantidad">{{$ab->tipo}}</td>
                  <td class="producto">{{$ab->descripcion}}</td>
                  <td class="precio">Q.{{$ab->valor}}</td>
               </tr>
            </tbody>
         </table>

      </div>



      <div class="row">
         <div class="col">
            <h5 class="text-right text-info">
               ABONADO: Q. {{number_format($ab->valor, 2)}}
            </h5>
         </div>
      </div>

      <p>
         <b>-IMPORTANTE GUARDA TU RECIBO <br>

         </b>
      </p>




      <p class="centrado">
         {{config('app.slogan')}}
         <br>{{config('app.name') }} / DeCoDev Desarrollo de Software
      </p>





   </div>

   <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
   <!-- <button class="oculto-impresion" onclick="javascript:imprim1(imp1);">Imprimir</button> -->

   <style>
      @media print {

         .oculto-impresion,
         .oculto-impresion * {
            display: none !important;
         }
      }

      * {
         font-size: 17px;
         font-family: 'Times New Roman';
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
         width: 165px;
         max-width: 165px;
      }

      td.cantidad,
      th.cantidad {
         width: 60px;
         max-width: 60px;
         word-break: break-all;
      }

      td.precio,
      th.precio {
         width: 50px;
         max-width: 50px;
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
         margin: 0px;
      }
   </style>
   <script>
      function imprimir() {
         window.print();
      }

      function imprim1(imp1) {
         var printContents = document.getElementById('imp1').innerHTML;
         w = window.open();
         w.document.write(printContents);
         w.document.close(); // necessary for IE >= 10
         w.focus(); // necessary for IE >= 10
         w.print();
         w.close();
         return true;
      }
   </script>


</body>

</html>