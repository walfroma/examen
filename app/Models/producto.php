<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;

    protected $table = 'productos';


    protected $primaryKey = 'id';


    protected $fillable = ['nombre', 'descipcion', 'stock', 'precio', 'estado','id', 'categoria_id'];

    public function detalle_ventas(){
        return $this->hasMany('App\Models\detalle_venta');
    }


}
