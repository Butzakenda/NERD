<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';

    protected $fillable = ['IdDepartamento', 'IdCiudad', 'Documento', 'Nombres', 'Apellidos', 'CorreoELectronico', 'Telefono', 'FechaNacimiento'];
    protected $primaryKey = 'IdColaborador';
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'IdDepartamento');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'IdCiudad');
    }
}
