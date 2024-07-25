<!-- Modal -->
<div class="modal fade oculto-impresion" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">INGRESAR ABONO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('abp.store')}}" method="post">
            @csrf
            <div class="modal-body">

               <input type="hidden" value="{{$proyecto->id}}" name="proyecto_id">

               <div class="form-group">
                  <label for="">TIPO DE ABONO</label>
                  <select class="form-control" name="tipo">
                     <option value="EFECTIVO">EFECTIVO</option>
                     <option value="VISA">VISA</option>
                     <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                     <option value="DEPOSITO">DEPOSITO</option>
                     <option value="OTRO">OTRO</option>
                  </select>
               </div>

               <div class="form-group">
                  <label for="">VALOR</label>
                  <input type="number" class="form-control" name="valor" step="any">
               </div>

               <div class="form-group">
                  <label for="">DESCRIPCION</label>
                  <textarea class="form-control" name="descripcion" rows="3"></textarea>
               </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i>CANCELAR
               </button>
               <button type="submit" class="btn btn-primary"> <i class="fas fa-save "></i> GUARDAR</button>
            </div>
         </form>
      </div>
   </div>
</div>


<div class="row">
   <div class="col">
      <div class="table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>TOTAL</th>
                  <th>TIPO</th>
                  <th>DESCRIPCION</th>
                  <th>FECHA DE ABONO</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($abonos as $ab)
               <tr>
                  <td>{{$ab->id}}</td>
                  <td>Q. {{number_format($ab->valor, 2)}}</td>
                  <td>{{$ab->tipo}}</td>
                  <td>{{$ab->descripcion}}</td>
                  <td>{{$ab->created_at}}</td>

                  <td>
                     <form action="{{route('abp.destroy', ['id' =>$ab->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-primary" href="{{route('abp.print_abono', ['id' =>$ab->id])}}" role="button"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>

      <h1 class=text-center>TOTAL ABONADO: <span class="badge badge-secondary">Q. {{number_format($t_abono, 2)}}</span></h1>

   </div>
</div>