<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $fillable = ['IdCliente','tipo','ruta','fechaCarga'];
    protected $primaryKey = 'IdDocumento';
    protected $table = 'documentos';
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente');
    }
}
