@extends('layouts.app')

@section('content')
<div class="container-fuild p-5">
   <div class="row">
      <div class="col">
         <h4 class="card-title text-center h1">ACREEDORES</h4>
         <div class="card">
            <div class="card-body">
               <table class="table table-hover" id="table_id" data-page-length="15">
                  <thead>
                     <tr>
                        <th># Codigo</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Direccion</th>
                        <th>Total En Deuda</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>

                     <?php $t_d = 0; ?>
                     @foreach ($data as $d)
                     @if ($d['f']->total_deuda - $d['a']->total_abono > 0)
                     <tr>
                        <td>{{$d['p']->id}}</td>
                        <td>{{$d['p']->nombre}}</td>
                        <td>{{$d['p']->empresa}}</td>
                        <td>{{$d['p']->direccion}}</td>
                        <td>
                           <?php $t_d += $d['f']->total_deuda - $d['a']->total_abono; ?>
                           Q. {{number_format($d['f']->total_deuda - $d['a']->total_abono,2)}}
                        </td>
                        <td>
                           <a class="btn btn-primary" href="{{route('prove.show', ['id' => $d['p']->id])}}">
                              <i class="fa fa-eye" aria-hidden="true"></i>
                           </a>
                        </td>
                     </tr>
                     @endif
                     @endforeach
                  </tbody>
               </table>
               <p class="h3 text-center">Q. {{number_format($t_d, 2)}}</p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection