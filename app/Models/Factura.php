<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['IdProducto', 'IdCliente', 'IdColaboradorVenta', 'IdColaboradorCompra', 'FechaHora', 'MetodoPago', 'Total'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'IdProducto');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }

    public function colaboradorVenta()
    {
        return $this->belongsTo(Colaborador::class, 'IdColaboradorVenta');
    }

    public function colaboradorCompra()
    {
        return $this->belongsTo(Colaborador::class, 'IdColaboradorCompra');
    }
    
}
