<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaction_id',
        'tag_id',
        'date_received',
        'status',
        'date_status',
        'reason_id',
        'remarks',
        'distributed_id',
        'distributed_name'

    ];
}
