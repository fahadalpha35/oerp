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
    protected $fillable = [];

    // protected static function newFactory(): ScmPurchasesFactory
    // {
    //     // return ScmPurchasesFactory::new();
    // }
}
