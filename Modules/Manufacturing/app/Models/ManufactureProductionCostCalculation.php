<?php

namespace Modules\Manufacturing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Manufacturing\Database\Factories\ManufactureProductionCostCalculationFactory;

class ManufactureProductionCostCalculation extends Model
{
    use HasFactory;
    protected $table = 'manufacture_production_cost_calculations';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['production_id', 'name', 'amount'];

    // protected static function newFactory(): ManufactureProductionCostCalculationFactory
    // {
    //     // return ManufactureProductionCostCalculationFactory::new();
    // }
}
