

<table class="table align-items-center table-flush">

    <tr>
        <td width="150px" align="left"><img src="C:\xampp\htdocs\curricular\public\img\servinatal\servinatal.png"></td>
        
        <td  > <strong>Cuadro General de Estados de Citas<strong></td>
    </tr>

    <thead class="thead-light">
        <tr>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Epecialidad</th>
            <th scope="col">Citas Atendidas</th>
            <th scope="col">Citas Canceladas</th>
            <th scope="col">Citas Totales</th>
        </tr>
        
    </thead>

    <tbody>
        @foreach( $nomAp as $np)
        <tr>
           
            <td scope="row">
                {{$np->name}}
            </td>
            <td scope="row">
                {{$np->apellido}}
            </td>
            
            <td>
                {{$np->nombre}}
            </td>
            <td>
                100
            </td>
            <td>
               150
            </td>
            <td>
                250
             </td>
            
        </tr>
        @endforeach
    </tbody>
</table>