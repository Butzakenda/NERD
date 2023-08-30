<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $fillable = ['user_id','Nombres','Apellidos','Correo','Tipo'];
    protected $primaryKey = 'IdAdministrador';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
