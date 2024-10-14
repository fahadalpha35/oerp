<?php

namespace Modules\Supplychain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Supplychain\Database\Factories\ScmPurchasesFactory;

class ScmPurchases extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'invoice_no',
        'sub_total',
        'delivary_cost',
        'service_cost',
        'total',
        'discount',
        'tax',
        'due',
        'paid'
    ];

    public function supplier(){
        return $this->hasOne(ScmSupplierManagement::class,'id','supplier_id');
    }
    public function purchase_info(){
        return $this->hasMany(ScmPurchaseInfo::class,'purchase_id','id');
    }
    // protected static function newFactory(): ScmPurchasesFactory
    // {
    //     // return ScmPurchasesFactory::new();
    // }
}
