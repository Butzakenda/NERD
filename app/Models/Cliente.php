<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['IdDepartamento', 'IdCiudad', 'Documento', 'tipoDocumento', 'Nombres', 'Apellidos', 'CorreoELectronico', 'Telefono', 'SolicitudAlianza', 'FechaNacimiento','Foto'];
    protected $primaryKey = 'IdCliente';
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'IdDepartamento');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'IdCiudad');
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}

