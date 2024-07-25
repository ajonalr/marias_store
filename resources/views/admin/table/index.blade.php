@extends('layouts.admin')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col card p-4">

         <div class="row justify-content-around">
            <div class="col-md-6">
               <div class="text-center h3">TABLAS</div>
            </div>
            <div class="col-md-6">
               <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">NUEVO</button>
            </div>
         </div>



         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>NOMBRE</th>
                  <th>FECHA</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($data as $d)
               <tr>
                  <td>{{$d->id}}</td>
                  <td>{{$d->nombre}}</td>
                  <td>{{$d->created_at}}</td>
                  <td>
                     <form action="{{route('table.destroy' , $d->id)}}" method="POST">
                        @csrf()
                        @method('DELETE')
                        <a class="btn btn-info" href="{{route('table.show', $d->id)}}"><i class="fa fa-eye" aria-hidden="true"></i> </a>

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>


         <!-- Modal -->
         <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">NUEVA TABLA</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form action="{{route('table.store')}}" method="post">
                     @csrf()
                     <div class="modal-body">
                        <div class="form-group">
                           <label for="">Nombre</label>
                           <input type="text" class="form-control" name="nombre">
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>


      </div>
   </div>
</div>
@endsection