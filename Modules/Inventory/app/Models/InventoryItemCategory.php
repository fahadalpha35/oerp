<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\InventoryItemCategoryFactory;

class InventoryItemCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','active_status','company_id'];

    // protected static function newFactory(): InventoryItemCategoryFactory
    // {
    //     // return InventoryItemCategoryFactory::new();
    // }
}
