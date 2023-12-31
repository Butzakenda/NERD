<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['IdSeguimientoProductos', 'IdDepartamento', 'IdCiudad', 'IdCategoria', 'IdColaborador', 'Nombre', 'Precio', 'Descripcion','Foto'];
    protected $primaryKey = 'IdProducto';
    protected $table = 'productos';
    public function seguimiento()
    {
        return $this->belongsTo(SeguimientoProductos::class, 'IdSeguimientoProductos');
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
        return $this->belongsTo(Departamentos::class, 'IdDepartamento');
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

