

<table>
    
    <tbody>
       
            <tr>
                <td>Reporte</td>               
                        
            </tr>
      
    </tbody>
  
</table>
<table>
    <thead>
        <tr>
            <th>Fecha Atencion</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Estado</th>
             
        </tr>
    </thead>
    <tbody>
        @foreach($records as $item)
            <tr>
                <td>{{$item->fec_atencion}}</td>
                <td>{{$item->Nombres}}</td>
                <td>{{$item->empleado}}</td>     
                <td>{{$item->estado}}</td>
           
            </tr>
         @endforeach 
    </tbody>
</table>