@extends('layouts.master')
@section('contenido')
<div class="card">
    <div class="card-header">
        Nuevo Usuario
    </div>
    <div class="card-body">
        <form  method="POST" action="{{ route('usuario-store') }}" >
             @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" id="IdUsuario" name="IdUsuario" value="{{$usuario->IdUsuario??null}}">
                    <label for="marca">Nombre</label>
                    <input type="text" class="form-control" id="usuario" required name="usuario" value="{{$usuario->nom_usuario??null}}" placeholder="Nombre Usuario"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Nivel</label>
                    <input type="text" class="form-control" id="nivel" required name="nivel" value="{{$usuario->nivel??null}}" placeholder="Nivel">
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Clave</label>
                    <input type="text" class="form-control" id="password" required name="password" value="{{$usuario->clave??null}}" placeholder="Clave">
                </div> 
             
                <div class="form-group col-md-4">
                    <label for="marca">Empleado</label>
                   <select name="IdEmpleado" id="IdEmpleado"  class="form-control">
                    @foreach($empleado as $items)
                        @if(@$usuario->IdEmpleado == @$items->IdEmpleado )
                        <option value='{{  $items->IdEmpleado }}' selected>{{  $items->Nombres }} </option>
                        @else@
                        <option value='{{  $items->IdEmpleado }}'>{{  $items->Nombres }} </option>
                        @endif
                        @endforeach
                    </select>
                    
                </div>
               
            </div>            
            <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
            <button type="submit" class="btn btn-primary">Registrar Usuario</button>
        </form>        
    </div>
</div>
</div>
</div>
@stop