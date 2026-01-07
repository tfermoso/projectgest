<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;
use App\Models\Tarea;
class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'usuario_id';
   

    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];
// Un usuario tiene muchos proyectos
    public function projectos()
    {
        return $this->hasMany(Proyecto::class);
    }
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}