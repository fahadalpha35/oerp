<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBankDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_holder_name',
        'account_number',
        'IBAN',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
