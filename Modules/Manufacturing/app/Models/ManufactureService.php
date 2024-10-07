<?php

namespace Modules\Manufacturing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufactureService extends Model
{
    use HasFactory;

    // Table name if different from the default model name
    protected $table = 'manufacture_services';

    // Fields that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
    ];

    /**
     * If you have any relationships, define them here.
     * For example, if the service belongs to a client:
     */
    public function client()
    {
        return $this->belongsTo(ManufactureClient::class);
    }

    /**
     * You can define any other necessary relationships or methods here.
     */
}
