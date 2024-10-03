<?php

namespace Modules\Manufacturing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Manufacturing\Database\Factories\ManufactureClientFactory;

class ManufactureClient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'city',
    ];
    public function order(){
        return $this->hasOne(ManufactureOrder::class, 'client_id','id');
    }
    // protected static function newFactory(): ManufactureClientFactory
    // {
    //     // return ManufactureClientFactory::new();
    // }
}
