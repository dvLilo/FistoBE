<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    use HasFactory;

    protected $table = 'treasuries';

    protected $fillable = [
        "transaction_id",
        "tag_id",
        "status",
        "date_status",
        "reason_id",
        "reason_remarks"
    ];

    public function account_title(){
        return $this->hasMany(VoucherAccountTitle::class,'treasury_id','id')->select('id','treasury_id','entry',
        'account_title_id','account_title_name','amount','remarks','transaction_type',
            'company_id',
            'company_code',
            'company_name',
            'department_id',
            'department_code',
            'department_name',
            'location_id',
            'location_code',
            'location_name',
            'business_unit_id',
            'business_unit_code',
            'business_unit_name',
            'sub_unit_id',
            'sub_unit_code',
            'sub_unit_name',
        );
    }

    public function cheques(){
        return $this->hasMany(Cheque::class,'treasury_id','id');
    }
}
