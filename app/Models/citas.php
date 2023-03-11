<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;


class citas extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $primaryKey = 'id';
    protected $fillable=['id', 'mascota_id', 'fech_cita'];
}
