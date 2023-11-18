<?php 
use App\Models\Cita;
use App\Models\DetalleCita;

?>
@extends('layouts.master')
@section('contenido')
<div id="app">
<div class="card">
    <div class="card-body">
        <h2 class="card-title text-center">Lista de Citas</h2><br>

        <div class="col-md-12 p-3 form-inline">

            <form method="GET" action="{{ url('/buscarCita') }}">

                <input type="text" class="form-control" name="value" id="value">

                <button class="btn btn-primary ml-2" type="submit"><i class="fas fa-search mr-1"></i>Buscar</button>
            </form>

            <!-- <input type="text" class="form-control">
            <button class="btn btn-primary ml-2"><i class="fas fa-search mr-1"></i>Buscar</button> -->

            <!-- <a href="{{ url('/cita-create') }}" class="btn btn-primary ml-2">Nueva Cita</a> -->
            <a href="{{ url('/cita-create') }}" class="btn btn-primary ml-2">Nueva Cita</a>
            <a href="{{ url('/cita-export') }}" class="btn btn-success ml-2">Descargar Excel</a>

        </div>

        <div class="col-md-12 p-20 m-2 border">

            <table id="example" class="display" style="width:100%">
                <thead>
                    <th>Cod.</th>
                    <th>Fecha de Registro</th>
                    <th>Para la Fecha</th>
                    <th>Cliente</th>
                    <th>Categoria</th>
                    <th>Registrado por</th>
                    <th>Estado</th>
                    <th>Opciones</th>

                </thead>
                <tbody>
                    @foreach ($cita as $item)
                    <tr>
                        <td>{{$item->IdCita}}</td>
                       
                        <td>{{$item->horario->fec_atencion}}</td>
                        <td>{{$item->fec_registro}}</td>
                        <td>{{$item->cliente->Nombres}}</td>
                        <td>{{$item->categoria->descripcion}}</td>
                        <td>{{$item->usuario->nom_usuario}}</td>
                        <td>{{$item->estado=='n'?'Nuevo':'Atendido'}}</td>
                        <td>
                      <?php  
                      $id = $item->IdCita;
                      $data = Cita::find($id);
            $detalleCita = DetalleCita::where('Idcita', $id)->first(); 
            ?>

                            @if($item->estado=='n') 
                            <button class="btn btn-sm btn-primary" onclick="showAnteder({{$item->IdCita}})"> Marcar</button>
                          
                        
                            
                                    <a href="#ex1" rel="modal:open" onclick="cargar({{$item->IdCita}},'{{ $item->cliente->IdCliente}}','{{ $item->fec_registro}}','{{$item->categoria->IdCategoria}}','{{ @$item->estado }}','{{  @$detalleCita->detalle_moto }}','{{  @$detalleCita->IdMoto }}','{{  @$detalleCita->IdDetalleCita }}')" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-1"></i>Editar</a>  
                                    

                            <a href="/cita-delete/{{$item->IdCita}}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-edit mr-1"></i>Eliminar</a>
                            @else
                            <span>Cita terminada</span>
                            @endif                           
                        </td>                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="editCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('cita-finish') }}">
                            {!! csrf_field() !!}
                            <h2>Terminar esta cita</h2>
                            <br>
                            <input type="hidden" id="IdCita" name="IdCita" class="form-control">                            
                            <button type="submit" class="btn btn-success" id="btnGuardar">Terminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




<script>
    function showAnteder(IdCita){
       $("#editCita").modal('show');   
       $("#IdCita").val(IdCita);

    }
</script>

        <div id="ex1"  class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Cita</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
           
            <form method="POST" action="{{ route('cita-edits') }}">
                                @csrf
                                <div class="form-row">
                                
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Cliente</label>
                                            <select class="form-control" id="IdCliente" name="IdCliente" required >
                                        
                                            @foreach ($cliente as $item)
                                        
                                                <option id="Idcli{{ $item->IdCliente }}" value="{{ $item->IdCliente }}">{{ $item->Nombres }}</option>
                                            
                                            
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Moto</label>
                                            <select class="form-control" id="IdMoto" name="IdMoto" required>
                                            
                                            @foreach ($moto as $item)
                                        
                                                <option id="IdMot{{ $item->IdMoto }}" value="{{ $item->IdMoto }}">{{ $item->marca }}</option>
                                        
                                            @endforeach
                                            </select>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Observacion</label>
                                            <input type="text" name="detalle_moto" id="detalle_moto" class="form-control" value="" required> 
                                    </div>

                                    
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Estado</label>
                                        <select class="form-control" id="estado" name="estado" required>
                                            
                                            
                                            <option id="t" value="t" selected>Atendido</option> 
                                            <option id="n" value="n">Nuevo</option>  
                                        
                                                
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Categoria</label>
                                        <select class="form-control" id="IdCategoria" name="IdCategoria" required>
                                            
                                            @foreach ($categoria as $item)
                                        
                                                <option  id="Idcate{{ $item->IdCategoria }}" value="{{ $item->IdCategoria }}">{{ $item->descripcion }}</option>
                                            
                                            @endforeach
                                            </select>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">Fecha</label>
                                    <input type="date" name="fec_registro" id="fec_registro" class="form-control" value="" required>  
                                    </div>
                                    <div class="form-group col-md-6">
                                <input type="hidden" name="IdCita2" id="IdCita2" class="form-control" value="" required>  
                                <input type="hidden" name="iddetallecita" id="iddetallecita" class="form-control" value="" required>  
                                <br>
                                <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
                                <button type="submit" class="btn btn-primary">{{ isset($cliente) ? 'Actualizar' : 'Registrar' }}
                                    Cita</button>
                                    </div>
                            </form> 


                </div>
                        </div>
                    </div>
                    </div>
        </div>
<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1050;
  display: none;
  width: 100%;
  height: 80% !important;
  overflow: hidden;
  outline: 0;
}
    </style>



<script>
function cargar(a,b,c,e,z,x,f,k){

    $("#ex1").modal('show');   
      // $("#IdCita").val(IdCita);

    $("#fec_registro").val(c);
   // alert(e);
    //alert(b);
   // alert(c);

   // alert(f);

   $("#IdMot"+f).prop("selected", true);

   $("#IdCita2").val(a);
   $("#iddetallecita").val(k);

   $("#detalle_moto").val(x);
  
  // $("#Idcli"+b).prop("selectedIndex", 0);
   $("#Idcli"+b).prop("selected", true);

   $("#Idcate"+e).prop("selected", true);

   $("#"+z).prop("selected", true);

  
}
    </script>


</div></div></div>
@stop