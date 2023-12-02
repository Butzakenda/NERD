<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = ['IdSolicitud','IdEntrevista','IdAdministrador','IdCliente','Nombre','Tipo','Estado','Descripcion','Fecha'];
    protected $primaryKey = 'IdSolicitud';
    protected $table = 'Solicitudes';
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }
    public function administrador() {
        return $this->belongsTo(Administrador::class, 'IdAdministrador');
    }
    public function entrevista(){
        return $this->belongsTo(Entrevista::class, 'IdEntrevista');
    }
}
