<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaDocente;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerDocente extends Controller
{
    public function mostdocente()
    {
        //para llenar tabla

        $selecdocente = DB::table('docentes')
            ->join('users',  'users.email', '=', 'docentes.DOCENTE_CORREO')
            ->select('users.*', 'docentes.*')->get();


        return view('docente', compact('selecdocente'));
    }   

    public function agregadocente(Request $informacion)
    {
        
                 $id=1;
                 $docentes=DB::table('docentes')->get();
                 foreach( $docentes as $d){
                    $id++;
                 }
      
                DB::insert(
                    'INSERT INTO `docentes` (
                    `ID_DOCENTE`, `DOCENTE_CLAVE`, `DOCENTE_AP_PAT`, `DOCENTE_AP_MAT`, `DOCENTE_NOMBRE`, `DOCENTE_SEXO`, `DOCENTE_TIPO_SANGRE`,
                     `DOCENTE_FECHA_NAC`, `DOCENTE_CALLE`, `DOCENTE_COLONIA`, `DOCENTE_MUNICIPIO`, `DOCENTE_ESTADO`, `DOCENTE_MOVIL`, `DOCENTE_CASA`, 
                     `DOCENTE_CORREO`, `DOCENTE_GRADO_ESCOLAR`, `DOCENTE_ESPECIALIDAD`, `DOCENTE_FECHA_ING`, `DOCENTE_OBSERVACIONES`)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                    [
                        $id,
                        $informacion->DOCENTE_CLAVE,
                        $informacion->DOCENTE_AP_PAT,
                        $informacion->DOCENTE_AP_MAT,
                        $informacion->DOCENTE_NOMBRE,
                        $informacion->DOCENTE_SEXO,
                        $informacion->DOCENTE_TIPO_SANGRE,
                        $informacion->DOCENTE_FECHA_NAC,
                        $informacion->DOCENTE_CALLE,
                        $informacion->DOCENTE_COLONIA,
                        $informacion->DOCENTE_MUNICIPIO,
                        $informacion->DOCENTE_ESTADO,
                        $informacion->DOCENTE_MOVIL,
                        $informacion->DOCENTE_CASA,
                        $informacion->DOCENTE_CORREO,
                        $informacion->DOCENTE_GRADO_ESCOLAR,
                        $informacion->DOCENTE_ESPECIALIDAD,
                        $informacion->DOCENTE_FECHA_ING,
                        $informacion->DOCENTE_OBSERVACIONES,
                    ]

                );

                $contraseña= bcrypt(strtolower(substr($informacion->DOCENTE_NOMBRE,0,1).$informacion->DOCENTE_AP_PAT));

                User::create([
                    'name' => $informacion->DOCENTE_NOMBRE." ".$informacion->ALUMNO_APELLIDO_PAT,
                    'email' => $informacion->DOCENTE_CORREO,
                    'password' => $contraseña,
                ])->assignRole('Docente');
                return back();
            
        }



        
    


    //dif
    public function edit($id)
    {

        // Seleccionamos la informacion del docente a modificar y la mandamos a nueva pantalla

        $selecdocente = Docente::where('ID_DOCENTE', $id)->get();

        $correo = User::where('email', $selecdocente[0]->DOCENTE_CORREO)->get('email')->first()->email;

        return view('update/docente', compact('selecdocente', 'correo'));
    }



    public function modificardocente(Request $informacion, $id)

    {


        //Validamos que los campos sean correctos
        $informacion->validate([
            'DOCENTE_CLAVE' => 'required|max:30',
            'DOCENTE_AP_PAT' => 'required|max:30',
            'DOCENTE_AP_MAT' => 'max:30',
            'DOCENTE_NOMBRE' => 'required|max:30',
            'DOCENTE_SEXO' => 'required',
            'DOCENTE_TIPO_SANGRE' => 'max:5',
            'DOCENTE_FECHA_NAC' => 'required|date',
            'DOCENTE_CALLE' => 'required|max:30',
            'DOCENTE_COLONIA' => 'required|max:30',
            'DOCENTE_MUNICIPIO' => 'required|max:30',
            'DOCENTE_ESTADO' => 'required|max:30',
            'DOCENTE_GRADO_ESCOLAR' => 'max:30',
            'DOCENTE_ESPECIALIDAD' => 'max:30',
            'DOCENTE_FECHA_ING' => 'required|date',
            'DOCENTE_OBSERVACIONES' => 'required|max:500',
        ]);





        $selecalum = DB::table('docentes')->where('ID_DOCENTE', $id)->update([
            'DOCENTE_CLAVE' =>  $informacion->DOCENTE_CLAVE,
            'DOCENTE_AP_PAT' =>  $informacion->DOCENTE_AP_PAT,
            'DOCENTE_AP_MAT' =>  $informacion->DOCENTE_AP_MAT,
            'DOCENTE_NOMBRE' =>  $informacion->DOCENTE_NOMBRE,
            'DOCENTE_SEXO' =>  $informacion->DOCENTE_SEXO,
            'DOCENTE_TIPO_SANGRE' =>  $informacion->DOCENTE_TIPO_SANGRE,
            'DOCENTE_FECHA_NAC' =>  $informacion->DOCENTE_FECHA_NAC,
            'DOCENTE_CALLE' =>  $informacion->DOCENTE_CALLE,
            'DOCENTE_COLONIA' =>  $informacion->DOCENTE_COLONIA,
            'DOCENTE_MUNICIPIO' =>  $informacion->DOCENTE_MUNICIPIO,
            'DOCENTE_ESTADO' =>  $informacion->DOCENTE_ESTADO,
            'DOCENTE_MOVIL' =>  $informacion->DOCENTE_MOVIL,
            'DOCENTE_CASA' =>  $informacion->DOCENTE_CASA,
            'DOCENTE_GRADO_ESCOLAR' =>  $informacion->DOCENTE_GRADO_ESCOLAR,
            'DOCENTE_ESPECIALIDAD' =>  $informacion->DOCENTE_ESPECIALIDAD,
            'DOCENTE_FECHA_ING' =>  $informacion->DOCENTE_FECHA_ING,
            'DOCENTE_OBSERVACIONES' =>  $informacion->DOCENTE_OBSERVACIONES,






        ]);


        return redirect()->route('docente.actualizado');
    }



    public function eliminardocente($id)
    {
        //eliminamos el docente
        $id_user = DB::table('docentes')->join('users', 'users.email', '=', 'docentes.DOCENTE_CORREO')->where('ID_DOCENTE', '=', $id)->first('DOCENTE_CORREO');
        DB::table('users')->where('email', '=', $id_user->DOCENTE_CORREO)->delete();
        //Eliminamos la informacion de la Id mandada
        DB::table('docentes')->where('ID_DOCENTE', '=', $id)->delete();
      




        return redirect()->route('docente.actualizado');
    }
}
