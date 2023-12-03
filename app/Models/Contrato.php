<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $fillable = ['IdColaborador','IdAdministrador','IdSeguimientoProductos','HojaVida','SeguroMedico','Documento','Contrato'];
    protected $primaryKey = 'IdContrato';
    protected $table = 'contratos';
    public function seguimientoProducto()
    {
        return $this->belongsTo(SeguimientoProductos::class, 'IdSeguimientoProducto');
    }
    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'IdColaborador');
    }
}
