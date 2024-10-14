<?php

namespace Modules\Supplychain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\Models\InventoryProduct;

// use Modules\Supplychain\Database\Factories\ScmPurchaseInfoFactory;

class ScmPurchaseInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['purchase_id','product_id','quantity','sale_price','purchase_price','total'];

    public function product(){
        return $this->hasOne(InventoryProduct::class,'id','product_id');
    }
    // protected static function newFactory(): ScmPurchaseInfoFactory
    // {
    //     // return ScmPurchaseInfoFactory::new();
    // }
}
