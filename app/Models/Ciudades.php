<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    protected $fillable = ['IdCiudad','IdDepartamento', 'Nombre'];
    protected $primaryKey = 'IdCiudad';
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'IdDepartamento');
    }
}
