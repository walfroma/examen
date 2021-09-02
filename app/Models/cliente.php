<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';


    protected $primaryKey = 'id';


    protected $fillable = ['nombre', 'apellido', 'edad', 'telefono', 'direccion',  'id'];


    public function facturas()
    {
        return $this->hasMany('App\Models\factura');

    }
}
