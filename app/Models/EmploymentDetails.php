<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'salary',
        'job_type',
        'shift_start_time',
        'shift_end_time',
        'joining_date',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected function joiningDate(): Attribute
    {
        return new Attribute(
            set: fn($value) => date('Y-m-d', strtotime($value)),
            get: fn($value) => date('F d, Y', strToTime($value)),
        );
    }

}

