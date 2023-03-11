<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Softdeletes;


class clientes extends Model
{
    use HasFactory;
    //use Softdeletes;
    protected $primaryKey = 'id';
    protected $fillable=['id', 'cedu_clie', 'nomb_clie', 'apel_clie', 'celu_clie', 'emai_clie'];
}
