@extends('layouts.master')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title text-center">Lista de Motos</h2><br>

        <div class="col-md-12 p-3 form-inline">

        <form method="GET" action="{{ url('/buscarMoto') }}">
          
          <input type="text" class="form-control" name="value" id="value">

          <button class="btn btn-primary ml-2" type="submit" ><i class="fas fa-search mr-1"></i>Buscar</button>
      </form>

            <!-- <input type="text" class="form-control"> -->
            <!-- <button class="btn btn-primary ml-2"><i class="fas fa-search mr-1"></i>Buscar</button> -->

            <a href="{{ url('/moto-create') }}" class="btn btn-primary ml-2">Nueva Moto</a>
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
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Estado</th>      
                    <th>Placa</th>      
                    <th>Descripci&oacute;n</th>            
                    <th>imgagen</th>
                </thead>
                <tbody>
                    @foreach ($motos as $item)
                        <tr>
                            <td>{{$item->IdMoto}}</td>
                            <td>{{$item->marca}}</td>
                            <td>{{$item->modelo}}</td>
                            <td>{{$item->color}}</td>
                            <td>{{$item->estado}}</td>
                            <td>{{$item->placa}}</td>
                            <td>{{$item->descripcion}}</td>
                            <td>
                            @if($item->photo==null)         
                               Sin imagen
                            @else
                            <img src="/public/uploads/{{ $item->photo}}" alt="" width="100">
                            @endif                              
                               
                            </td>
                            <td>
                                <a href="#ex1" rel="modal:open" onclick="cargar({{$item->IdMoto}},'{{$item->marca}}','{{$item->modelo}}','{{$item->color}}','{{$item->placa}}','{{$item->descripcion}}','{{$item->photo}}' )" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-1"></i>Editar</a>                         
                                <a href="/moto-delete/{{$item->IdMoto}}" class="btn btn-sm btn-danger"><i class="fas fa-edit mr-1"></i>Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>


    <div class="modal fade" id="editmoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Moto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('horario-store') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="empleado">Empleado</label>
                        <input id="empleado" class="form-control" type="text" name="empleado">
                    </div>                  
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>              
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>


<div id="ex1" class="modal" >
    <h4>Editar Moto</h4>
<form  method="POST" action="{{ route('moto-store') }}" enctype="multipart/form-data">
             @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="IdMoto" name="IdMoto" value="" style='display:none'>
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" required name="marca" value="" placeholder="marca"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" required name="modelo" value="" placeholder="modelo">
                </div>
                <div class="form-group col-md-4">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" required name="color" value="" placeholder="color">
                </div>
                <div class="form-group col-md-4">
                   
                    <label for="marca">Placa</label>
                    <input type="text" class="form-control" id="placa" required name="placa" value="" placeholder="placa"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Descripci&oacute;n</label>
                    <input type="text" class="form-control" id="descripcion" required name="descripcion" value="" placeholder="descripcion">
                </div>
          
                  <div class="form-group col-md-4">
                    <label for="inputAddress">Imagen</label>
                    <input id="inputTag" type="file"  name="file"/>
                          
                    <input id="editphoto" name="editphoto" type="text" value=""  style="display:none"/>
                            <div id="imagen" ></div>
                              
                </div>
            </div>            
            <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
            <button type="submit" class="btn btn-primary">Editar Moto</button>
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
  height: 60% !important;
  overflow: hidden;
  outline: 0;
}
    </style>

<script>
function cargar(a,b,c,e,d,f,z){
   // alert(a);
   // alert(b);
   $("#IdMoto").val(a);
   $("#marca").val(b);
    $("#modelo").val(c);
    $("#color").val(e);
    $("#placa").val(d);
    $("#descripcion").val(f);
    $("#editphoto").val(z);
    $("#imagen").html('<img src="/public/uploads/'+z+'" id="imagen" alt="" width="100">');
  
}
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

@stop
