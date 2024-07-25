@extends('layouts.admin')

@section('content')

<div class="container-fluid">
   <div class="d-flex justify-content-around ">
      <div class="shadow p-3 mb-5 bg-light rounded">
         CAJA INDEPENDIENTE
      </div>
      <div>
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
            NUEVO REGISTRO
         </button>

         <!-- Modal -->
         <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">REGISTRO DE CAJA INDEPENDIENTE</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form action="{{route('cajai.store')}}" method="post">
                     @csrf
                     @method('POST')
                     <div class="modal-body">

                        <div class="form-group">
                           <label for="">TIPO</label>
                           <select class="form-control" name="tipo">
                              <option value="ENTRADA">ENTRADA</option>
                              <option value="SALIDA">SALIDA</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="valor">VALOR</label>
                           <input type="number" step="any" class="form-control" name="valor" placeholder="VALOR DE CAJA">
                        </div>

                        <div class="form-group">
                           <label for="valor">DESCRIPCION</label>
                           <input type="text" class="form-control" name="descripcion" placeholder="DESCRPICION DE CAJA">
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> GUARDAR</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-9">

         <div class="card">
            <div class="card-body">

               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Tipo</th>
                           <th>Descripcion</th>
                           <th>Valor</th>
                           <th>Fecha</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        $t_e=0;
                        $t_s=0;
                        @endphp
                        @foreach ($data as $d)
                        @php
                        if ($d->tipo === 'ENTRADA') {
                        $t_e += $d->valor;
                        }
                        if ($d->tipo === 'SALIDA') {
                        $t_s += $d->valor;
                        }
                        @endphp
                        <tr>
                           <td>{{$d->tipo}}</td>
                           <td>{{$d->descripcion}}</td>
                           <td>{{$d->valor}}</td>
                           <td>{{$d->created_at}}</td>
                           <td>
                              <form action="{{route('cajai.destroy', ['id' => $d->id])}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <a class="btn btn-primary" href="{{route('cajai.show', ['id' => $d->id])}}" method="post"><i class="fas fa-edit    "></i></a>
                                 <button type="submit" onclick="return confirm('Estas Seguro de Eliminar?')" class="btn btn-warning" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                           </td>
                        </tr>
                        @endforeach

                     </tbody>
                  </table>
               </div>

            </div>
         </div>


      </div>

      <div class="col-md-3">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">TOTAL ENTRADAS: Q. {{number_format($t_e, 2)}} </h4>
            </div>
         </div>

         <div class="card">
            <div class="card-body">
               <h4 class="card-title">TOTAL SALIDAS: Q. {{number_format($t_s, 2)}} </h4>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection