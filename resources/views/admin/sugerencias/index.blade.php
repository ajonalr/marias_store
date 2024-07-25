@extends('layouts.admin')

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">




         <!-- Modal -->
         <div class="modal fade" id="SUGERENCIAS" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">

                     <form action="{{route('suge.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="">ARTICULOS PARA SUGERENCIAS</label>
                           <textarea class="form-control" name="articulo" rows="5" col="60"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> GUARDAR</button>
                     </form>


                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>


         <div class="card">
            <div class="card-body">


               <div class="d-flex justify-content-around">
                  <div class="p-2">
                     <h4 class="card-title">ARTICULOS SUGERIDOS</h4>
                  </div>
                  <div class="p-2">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#SUGERENCIAS">
                        NUEVA SUGERENCIA
                     </button>
                  </div>
               </div>

               <div class="table-responsive">

                  <table class="table">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>SUGERENCIA</th>
                           <th>FECHA DE SUGERENCIA</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($data as $d )
                        <tr>
                           <td>{{$d->id}}</td>
                           <td>{{$d->articulo}}</td>
                           <td>{{$d->created_at}}</td>
                           <td>
                              <form action="{{route('suge.destroy', ['id' => $d->id] )}}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <div class="alert alert-info" role="alert">
                              <strong>NO EXISTEN DATOS</strong>
                           </div>
                        </tr>
                        @endforelse


                     </tbody>
                  </table>
               </div>

            </div>
         </div>

      </div>
   </div>
</div>

@endsection