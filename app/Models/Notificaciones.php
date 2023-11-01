<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $fillable = ['IdCliente','IdProducto','IdColaborador','IdPQR','Tipo','Descripcion'];
    protected $primaryKey = 'IdNotificacion';
    protected $table = 'notificaciones';
    public function administrador() {
        return $this->belongsTo(Administrador::class, 'IdAdministrador');
    }
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }
}
