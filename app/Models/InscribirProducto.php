<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscribirProducto extends Model
{
    protected $fillable = ['IdRatificarProducto', 'FechaHora'];
    protected $primaryKey = 'InscribirProducto';
    public function ratificarProducto()
    {
        return $this->belongsTo(RatificarProducto::class, 'IdRatificarProducto');
    }
}
