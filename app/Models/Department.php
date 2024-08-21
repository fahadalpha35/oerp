<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'is_active'
    ];

    public function designations()
    {
        return $this->hasMany(Designation::class, 'department_id');
    }
}
