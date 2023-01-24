@extends('layout/main')

@section('contenido-main')


<div class="container">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
    
                <h5>Colocación de Alumno

    
                </h5>
            </li>
    
    
        </ul>
    
    
    
    </div>
</div>
<div class="table-responsive-xl container">

    <table id="example" class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th>ID Alumno</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Opción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($selecalum as $item)
            <tr>
                <td>{{ $item->ID_ALUMNO }} </td>
                <td>{{ $item->email }} </td>

                <td>
                    {{ $item->ALUMNO_NOMBRE }} {{ $item->ALUMNO_APELLIDO_PAT }}
                    {{ $item->ALUMNO_APELLIDO_MAT }}
                </td>

                <td>
                    <center>

                        <a type="button" href="{{ route('update.colocacion', $item->ID_ALUMNO) }}" class="btn btn-primary ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>


                            Colocar</a>

                    </center>

                </td>


            </tr>
            @endforeach
        </tbody>
    </table>


</div>


@endsection