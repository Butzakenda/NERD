<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatricularProducto extends Model
{
    protected $fillable = ['IdMatricularProducto','IdCliente','IdAdministrador','IdSolicitud','CopiaRegistro', 'PeticionRevision', 'SolicitudAlianza', 'Fecha'];
    protected $primaryKey = 'IdMatricularProducto';
    protected $table = 'matricularproductos';
    public function administrador() {
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
}
