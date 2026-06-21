<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auth\Database\Factories\OtpFactory;

class Otp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'otp',
        'expires_at'
    ];

    // protected static function newFactory(): OtpFactory
    // {
    //     // return OtpFactory::new();
    // }
}
