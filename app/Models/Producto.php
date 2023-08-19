<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['IdInscribirProducto', 'IdDepartamento', 'IdCiudad', 'IdCategoria', 'IdColaborador', 'Nombre', 'Precio', 'Descripcion'];

    public function inscribirProducto()
    {
        return $this->belongsTo(InscribirProducto::class, 'IdInscribirProducto');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'IdCategoria');
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'IdColaborador');
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'IdDepartamento');
    }

    public function ciudades()
    {
        return $this->belongsTo(Ciudad::class, 'IdCiudad');
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'IdProducto');
    }
}

