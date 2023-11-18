@extends('layouts.master')

@section('contenido')
    <div class="row">
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Editar Servicios
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('cita-edits') }}">
                        @csrf
                        <div class="form-row">
                        
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Cliente</label>
                                    <select class="form-control" id="IdCliente" name="IdCliente" required >
                                  
                                    @foreach ($cliente as $item)
                                    @if($cita->IdCliente == $item->IdCliente ) 
                                        <option value="{{ $item->IdCliente }}" selected>{{ $item->Nombres }}</option>
                                    @else
                                        <option value="{{ $item->IdCliente }}">{{ $item->Nombres }}</option>
                                    @endif
                                    
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Moto</label>
                                    <select class="form-control" id="IdMoto" name="IdMoto" required>
                                    
                                    @foreach ($moto as $item)
                                    @if($detalleCita->IdMoto == $item->Idmoto ) 
                                        <option value="{{ $item->IdMoto }}" selected>{{ $item->marca }}</option>
                                    @else
                                        <option value="{{ $item->IdMoto }}">{{ $item->marca }}</option>
                                    @endif
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Observacion</label>
                                    <input type="text" name="detalle_moto" id="detalle_moto" class="form-control" value="{{ $detalleCita->detalle_moto }}" required> 
                            </div>

                            
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    
                                    @if($cita->estado == 't' ) 
                                    <option value="t" selected>Atendido</option> 
                                    <option value="n">Nuevo</option>  
                                    @else
                                    <option value="n" selected>Nuevo</option>  
                                    <option value="t">Atendido</option> 
                                    @endif
                                         
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Categoria</label>
                                <select class="form-control" id="IdCategoria" name="IdCategoria" required>
                                    
                                    @foreach ($categoria as $item)
                                    @if($cita->IdCategoria == $item->IdCategoria ) 
                                        <option value="{{ $item->IdCategoria }}" selected>{{ $item->descripcion }}</option>
                                    @else
                                        <option value="{{ $item->IdCategoria }}">{{ $item->descripcion }}</option>
                                    @endif
                                    @endforeach
                                    </select>
                            </div>
                        
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Fecha</label>
                               <input type="date" name="fec_registro" id="fec_registro" class="form-control" value="{{ $cita->fec_registro }}" required>  
                            </div>
                
                        <input type="hidden" name="IdCita" id="IdCita" class="form-control" value="{{ $cita->IdCita }}" required>  
                        <input type="hidden" name="iddetallecita" id="iddetallecita" class="form-control" value="{{ $detalleCita->IdDetalleCita }}" required>  

                        <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
                        <button type="submit" class="btn btn-primary">{{ isset($cliente) ? 'Actualizar' : 'Registrar' }}
                            Cita</button>
                    </form>


                </div>

            </div>
        </div>
    </div>

    </div>
    </div>


@stop
