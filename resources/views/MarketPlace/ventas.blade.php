@extends('layouts.app')

@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data"  action="{{ route('productos.store') }}" >
      @csrf

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agrega un colaborador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <label>Titulo</label>
            <input type="text"  class="form-control" required="" name="titulo">
            <br><br>

            <label>Precio</label>
            <input type="number" required class="form-control" name="precio">

             <br><br>
            <label>Whatsapp</label>
            <input type="number" required class="form-control" name="ws">

            <br><br>
            <label>Tu nombre</label>
            <input type="text" required class="form-control" name="nombre">

            <br><br>
            <label>Descripción</label>
            <textarea class="form-control" name="des"></textarea>

            <div class="form-group">
              <br>
              <label>Agrega fotos</label><br>
              <input type="file" name="fotos[]" multiple="true" required  >
            </div>


         </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-window-close"></i></button>
        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i></button>
      </div>
    </div>
    </form>
  </div>
</div>







<div class="container">
      @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif

      @if(session('delete'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session('delete')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
           <br>
           <h3>Productos</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item "><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
          </nav>
        </div>


        <div class="col-md-4 text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
           <i class="fas fa-plus"></i>
        </button>
        </div>

     </div>


   <div class="col-md-12">
          @if(count($productos)>0)
            <table id="table" class="table">
              <thead class="thead-dark">
                <tr>
                  <th width="40" scope="col">#</th>
                  <th width="250" scope="col">Titulo</th>
                  <th width="40" scope="col">Precio</th>
                  <th width="60" scope="col">Estado</th>
                  <th width="40" scope="col">Editar</th>
                  <th width="40" scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($productos as $key => $value)
                  @php
                  $color = "";
                    if ($value->estado == "publicado") {
                      $color = "#EFDEDA";
                    }else if($value->estado == "pendiente"){
                      $color = "#E5EFDA";
                    }
                  @endphp
                <tr style="background-color: {{$color}}">
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$value->titulo}}</td>
                  <td>${{$value->precio}}</td>
                  <td>{{$value->estado}}</td>
                    <td>
                      <a href="{{ route('productos.edit', $value->id) }}" class="btn btn-warning "><i class="far fa-edit"></i></a>
                    </td>

                    <td>
                        <form method="POST" action="{{ route('productos.destroy', $value->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="delete" />
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                       </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
             <hr>
              <h3>No hay productos por el momento...</h3>
            @endif

        </div>



</div>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table').DataTable();
} );






@endsection
