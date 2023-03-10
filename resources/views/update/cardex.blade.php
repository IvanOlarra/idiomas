@extends('layout/main')


@section('contenido-main')


<!--MODULO AGREGAR CARDEX-->


<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Modificar Cardex</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @foreach ($seleccardex as $informacion )
        <form action="{{ route('update.modoficar-cardex', $informacion->ID_CARDEX ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">


                <div class="row">
                    <div class="col-sm">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Clave:</label>
                            <input type="text" name="ID_CARDEX" class="form-control form-control-sm" maxlength="30"
                                placeholder="Clave" value="{{ $informacion->ID_CARDEX }}" required disabled>
                            {!! $errors->first('ID_CARDEX','<span class="alert-danger">:message</span><br>')
                            !!}

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Alumno:</label>

                            <select name="ID_ALUMNO" class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>


                                <option value={{ $informacion->ID_ALUMNO }}>{{$informacion->ALUMNO_NOMBRE  }}
                                    {{ $informacion->ALUMNO_APELLIDO_PAT }} {{ $informacion->ALUMNO_APELLIDO_MAT }}
                                </option>
                                <?php foreach ($selecalum as $item) {?> <option value="{{ $item->ID_ALUMNO }}">
                                    <?php echo $item->ALUMNO_NOMBRE," ",$item->	ALUMNO_APELLIDO_PAT , " ",$item->ALUMNO_APELLIDO_MAT; ?>
                                </option>
                                <?php
                                            }//cierro el foreach
                                            ?>


                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Grupo:</label>

                            <select name="CARDEX_ID_GRUPO_NOMBRE" class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>


                                <option>{{ $informacion->ID_GRUPO_NOMBRE }} </option>
                                <?php foreach ($selecgrupo as $item) {?> <option>
                                    <?php echo $item->	ID_GRUPO_NOMBRE ; ?> </option>
                                <?php
                                            }//cierro el foreach
                                            ?>


                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Plan de Estudio:</label>

                            <select name="CARDEX_ID_PLANESTUDIO" class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>



                                <option>{{ $informacion->ID_PLANESTUDIO }} </option>
                                <?php foreach ($selecplan as $item) {?> <option>
                                    <?php echo $item->	ID_PLANESTUDIO ; ?> </option>
                                <?php
                                            }//cierro el foreach
                                            ?>


                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Docente:</label>

                            <select name="CARDEX_ID_DOCENTE" class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>



                                <option value={{ $informacion->ID_DOCENTE }}>{{ $informacion->DOCENTE_NOMBRE }}
                                    {{ $informacion->DOCENTE_AP_PAT }} {{$informacion->DOCENTE_AP_MAT  }}</option>
                                <?php foreach ($selecdocente as $item)  {?>

                                <option value={{ $item->ID_DOCENTE}}>

                                    <?php  echo $item->	DOCENTE_NOMBRE," ", $item->	DOCENTE_AP_PAT," ", $item->	DOCENTE_AP_MAT ; 
                                            
                                                
                                            ?>
                                    </>

                                    <?php
                                       
                              
                                                }//cierro el foreach
                                                ?>


                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Modulo:</label>

                            <select name="ID_MODULO" class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>

                                <option>{{$informacion->ID_MODULO  }}</option>
                                <?php foreach ($selecmodulo as $item) {?> <option>
                                    <?php echo $item->ID_MODULO; ?> </option>
                                <?php
                                            }//cierro el foreach
                                            ?>


                            </select>

                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="form-group ">
                            <label for="exampleFormControlInput1 ">Fecha de
                                Nacimiento:</label>

                            <input name="CARDEX_FECHA" class="form-control form-control-sm" type="date"
                                value={{ $informacion->CARDEX_FECHA }} id="example-date-input" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Calificacion Id:</label>

                            <select name="CARDEX_ID_CALIFICACION" class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>


                                <option>{{ $informacion->ID_CALIFICACION }}</option>
                                <?php foreach ($seleccalificacion as $item) {?> <option>
                                    <?php echo $item->ID_CALIFICACION; ?> </option>
                                <?php
                                            }//cierro el foreach
                                            ?>


                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"> CAR_CAL:</label>
                            <input name="CAR_CAL" value="{{$informacion->CAR_CAL }}" type="tel" maxlength="11"
                                pattern="[0-9]{1,11}" class="form-control form-control-sm"
                                placeholder="Carga Calificacion" required>
                            {!! $errors->first('CAR_CAL','<span class="alert-danger">:message</span><br>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">CAR_PER_C:</label>
                            <input type="text" name="CAR_PER_C" pattern="[a-zZ-A]{1,8}" maxlength="8"
                                class="form-control form-control-sm" placeholder="CAR_PER_C"
                                value="{{ $informacion->CAR_PER_C }}" required>
                            {!! $errors->first('CAR_PER_C','<span class="alert-danger">:message</span><br>') !!}


                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">CAR_ACR:</label>
                            <input type="text" name="CAR_ACR" pattern="[a-zZ-A]{1,1}" maxlength="1"
                                class="form-control form-control-sm" placeholder="CAR_ACR"
                                value="{{ $informacion->CAR_ACR}}" required>
                            {!! $errors->first('CAR_ACR','<span class="alert-danger">:message</span><br>') !!}


                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Agregar</button>

            </div>
        </form>

    </div>
</div>




<!--FINAL MODULO AGREAR CARDEX-->



@endsection