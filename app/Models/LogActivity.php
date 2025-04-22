<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activities';

    protected $fillable = [
        'user_id',
        'nik',
        'ip_address',
        'otp_code',
        'otp_encrypt',
        'otp_valid_start',
        'otp_valid_until',
        'otp_verified_at',
        'login_at',
        'logout_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logActivityDetail()
    {
        return $this->hasMany(LogActivityDetail::class);
    }
}
