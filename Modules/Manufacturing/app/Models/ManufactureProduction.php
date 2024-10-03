<?php

namespace Modules\Manufacturing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Manufacturing\Database\Factories\ManufactureProductionFactory;

class ManufactureProduction extends Model
{
    use HasFactory;
    protected $table = 'manufacture_productions';
    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = ['order_id', 'worker', 'duration','total'];

    public function order(){
        return $this->hasOne(ManufactureOrder::class, 'id', 'order_id');
    }
    public function production_cost(){
        return $this->hasMany(ManufactureProductionCostCalculation::class, 'production_id', 'id');
    }
    // protected static function newFactory(): ManufactureProductionFactory
    // {
    //     // return ManufactureProductionFactory::new();
    // }
}
