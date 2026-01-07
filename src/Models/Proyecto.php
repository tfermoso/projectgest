<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Tarea;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'proyecto_id';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'usuario_id'
    ];

    // Un proyecto pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'usuario_id',    // FK en proyecto
            'usuario_id'     // PK en usuario
        );
    }

    // Un proyecto tiene muchas tareas
    public function tareas()
    {
        return $this->hasMany(
            Tarea::class,
            'proyecto_id',   // FK en tareas
            'proyecto_id'
        );
    }
}
