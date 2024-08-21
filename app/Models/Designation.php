<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'department_id', 'is_active'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
