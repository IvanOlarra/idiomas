<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cardex;

class ControllerColocacion extends Controller{

    public function mostalumnos(){
        $selecalum = DB::table('alumnos')
        ->join('users',  'users.email', '=', 'alumnos.ALUMNO_CORREO')
        ->select('users.*', 'alumnos.*')->get();



         return view('colocacion', compact('selecalum'));
    }
    
    public function edit(){

        $selecalum = DB::table('alumnos')
        ->join('users',  'users.email', '=', 'alumnos.ALUMNO_CORREO')
        ->select('users.*', 'alumnos.*')->get();

        $selecmod = DB::table('modulos')->get();
        $selecplan = DB::table('planestudios')->get();

        

         return view('update/colocacion', compact('selecalum','selecmod','selecplan'));



    }
    
    public function modificarcolocacion(Request $informacion,$id){
        $mod=0;
        $mod=$informacion->MODULO_NIVEL;
        //Valida si el alumno no esta inscrito
        if(!Cardex::where('ID_ALUMNO',$id)->where('ID_PLANESTUDIO',$informacion->ID_PLANESTUDIO)->exists()){
        $this->inscripcion($id,$informacion->ID_PLANESTUDIO);
        }
        if($mod==0){
            for($i=1; $i<=10; $i++){
                DB::table('cardexes')->where('ID_ALUMNO', $id)->where('ID_PLANESTUDIO', $informacion->ID_PLANESTUDIO)->update([           
                    'CARDEX_CALIF_MOD'.$i => '0',
        
                ]);
            }
        }else{
            
        for ($i=1; $i<=$mod; $i++){
            DB::table('cardexes')->where('ID_ALUMNO', $id)->where('ID_PLANESTUDIO', $informacion->ID_PLANESTUDIO)->update([           
                'CARDEX_CALIF_MOD'.$i => '80',
    
            ]);
        }
        for($i=$mod+1; $i<=10; $i++){
            DB::table('cardexes')->where('ID_ALUMNO', $id)->where('ID_PLANESTUDIO', $informacion->ID_PLANESTUDIO)->update([           
                'CARDEX_CALIF_MOD'.$i => '0',
    
            ]);
        }
    }
        
    return redirect()->route('colocacion.actualizado');
    }

 
    public function inscripcion($id,$planEstudio){

        $cardex = DB::table('cardexes')->get();
        $idProgress=1;
        //llenar combo con los planes
       foreach($cardex as $c){
           $idProgress++;
       }
            $cardex=Cardex::create([
              'ID_CARDEX' => $idProgress,
              'ID_ALUMNO' => $id,
              'ID_PLANESTUDIO' => $planEstudio,
              'CARDEX_CALIF_MOD1' => 0,
              'CARDEX_CALIF_MOD2' => 0,
              'CARDEX_CALIF_MOD3' => 0,
              'CARDEX_CALIF_MOD4' => 0,
              'CARDEX_CALIF_MOD5' => 0,
              'CARDEX_CALIF_MOD6' => 0,
              'CARDEX_CALIF_MOD7' => 0,
              'CARDEX_CALIF_MOD8' => 0,
              'CARDEX_CALIF_MOD9' => 0,
              'CARDEX_CALIF_MOD10' => 0,
              'CARDEX_CALIF_MOD11' => 0,
              'CARDEX_CALIF_MOD12' => 0,
              'CARDEX_CALIF_MOD13' => 0,
              'CARDEX_ACREDITADO' => 'f',
             ]);
         
    }
    
}