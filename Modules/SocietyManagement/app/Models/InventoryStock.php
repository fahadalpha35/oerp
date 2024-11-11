<?php

namespace Modules\SocietyManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\SocietyManagement\Database\Factories\InventoryStockFactory;

class InventoryStock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id', 'purchase', 'stock', 'purchase_return', 'sale', 'sale_return',
    ];

    // protected static function newFactory(): InventoryStockFactory
    // {
    //     // return InventoryStockFactory::new();
    // }
}
