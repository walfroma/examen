<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_venta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';


    protected $primaryKey = 'id';


    protected $fillable = ['facturas_id', 'productos_id', 'cantidad', 'precio', 'subtotal', 'id'];

    public function facturas(){
        return $this->belongsTo('App\Models\factura');
    }

    public function productos(){
        return $this->belongsTo('App\Models\producto');
    }
}
