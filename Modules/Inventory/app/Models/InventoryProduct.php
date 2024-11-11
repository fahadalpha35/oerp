<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\InventoryProductFactory;

class InventoryProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'company_id', 'category_id', 'brand_id', 'description', 'cost_price', 'selling_price',
    ];

    public function category(){
        return $this->hasOne(InventoryCategorie::class,'id','category_id');
    }

    // protected static function newFactory(): InventoryProductFactory
    // {
    //     // return InventoryProductFactory::new();
    // }
}
