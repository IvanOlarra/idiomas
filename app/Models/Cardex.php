<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardex extends Model
{
    use HasFactory;

    public $primaryKey = 'ID_CARDEX';

    // autoincrement en PrimaryKey
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ID_CARDEX',
        'ID_ALUMNO',
        'ID_PLANESTUDIO'        
    ];
    //Atributos no asignables en masa
    protected $guarded = ['ID_CARDEX',];
}
