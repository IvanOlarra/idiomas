<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adeudo extends Model
{
    use HasFactory;

    public $timestamps = false;

    //deshabilitar autoincremento
    public $incrementing = false;

    //Especificamos el nombre de campo para la llave primaria
    protected $primaryKey = 'ID_ADEUDO';

    //Atributos de Grupo asignables en masa
    protected $fillable = [
        'ID_INSCRIPCION',
        'PLAN_NOMRE_IDIOMA',
        'ID_ALUMNO',
        'ADEUDO_MONTO',
        'ADEUDO_FECHA',
        'ADEUDO_PERIODO',
        'ADEUDO_DESCRIPCION',
    ];
}
