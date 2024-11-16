<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\InventoryCategorieFactory;

class InventoryCategorie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','item_id','status'];

    public function item(){
        return $this->hasOne(InventoryItemCategory::class,'id','item_id');
    }
    // protected static function newFactory(): InventoryCategorieFactory
    // {
    //     // return InventoryCategorieFactory::new();
    // }
}
