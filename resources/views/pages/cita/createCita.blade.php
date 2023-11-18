@extends('layouts.master')

@section('contenido')


    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/citas') }}" class="btn btn-sm btn-danger mr-2">Volver</a>
                    Nueva Cita
                </div>
                <div class="card-body">
                    @include('pages.cita.components.mini_calendar')
                </div>



            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('cita-store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Nombres</label>
                                <input type="text" class="form-control" id="Nombres" required name="Nombres"
                                    placeholder="Nombres" value="{{ $cliente->Nombres ?? null }}">
                                <input type="hidden" class="form-control" id="IdCliente" name="IdCliente"
                                    value="{{ $cliente->IdCliente ?? null }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Apelldios</label>
                                <input type="text" class="form-control" id="Apellidos" required name="Apellidos"
                                    placeholder="Apellidos" value="{{ $cliente->Apellidos ?? null }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">DNI</label>
                                <input type="text" class="form-control" id="DNI" required name="DNI"
                                    placeholder="DNI" value="{{ $cliente->DNI ?? null }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Correo</label>
                                <input type="email" class="form-control" id="correo" required name="correo"
                                    placeholder="correo" value="{{ $cliente->correo ?? null }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress">telefono</label>
                                <input type="text" class="form-control" id="telefono" required name="telefono"
                                    placeholder="telefono" value="{{ $cliente->telefono ?? null }}">
                            </div>
                        </div>

                        <!--   <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
                        <button type="submit" class="btn btn-primary">{{ isset($cliente) ? 'Actualizar' : 'Registrar' }}
                            Cliente</button>
                    </form>


                </div>

            </div>
        </div>
    </div>

    </div>
    </div>
<script>
$(document).ready(function () {
    {{ isset($mensaje)?"alert('$mensaje');":"" }}
});
</script>
@stop
