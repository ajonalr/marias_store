@extends('layouts.admin')


@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <div class="text-center h3">TABLA: {{$data->nombre}}</div>

         <form action="{{route('table.update', ['id' => $data->id])}}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="">NOMBRE:</label>
              <input type="text" class="form-control" name="nombre"  value="{{$data->nombre}}">
            </div>

            <div class="form-group">
              <label for="">DATOS</label>
              <textarea class="form-control" name="dato" id="editor1" rows="3">{{$data->dato}}</textarea>
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-save    "></i> GUARDAR</button>

         </form>

      </div>
   </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor/ckeditor.js')  }}"></script>
<script>
   CKEDITOR.replace('editor1', {
      // uiColor: '#0B0D48',
   });
</script>

@endsection