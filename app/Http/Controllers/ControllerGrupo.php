<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaGrupo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Cardex;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Swift;

class ControllerGrupo extends Controller
{
    public $id=0;

    public function mostgrupo()
    {
        //para llenar la tabla
        $selecgrup = DB::table('grupos')
            ->join('docentes',  'docentes.ID_DOCENTE', '=', 'grupos.ID_DOCENTE')
            ->join('modulos',  'grupos.ID_MODULO', '=', 'modulos.ID_MODULO')
            ->join('planestudios',  'modulos.ID_PLANESTUDIO', '=', 'planestudios.ID_PLANESTUDIO')
            ->select('docentes.*', 'grupos.*', 'modulos.*', 'planestudios.*')->get();
        //Pra llenar lo combo box
        $selecdocente = Docente::select(
            'ID_DOCENTE',
            'DOCENTE_NOMBRE',
            'DOCENTE_AP_MAT',
            'DOCENTE_AP_PAT',

        )->get();
        $selecplan = DB::table('planestudios')->get();
        $selecmod = DB::table('modulos')->get();


        return view('grupo', compact('selecgrup', 'selecplan', 'selecdocente', 'selecmod'));
    }

    public function agregagrupo(Request $informacion) {
        $selecmodulo = DB::table('grupos')->get();
        //llenar combo con los planes
       foreach($selecmodulo as $modulo){
        $this->id++;
       }
        $this->id++;

        DB::insert(
            'INSERT INTO `grupos` (`ID_GRUPO`, `ID_MODULO`, `ID_DOCENTE`, `GRUPO_TIPO`, `GRUPO_CLA`, `GRUPO_NOM_GRUPO`, `GRUPO_DES`, `GRUPO_NUM_ALUMNOS`, `GRUPO_LIMITE`, `GRUPO_DIAS`, `GRUPO_HORAS`, `GRUPO_TOTAL_HORAS`, `GRUPO_UBICACION` ) 
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [
                $this->id,
                $informacion->ID_MODULO,
                $informacion->ID_DOCENTE,
                $informacion->GRUPO_TIPO,
                $informacion->GRUPO_CLA,
                $informacion->GRUPO_NOM_GRUPO,
                $informacion->GRUPO_DES,
                0,
                $informacion->GRUPO_LIMITE,
                'lunes',
                $informacion->GRUPO_HORAS,  
                $informacion->GRUPO_TOTAL_HORAS,
                $informacion->GRUPO_UBICACION
            ]
        );

      return back();
    }



    public function edit($id)
    {

        $selecgrupo = DB::table('grupos')
            ->join('docentes',  'docentes.ID_DOCENTE', '=', 'grupos.ID_DOCENTE')
            ->join('modulos',  'modulos.ID_MODULO', '=', 'grupos.ID_MODULO')
            ->select(

                'docentes.*',
                'grupos.*',
                'modulos.*',

            )->where('ID_GRUPO', '=', $id)->get();

        //Pra llenar lo combo box
        $selecdocente = Docente::select(
            'ID_DOCENTE',
            'DOCENTE_NOMBRE',
            'DOCENTE_AP_MAT',
            'DOCENTE_AP_PAT',

        )->get();
        $selecplan = DB::table('planestudios')->get();
        $selecmod = DB::table('modulos')->get();



        return view('update/grupo', compact('selecgrupo', 'selecplan', 'selecdocente', 'selecmod'));
    }



    public function modificargrupo(Request $informacion, $id)

    {



        $selecalum = DB::table('grupos')->where('ID_GRUPO', $id)->update([

            'ID_MODULO' => $informacion->ID_MODULO,
            'ID_DOCENTE' => $informacion->ID_DOCENTE,
            'GRUPO_TIPO' => $informacion->GRUPO_TIPO,
            'GRUPO_CLA' => $informacion->GRUPO_CLA,
            'GRUPO_NOM_GRUPO' => $informacion->GRUPO_NOM_GRUPO,
            'GRUPO_DES' => $informacion->GRUPO_DES,
            'GRUPO_NUM_ALUMNOS' => $informacion->GRUPO_NUM_ALUMNOS,
            'GRUPO_LIMITE' => $informacion->GRUPO_LIMITE,
            'GRUPO_DIAS' => $informacion->GRUPO_DIAS,
            'GRUPO_HORAS' => $informacion->GRUPO_HORAS,
            'GRUPO_TOTAL_HORAS' => $informacion->GRUPO_TOTAL_HORAS,
            'GRUPO_UBICACION' => $informacion->GRUPO_UBICACION,
            






        ]);






        return redirect()->route('grupo.actualizado');
    }



    public function eliminargrupo($id){

        DB::table('grupos')->where('ID_GRUPO', '=', $id)->delete();
        

        return redirect()->route('grupo.actualizado');
    }
    
    public function cierregrupo($id){
        //DB::table('grupos')->where('ID_GRUPO', '=', $id)->delete();
        $selecgrupo = DB::table('grupos')
        ->join('modulos',  'modulos.ID_MODULO', '=', 'grupos.ID_MODULO')
        ->select(
            'grupos.*',
            'modulos.*',
        )->where('ID_GRUPO', '=', $id)->get();

        //OBTENER NIVEL DEL MODULO
        foreach($selecgrupo as $grupo){ 
            $nivel=$grupo->MODULO_NIVEL;
        }


        //$nivel=$selecgrupo->MODULO_NIVEL;

        $calificaciones=DB::table('calificaciones')->where('ID_GRUPO', '=', $id)->get();
        foreach($calificaciones as $cal){ 

         //OBTENER EL PROMEDIO FINAL DEL MODULO

        $cal1=$cal->CALIF_PARCIAL1;
        $cal2=$cal->CALIF_PARCIAL2;
        $promedio=($cal1+$cal2)/2;
        if($promedio < 70){
        $promedio=0;
        }
        //GUARDAR PROMEDIO FINAL EN CARDEX
           switch($nivel){
            case 1:
                
                 DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                'CARDEX_CALIF_MOD1' => $promedio,
                ]);
        
                break;
                case 2:
                    DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                        'CARDEX_CALIF_MOD2' => $promedio,
                        ]);
                    break; 
                    case 3:
                        DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                            'CARDEX_CALIF_MOD3' => $promedio,
                            ]);
                        break;
                        case 4:
                            DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                'CARDEX_CALIF_MOD4' => $promedio,
                                ]);
                            break;
                            case 5:
                                DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                    'CARDEX_CALIF_MOD5' => $promedio,
                                    ]);
                                break;
                                case 6:
                                    DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                        'CARDEX_CALIF_MOD6' => $promedio,
                                        ]);
                                    break;
                                    case 7:
                                        DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                            'CARDEX_CALIF_MOD7' => $promedio,
                                            ]);
                                        break;
                                        case 8:
                                            DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                'CARDEX_CALIF_MOD8' => $promedio,
                                                ]);
                                            break; 
                                            case 9:
                                                DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                    'CARDEX_CALIF_MOD9' => $promedio,
                                                    ]);
                                                break; 
                                                case 10:
                                                    DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                        'CARDEX_CALIF_MOD10' => $promedio,
                                                        ]);
                                                    break; 
                                                    case 11:
                                                        DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                            'CARDEX_CALIF_MOD11' => $promedio,
                                                            ]);
                                                        break; 
                                                        case 12:
                                                            DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                                'CARDEX_CALIF_MOD12' => $promedio,
                                                                ]);
                                                            break; 
                                                            case 13:
                                                                DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                                    'CARDEX_CALIF_MOD13' => $promedio,
                                                                    ]);
                                                                break; 
                                                default;
                                                     break;
           }
        //Eimina la calificacion del modulo del alumno
        DB::table('calificaciones')->where('ID_GRUPO', '=', $id)->delete();
        }
        //Eimina  las inscripciones relacionadas con el grupo
        DB::table('inscripciones')->where('ID_GRUPO', '=', $id)->delete();
         //Eimina el grupo
        DB::table('grupos')->where('ID_GRUPO', '=', $id)->delete();
        return redirect()->route('grupo.actualizado');
    }
}
