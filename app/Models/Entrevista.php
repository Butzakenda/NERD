<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $fillable = ['IdAdministrador','Entrevistador','Fecha','Aval'];
    protected $primaryKey = 'IdEntrevista';
    protected $table = 'Entrevistas';
}
