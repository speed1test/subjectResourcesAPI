@extends('layouts.app')

@section('content')


<!-- Button trigger modal -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('keys.store') }}">
      @csrf

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva key</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <label>Key generada</label>
            <input type="text" class="form-control" required="" readonly="" value="{{$newKey}}" name="key">
            <br><br>
            <label>Anexo de key (opcional)</label>
            <input type="text" class="form-control"  name="anexo">

            <br><br>
            <label>Descripción</label>
            <textarea class="form-control" name="des"></textarea>
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

       @if(session('edit'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{Session('edit')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif


    <div class="row justify-content-center">
        <div class="col-md-8">
           <br>
           <h3>Keys</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Keys</li>
            </ol>
          </nav>
        </div>
        <div class="col-md-4 text-right">
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
        </button>

        </div>
        <hr>

        <div class="col-md-12">
            <table class="table">
              @if(count($keys) >0)
              <thead class="thead-dark">
                <tr>
                  <th width="40" scope="col">#</th>
                  <th scope="col">Key</th>
                  <th scope="col">Descripción</th>
                  <th width="40" scope="col">Consultar</th>
                  <th width="40" scope="col">Editar</th>
                  <th width="40" scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($keys as $key => $value)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$value->llave}}</td>
                  <td>{{$value->descripcion}}</td>
                  <td><a href="{{ route('materias.show', $value->id) }}" class="btn btn-info"><i class="far fa-eye"></i></a>
                  </td>
                  

                  <td><a href="{{ route('materias.edit', $value->id) }}" class="btn btn-warning "><i class="far fa-edit"></i></a></td>


                  <td><form method="POST" action="{{ route('materias.destroy', $value->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                  </form></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
             <hr>
              <h3>No hay keys por el momento...</h3>
            @endif
        </div>

    </div>
</div>
@endsection
