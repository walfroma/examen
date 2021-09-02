<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';


    protected $primaryKey = 'id';


    protected $fillable = ['cliente_id', 'fecha', 'descuento', 'total', 'usuario_id', 'id'];

    public function negocios(){
        return $this->belongsTo('App\Models\negocio');
    }

    public function clientes(){
        return $this->belongsTo('App\Models\cliente');
    }

    public function detalle_venta(){
        return $this->hasMany('App\Models\detalle_venta');
    }
}
