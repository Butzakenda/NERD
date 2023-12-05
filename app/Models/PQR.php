<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PQR extends Model
{
    protected $fillable = ['IdColaborador', 'IdCliente', 'IdAdministrador', 'Tipo', 'Calidad', 'Descripcion'];
    protected $primaryKey = 'IdQPR';
    protected $table = 'pqrs';
    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'IdColaborador');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }
    public function administrador(){
        return $this->belongsTo(Administrador::class, 'IdAdministrador');
    }
}
