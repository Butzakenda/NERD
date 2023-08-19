<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PQR extends Model
{
    protected $fillable = ['IdColaborador', 'IdCliente', 'Tipo', 'Calidad', 'Descripcion'];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'IdColaborador');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }
}
