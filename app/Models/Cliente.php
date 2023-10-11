<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['IdDepartamento', 'IdCiudad', 'Documento', 'tipoDocumento', 'Nombres', 'Apellidos', 'CorreoELectronico', 'Telefono', 'SolicitudAlianza', 'FechaNacimiento', 'Foto', 'user_id'];
    protected $primaryKey = 'IdCliente';
    protected $table = 'Clientes';
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'IdCliente');
    }
}
