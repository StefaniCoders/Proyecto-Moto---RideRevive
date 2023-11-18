@extends('layouts.master')
@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title text-center">Horario de Atenciones<h2><br>        
        <hr><br>
        <div class="row">
            <div class="col-md-3">
                <h2 class="card-title text-center">Lista de Servicios<h2><br>
                @foreach ($categoria as $item)
                <h5><i class="fa fa-circle" style="color: {{$item->color}}"></i> {{$item->descripcion}}</h5>
                @endforeach       
                <br>         
            <p style="font-size:15px"> Seleccione la Fecha</p> 
                <input type="text" id="fecha369" value="" onchange="fecha()" style="font-size:13px;widt:50px">
               
            </div>
            
            <div class="col-md-9" style="font-size: 14px">
                <div id="agenda"></div>
            </div>
        </div>
    </div>
</div>

<script>
function fecha(){
location.reload();
}
    </script>

<!-- BEGIN MODAL -->
<div class="modal fade" id="evento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Fecha a Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('horario-store') }}">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="empleado">Empleado</label>
                        <!-- <input id="empleado" class="form-control" type="text" name="empleado"> -->

                        <select class="form-control" id="empleado" name="empleado">
                            @foreach ($empleados as $item)
                            <option value="{{ $item->IdEmpleado }}">{{ $item->Nombres }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <!-- <input id="categoria" class="form-control" type="text" name="categoria"> -->
                        <select class="form-control" id="categoria" name="categoria">
                            @foreach ($categoria as $item)
                            <option value="{{ $item->IdCategoria }}">{{ $item->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start">Fecha </label>
                        <input id="start" class="form-control" type="text" name="start">
                    </div>
                    <div class="form-group">
                        <label for="start">Costo </label>
                        <input id="costo" class="form-control" type="text" name="costo">
                     
                    </div>
                    <div class="form-group" id="datos">
                        <label >Cantidad </label>
                       <h5 id="cantidad"></h5>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                <!-- <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
                <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button> -->
            </div>
        </div>
    </div>
</div>



</div>
</div>


@stop


