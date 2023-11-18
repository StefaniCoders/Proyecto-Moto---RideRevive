@extends('layouts.master')

@section('contenido')
    <div class="row">
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     Servicios
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('cita-store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Cliente</label>
                                    <select class="form-control" id="IdCliente" name="IdCliente" required >
                                    <option value="" selected >Seleccione</option>   
                                    @foreach ($cliente as $item)
                                        <option value="{{ $item->IdCliente }}">{{ $item->Nombres }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Moto</label>
                                    <select class="form-control" id="Idmoto" name="Idmoto" required>
                                    <option value="0" selected >Seleccione</option>   
                                    @foreach ($moto as $item)
                                        <option value="{{ $item->IdMoto }}">{{ $item->marca }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Observacion</label>
                                    <input type="text" name="detalle_moto" id="detalle_moto" class="form-control" required> 
                            </div>

                            
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="" selected >Seleccione</option> 
                                    <option value="t">Atendido</option> 
                                    <option value="n">Nuevo</option>       
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Categoria</label>
                                <select class="form-control" id="IdCategoria" name="IdCategoria" required>
                                    <option value="" selected >Seleccione</option>   
                                    @foreach ($categoria as $item)
                                    @if($item->IdCategoria != 4)
                                        <option value="{{ $item->IdCategoria }}">{{ $item->descripcion }}</option>
                                       @endif
                                        @endforeach
                                    </select>
                            </div>
                        
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Fecha</label>
                               <input type="date" name="fec_registro" id="fec_registro" class="form-control" required>  
                            </div>
                
                        </div>

                        <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
                        <button type="submit" class="btn btn-primary">{{ isset($cliente) ? 'Registrar' : 'Registrar' }}
                            Cita</button>
                    </form>


                </div>

            </div>
        </div>
    </div>

    </div>
    </div>


@stop
