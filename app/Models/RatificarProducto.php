<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatificarProducto extends Model
{
    protected $fillable = ['IdRevisarProducto', 'ProductoPatentado', 'Fecha'];

    public function revisarProducto()
    {
        return $this->belongsTo(RevisarProducto::class, 'IdRevisarProducto');
    }
}

