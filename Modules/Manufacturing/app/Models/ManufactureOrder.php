<?php

namespace Modules\Manufacturing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\Models\InventoryProduct;

// use Modules\Manufacturing\Database\Factories\ManufactureOrderFactory;

class ManufactureOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id', 'product_id', 'quantity', 'total', 'delivery_date', 'internal_notes'
    ];

    public function client(){
        return $this->hasOne(ManufactureClient::class, 'id', 'client_id');
    }
    public function order_cost(){
        return $this->hasMany(ManufactureOrderCostcalculation::class, 'order_id','id');
    }

    public function product(){
        return $this->hasOne(InventoryProduct::class, 'id','product_id');
    }
    public function production(){
        return $this->hasOne(ManufactureProduction::class, 'order_id', 'id');
    }

    // protected static function newFactory(): ManufactureOrderFactory
    // {
    //     // return ManufactureOrderFactory::new();
    // }
}
