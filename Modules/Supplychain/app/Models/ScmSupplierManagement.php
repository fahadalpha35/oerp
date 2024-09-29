<?php

namespace Modules\Supplychain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Supplychain\Database\Factories\ScmSupplierManagementFactory;

class ScmSupplierManagement extends Model
{
    use HasFactory;
    protected $table = 'scm_supplier_managements';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'company',
        'area',
        'address',
    ];

    // protected static function newFactory(): ScmSupplierManagementFactory
    // {
    //     // return ScmSupplierManagementFactory::new();
    // }
}
