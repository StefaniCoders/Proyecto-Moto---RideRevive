@extends('layouts.master')
@section('contenido')
<div class="card">
    <div class="card-header">
        Nuevo Moto
    </div>
    <div class="card-body">
        <form  method="POST" action="{{ route('moto-store') }}" enctype="multipart/form-data">
             @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" id="IdMoto" name="IdMoto" value="{{$moto->IdMoto??null}}">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" required name="marca" value="{{$moto->marca??null}}" placeholder="marca"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" required name="modelo" value="{{$moto->modelo??null}}" placeholder="modelo">
                </div>
                <div class="form-group col-md-4">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" required name="color" value="{{$moto->color??null}}" placeholder="color">
                </div>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" id="IdMoto" name="IdMoto" value="{{$moto->IdMoto??null}}">
                    <label for="marca">Placa</label>
                    <input type="text" class="form-control" id="marca" required name="placa" value="{{$moto->placa??null}}" placeholder="placa"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Descripci&oacute;n</label>
                    <input type="text" class="form-control" id="descripcion" required name="descripcion" value="{{$moto->descripcion??null}}" placeholder="modelo">
                </div>
          
                  <div class="form-group col-md-4">
                    <label for="inputAddress">Imagen</label>
                    <input id="inputTag" type="file"  name="file"/>
                    @if(@$moto->photo==null)         
                               Sin imagen
                            @else
                            <input id="editphoto" name="editphoto" type="text" value="{{ $moto->photo}}"  style="display:none"/>
                            <img src="/public/uploads/{{ $moto->photo}}" alt="" width="100">
                            @endif       
                </div>
            </div>            
            <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
            <button type="submit" class="btn btn-primary">Registrar Moto</button>
        </form>        
    </div>
</div>
</div>
</div>
@stop