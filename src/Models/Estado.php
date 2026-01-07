<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = 'estado_id';
   

    protected $fillable = [
        'nombre',
    ];

}