@extends('layout/main')


@section('contenido-main')

<!--Cuadro a Salir para ModificarGrupo-->


<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Modificar Grupo</h5>

        </div>

        <div class="modal-body">
            @foreach ($selecgrupo as $informacion )
        <form action="{{ route('update.modificar-grupo', $informacion->ID_GRUPO ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">

                <div class="row">
                    <!--Columna 1-->
                    <div class="col-sm">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">ID:</label>
                                <input type="text" name="ID_GRUPO" value="{{ $informacion->ID_GRUPO }}"
                                    pattern="[A-Zz-a]{1,30}" class="form-control form-control-sm" maxlength="30"
                                    placeholder="ID" required disabled>
                                {!! $errors->first('ID_GRUPO','<span class="alert-danger">:message</span><br>')
                                !!}

                            </div>



                            <div class="row">
                                
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Modulo:</label>
                                        <select name="ID_MODULO" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required value="{{ old('ID_MODULO') }}">
                                            <?php foreach ($selecmod as $item){?>
                                            <option value="{{$item->ID_MODULO}}"><?php echo $item->RETICULA_NOMBRE;  ?> </option>
                                            <?php
                                                    }//cierro el foreach
                                                    ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipo:</label>
                                        <select name="GRUPO_TIPO" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>

                                            <option value="SEMANA">Semanal</option>
                                            <option value="SABATINO">Sabatino</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Clasificación:</label>
                                        <select name="GRUPO_CLA" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>

                                            <option value="INTERN">Internos</option>
                                            <option value="EXTERN">Externos</option>
                                            <option value="PROFES">Profesores</option>
                                            <option value="MIXTO">Mixto</option>

                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Docente :</label>
                                        <select name="ID_DOCENTE" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>

                                            <option value={{ $informacion->ID_DOCENTE}}>
                                                {{ $informacion->DOCENTE_NOMBRE }}
                                                {{ $informacion->DOCENTE_AP_PAT }} {{ $informacion->DOCENTE_AP_MAT }}
                                            </option>
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
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre Grupo:</label>
                                        <input type="tel" name="GRUPO_NOM_GRUPO" value="{{ $informacion->GRUPO_NOM_GRUPO }}"
                                             class="form-control form-control-sm"
                                            placeholder="" required>
                                        {!! $errors->first('GRUPO_NOM_GRUPO', '<span class="alert-danger">:message</span><br>') !!}

                                    </div>
                               
                            </div>

                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Dias:</label>
                                        <input type="tel" name="GRUPO_DIAS"  maxlength="25"
                                            class="form-control form-control-sm" placeholder="Dia"
                                            value="{{ $informacion->GRUPO_DIAS }}" required>
                                        {!! $errors->first('GRUPO_DIAS','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Numero de Alumnos:</label>
                                        <input type="tel" name="GRUPO_NUM_ALUMNOS"
                                            value="{{ $informacion->GRUPO_NUM_ALUMNOS }}" pattern="[0-9]{1,11}"
                                            maxlength="11" class="form-control form-control-sm"
                                            placeholder="Numero de Alumnos" required>
                                        {!! $errors->first('GRUPO_NUM_ALUMNOS','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Limite Alumnos:</label>
                                            <input type="number" name="GRUPO_LIMITE" value="{{ $informacion->GRUPO_LIMITE }}"
                                                 maxlength="4" class="form-control form-control-sm"
                                                placeholder="Limite de Alumnos" required>
                                            {!! $errors->first('GRUPO_LIMITE', '<span class="alert-danger">:message</span><br>') !!}

                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Aula Asignada:</label>
                                            <input type="text" name="GRUPO_UBICACION" value="{{ $informacion->GRUPO_UBICACION }}"
                                                 maxlength="5"
                                                class="form-control form-control-sm" placeholder="Aula" required>
                                            {!! $errors->first('GRUPO_UBICACION', '<span class="alert-danger">:message</span><br>') !!}

                                        </div>
                                    </div>
                    
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Horario</label>
                                            <input type="text" placeholder="Ejem: 10:00 - 15:00" name="GRUPO_HORAS" class="form-control form-control-sm"
                                                placeholder="Inicio" value='{{$informacion->GRUPO_HORAS}}' required>
                                            {!! $errors->first('GRUPO_HORAS', '<span class="alert-danger">:message</span><br>') !!}

                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Total horas:</label>
                                            <input type="text" name="GRUPO_TOTAL_HORAS"
                                                value="{{ $informacion->GRUPO_TOTAL_HORAS }}" 
                                                maxlength="11" class="form-control form-control-sm"
                                                placeholder="Total Horas" required>
                                            {!! $errors->first('GRUPO_TOTAL_HORAS', '<span class="alert-danger">:message</span><br>') !!}

                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm">
                                            <label for="exampleFormControlSelect1">Descripción:</label>
                                            <textarea  class="form-control" name="GRUPO_DES" maxlength="500" id="exampleFormControlTextarea1">{{ $informacion->GRUPO_DES }}</textarea>
                                            
                                    </div>
                                   
                                 </div>
                                 <div class="col-sm">
                                    <div class="form-group">
                                      
                                    </div>
                                </div>
                                
                            </div>


                        </div>

                    </div>

                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Modificar</button>
                </div>

            </div>

        </form>
        </div>
       
        
    </div>
</div>






<!--FIN CUADRO Modoficar Grupoo-->

@endsection