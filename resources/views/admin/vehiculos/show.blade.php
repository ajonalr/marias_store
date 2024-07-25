@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title text-uppercase">DATOS DE VEHICULO</h4>
               <ul class="nav nav-pills mb-3 justify-content-end">
                  <li class="nav-item"><a href="#navpills2-1" class="nav-link active show" data-toggle="tab" aria-expanded="false">DATOS</a>
                  </li>
                  <li class="nav-item"><a href="#navpills2-2" class="nav-link" data-toggle="tab" aria-expanded="false">ACTUALIZAR</a>
                  </li>
               </ul>
               <div class="tab-content br-n pn">

                  <div id="navpills2-1" class="tab-pane active show">
                     <div class="row align-items-center">
                        <div class="col-sm-6 col-md-8 col-xl-10">
                           <p class="card-text text-uppercase">PLACA: <b>{{$vehiculo->placa}}</b> </p>
                           <p class="card-text">DESCRIPCION: </p>
                           @php echo $vehiculo->descripcion; @endphp

                           <br>
                           <p class="card-text mt-3">TIPO: <b> {{$vehiculo->tipo}}</b> </p>
                           <p class="card-text">COSTO: <b>Q. {{number_format($vehiculo->costo, 2)}}</b> </p>

                           <p class="card-text">FECHA DE MANTENIMEINTO: <b> {{$vehiculo->matenimiento}}</b> </p>

                           <p class="card-text">ULTIMA FECHA DE ACTULIZACION: <b>{{$vehiculo->updated_at}}</b> </p>
                        </div>
                        
                     </div>
                  </div>

                  <div id="navpills2-2" class="tab-pane ">
                     <div class="row align-items-center ">
                        <div class="col">
                           <form action="{{route('vehiculos.update', ['id' => $vehiculo->id])}}" method="post">
                              @csrf
                              @method('put')
                              @include('admin.vehiculos.forms.formupdate')

                              <button type="submit" class="btn btn-warning"><i class="fa fa-refresh" aria-hidden="true"></i> ACTUALIZAR</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('plugins/ckeditor/ckeditor.js')  }}"></script>
<script>
   CKEDITOR.replace('editor1');
</script>
@endsection