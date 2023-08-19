<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $fillable = ['IdDepartamento','Nombre'];
    protected $primaryKey = 'IdDepartamento';
    public function ciudades()
    {
        return $this->belongsTo(Ciudades::class, 'IdCiudad');
    }

}