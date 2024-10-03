<?php

namespace Modules\Manufacturing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Manufacturing\Database\Factories\ManufactureOrderCostcalculationFactory;

class ManufactureOrderCostcalculation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_id','name','amount'
    ];

    // protected static function newFactory(): ManufactureOrderCostcalculationFactory
    // {
    //     // return ManufactureOrderCostcalculationFactory::new();
    // }
}
