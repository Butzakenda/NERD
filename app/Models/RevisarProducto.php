<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisarProducto extends Model
{
    protected $fillable = ['IdMatricularProducto', 'AvalRevision', 'Fecha'];
    protected $table = 'revisarproductos';
    protected $primaryKey = 'IdRevisarProducto';
    public function matricularProducto()
    {
        return $this->belongsTo(MatricularProducto::class, 'IdMatricularProducto');
    }
}
