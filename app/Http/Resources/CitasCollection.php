<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CitasCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($row, $key) {
            return [
                'IdCita' => $row->IdCita,
                'fec_registro' => $row->fec_registro    ,
                'IdHorario' => $row->IdHorario    ,
                'IdCliente' => $row->IdCliente    ,
                'IdUsuario' => $row->IdUsuario    ,
                'estado' => $row->estado    ,
                'nombreCliente' => $row->cliente->Nombres,
            ];
        });  
    }
}
