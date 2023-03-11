<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;


class mascotas extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $primaryKey = 'id';
    protected $fillable=['id', 'nomb_masc', 'cliente_id', 'tipo_mascota_id'];
}
