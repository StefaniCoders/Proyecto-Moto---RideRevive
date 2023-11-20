@extends('layouts.master')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title text-center">Lista de Categtorias</h2><br>

        <div class="col-md-12 p-3 form-inline">

            <form method="GET" action="{{ url('/buscarcategoria') }}">
          
                <input type="text" class="form-control" name="value" id="value">

                <button class="btn btn-primary ml-2" type="submit" ><i class="fas fa-search mr-1"></i>Buscar</button>
            </form>

            <a href="#modal-create-categoria" rel="modal:open" class="btn btn-primary ml-2">Nueva categoria</a>

        </div>

        <div class="col-md-12 p-20 m-2 border">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
            <table id="example" class="display" style="width:100%">
                <thead>
                    <th>CODIGO</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                @foreach ($categorias as $item)
                    <tr>
                        <td>{{$item->IdCategoria}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{$item->estado}}</td>
                        <td>{{$item->estado}}</td>
                        <td>
                        

<!-- Link to open the modal -->
                           <a href="#ex1" rel="modal:open" onclick="cargar({{$item->IdCategoria}},'{{$item->descripcion}}' )" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-1"></i>Editar</a>

                            <a href="/categoria-delete/{{$item->IdCategoria}}" class="btn btn-sm btn-danger"><i class="fas fa-edit mr-1"></i>Eliminar</a>
                        <td>
                    </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
</div>
</div>

<div id="ex1" class="modal" >
<form  method="POST" action="{{ route('categoria-store') }}">
             @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Descripcion Categoria</label>
                    <input type="text" class="form-control" id="descripcion" required name="descripcion" placeholder="Nombres" value="{{$categoria->descripcion??null}}">
                    <input type="hidden" class="form-control" id="IdCategoria" name="IdCategoria" value="{{$categoria->IdCategoria??null}}">
                </div>

            </div>

            <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
            <button type="submit" class="btn btn-primary"> {{isset($categoria)?"Actualizar":"Registrar"}} Categoria</button>
        </form>

 <br>
</div>


<div id="modal-create-categoria" class="modal" >
  <form  method="POST" action="{{ route('categoria-store') }}">
    @csrf
   <div class="form-row">
       <div class="form-group col-md-12">
          <label for="inputEmail4">Descripcion Categoria</label>
          <input type="text" class="form-control" id="descripcion" required name="descripcion" placeholder="Nombres">
       </div>
   </div>
   <button type="submit" class="btn btn-primary"> {{isset($categoria)?"Actualizar":"Registrar"}} Categoria</button>
</form>
  
   <br>
  </div>

<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1050;
  display: none;
  width: 100%;
  height: 40% !important;
  overflow: hidden;
  outline: 0;
}
    </style>

<script>
function cargar(a,b){
   // alert(a);
   // alert(b);
    $("#descripcion").val(b);
    $("#IdCategoria").val(a);
}
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@stop
