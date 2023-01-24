@extends('layout/main')

@section('contenido-main')



<div class="container">
    @if(Session::get('errorid'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Alerta!</h4>
        <p>{{ Session::get('errorid') }}</p>


    </div>
    @endif

</div>
<!--INICIO CUADRO SALIDA AGREGAR PLAN-->


<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Colocación de Alumno</h5>

        </div>
        @foreach ($selecalum as $informacion )
        <form action="{{ route('update.modificarcolocacion', $informacion->ID_ALUMNO ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="row>">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Alumno:</label>
                        <input type="text" name="ID_ALUMNO" class="form-control form-control-sm"
                            pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder=""
                            value=" {{ $informacion->ID_ALUMNO }}"
                            required disabled>


                    </div>
                </div>
            </div>
            <div class="row>">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Alumno:</label>
                        <input type="text"  class="form-control form-control-sm"
                            pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder=""
                            value=" {{ $informacion->ALUMNO_NOMBRE }} {{ $informacion->ALUMNO_APELLIDO_PAT }} {{ $informacion->ALUMNO_APELLIDO_MAT }}"
                            required disabled>


                    </div>
                </div>
            </div>
            <div class="row>">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Modulos Acreditados:</label>
                        <?php
                                        $cont = 13;
                                        ?>
                        <select name="MODULO_NIVEL" value="{{ old('MODULO_NIVEL') }}"
                            class="form-control form-control-sm">
                            <?php while ($cont >= 0) { ?>
                            <option value="<?php echo($cont); ?>">
                                <?php echo($cont); ?>
                            </option>
                            <?php $cont = ($cont-1); } ?>
                        </select>
                        {!! $errors->first('RET_ORD','<span class="alert-danger">:message</span><br>') !!}
                    </div>
                </div>
            </div>
            <div class="row>">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Plan de Estudio:</label>

                        <select name="ID_PLANESTUDIO" class="form-control form-control-sm"
                            id="exampleFormControlSelect1" required>


                            <?php foreach ($selecplan as $item) {?>
                            <option value='{{$item->ID_PLANESTUDIO}}'>
                                <?php echo $item->PLAN_NOMBRE_IDIOMA; ?>
                            </option>
                            <?php
                        }//cierro el foreach
                        ?>


                        </select>

                        {!! $errors->first('ID_PLANESTUDIO','<span class="alert-danger">:message</span><br>') !!}
                    </div>
                </div>
            </div>

        
            <div class="modal-footer">
                <a href="/colocacion" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>

            </div>
        </form>
        @endforeach

    </div>
</div>



<!--FINAL  CUADRO SALIDA MODIFICAR PLAN-->


@endsection