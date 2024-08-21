<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Emp_Id',
        'is_active',
        'designation_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function employee_basic_info()
    {
        return $this->hasOne(EmployeeBasicInfo::class, 'user_id');
    }
    public function employement_info()
    {
        return $this->hasOne(EmploymentDetails::class, 'user_id');
    }
    public function bank_details()
    {
        return $this->hasOne(EmployeeBankDetail::class, 'user_id');
    }
    public function employee_leave()
    {
        return $this->hasOne(EmployeeLeave::class, 'user_id');
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }
}
