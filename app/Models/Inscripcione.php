<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_INSCRIPCION';

    //Deshabilitar marcas de tiempo
    public $timestamps = false;

    //deshabilitar autoincremento
    public $incrementing = false;

    //atributos asignables en masa
    protected $fillable = [
        'ID_INSCRIPCION',
        'ID_GRUPO',
        'ID_ALUMNO',  
        'INSCRIPCION_NUM_FOLIO',
        'INSCRIPCION_MONTO',
        'INSCRIPCION_FECHA',
        'INSCRIPCION_ PERIODO',
    ];

    public function grupo()
    {
        return $this->hasMany(Grupo::class, 'ID_MODULO');
    }
}
