@extends('layouts.master')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title text-center">Lista de Usuario</h2><br>

        <div class="col-md-12 p-3 form-inline">

        <form method="GET" action="{{ url('/usuarios-records') }}">
          
          <input type="text" class="form-control" name="value" id="value">

          <button class="btn btn-primary ml-2" type="submit" ><i class="fas fa-search mr-1"></i>Buscar</button>
      </form>

            <!-- <input type="text" class="form-control"> -->
            <!-- <button class="btn btn-primary ml-2"><i class="fas fa-search mr-1"></i>Buscar</button> -->

            <a href="{{ url('/usuario-create') }}" class="btn btn-primary ml-2">Nueva Usuario</a>
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
                    <th>Nombre Usuario</th>
                    <th>Estaos</th>
                    <th>Nivel</th>
                   
                </thead>
                <tbody>
                    @foreach ($usuario as $item)
                        <tr>
                            <td>{{$item->IdUsuario}}</td>
                            <td>{{$item->nom_usuario}}</td>
                            <td>{{$item->estado}}</td>
                            <td>{{$item->nivel}}</td>
                            
                            <td>
                                <a href="#ex1" rel="modal:open" onclick="cargar('{{$item->IdUsuario}}','{{$item->nom_usuario}}','{{$item->clave}}','{{$item->nivel}}','{{$item->estado}}','{{$item->IdEmpleado}}')" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-1"></i>Editar</a>  
                                <a href="/usuarios-delete/{{$item->IdUsuario}}" class="btn btn-sm btn-danger"><i class="fas fa-edit mr-1"></i>Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>


    <div id="ex1" class="modal" >
    <h4>Editar Usuario</h4>
                <form method="POST" action="{{ route('usuario-store') }}">
                    {!! csrf_field() !!}

                    <div class="form-row">
                <div class="form-group col-md-6">
                <input type="hidden" class="form-control" id="IdEmpleado" name="IdEmpleado" value="">
                    <input type="hidden" class="form-control" id="IdUsuario" name="IdUsuario" value="">
                    <label for="marca">Nombre</label>
                    <input type="text" class="form-control" id="usuario" required name="usuario" value="" placeholder="Nombre Usuario"> 
                </div>
                <div class="form-group col-md-6">
                    <label for="modelo">Nivel</label>
                    <input type="text" class="form-control" id="nivel" required name="nivel" value="" placeholder="Nivel">
                </div>
                <div class="form-group col-md-6">
                    <label for="modelo">Estados</label>
                    <input type="text" class="form-control" id="estado" required name="estado" value="" placeholder="Nivel">
                </div>
                <div class="form-group col-md-6">
                    <label for="modelo">Clave</label>
                    <input type="text" class="form-control" id="password" required name="password" value="" placeholder="Clave">
                </div> 
             
                <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Editar Usuario</button>
                </div>
            </div>                
                </form>
            </div>

           
        </div>
    </div>
</div>

<script>
    function openEditMoo(){
        $('#editmoto').modal('show');
    }
</script>
<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1050;
  display: none;
  width: 100%;
  height: 60% !important;
  overflow: hidden;
  outline: 0;
}
    </style>
<script>
function cargar(a,b,c,e,d,f){
   // alert(a);
   // alert(b);
   $("#IdUsuario").val(a);
   $("#usuario").val(b);
   $("#password").val(c); 
   $("#nivel").val(e);
   $("#estado").val(d);
   $("#IdEmpleado").val(f);

    
   
  
  
}
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

@stop
