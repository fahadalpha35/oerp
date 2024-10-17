<?php

namespace Modules\Supplychain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Supplychain\Database\Factories\ScmPurchaseReturnFactory;

class ScmPurchaseReturn extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'purchase_id','total','note'
    ];

    public function purchase(){
        return $this->hasOne(ScmPurchases::class,'id','purchase_id');
    }
    // protected static function newFactory(): ScmPurchaseReturnFactory
    // {
    //     // return ScmPurchaseReturnFactory::new();
    // }
}
