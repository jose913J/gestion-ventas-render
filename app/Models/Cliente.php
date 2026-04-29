<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'cliente';
    
    // Clave primaria de la tabla
    protected $primaryKey = 'id_cliente';
    
    // Campos que se pueden llenar (mass assignment)
    protected $fillable = [
        'nombre',
        'telefono',
        'direccion'
    ];
    
    // Desactivar timestamps (created_at, updated_at)
    public $timestamps = false;
}

