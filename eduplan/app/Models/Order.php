<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'student_id',
        'total_amount',
        'courses',
        'payment_status',
        'stripe_payment_id',
    ];

    protected $casts = [
        'courses' => 'array',
        'total_amount' => 'float',
    ];
}
