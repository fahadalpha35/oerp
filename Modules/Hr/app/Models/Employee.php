<?php

namespace Modules\Hr\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Hr\Database\Factories\EmployeeFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number', 
        'hire_date', 'job_title', 'department', 'salary', 
        'manager_id', 'status'
    ];

    protected static function newFactory(): EmployeeFactory
    {
        //return EmployeeFactory::new();
    }
}
