<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherAccountTitle extends Model
{
    use HasFactory;

    protected $table = "voucher_account_title";
    protected $fillable = [
        "associate_id"
        ,"treasury_id"
        ,"entry"
        ,"account_title_id"
        ,"account_title_name"
        ,"amount"
        ,"remarks"
        ,"transaction_type",
        "company_id",
        "company",
        "department_id",
        "department",
        "location_id",
        "location",
        "business_unit_id",
        "business_unit",
        "sub_unit_id",
        "sub_unit"
    ];

}
