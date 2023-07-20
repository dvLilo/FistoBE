<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'request_id',
        'date_received',
        'status',
        'reason_id',
        'remarks',
        'transaction_no',
        'user_id',
        'date_audit',
        // 'transaction_type'
    ];
}
