@extends('layouts.master')

@section('contenido')


<div class="card">
    <div class="card-header">
        <a href="{{ url('/categorias') }}" class="btn btn-sm btn-danger mr-2">Volver</a> Nuevo categoria
    </div>
    <div class="card-body">

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


    </div>

</div>
</div>
</div>
@stop
