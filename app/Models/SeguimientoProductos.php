<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoProductos extends Model
{
    protected $fillable = ['IdCliente', 'IdAdministrador', 'IdSolicitud', 'CopiaRegistro', 'PeticionRevision', 'SolicitudAlianza', 'FechaMatricula', 'AvalRevision', 'FechaRevision', 'ProductoPatentado', 'FechaHoraInscripcion', 'IdColaborador'];
    protected $primaryKey = 'IdSeguimientoProductos';
    protected $table = 'SeguimientoProductos';
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'IdAdministrador');
    }
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'IdSolicitud');
    }
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'IdSeguimientoProductos');
    }
    public function producto()
    {
        return $this->hasMany(Producto::class, 'IdSeguimientoProductos');
    }
    
}
