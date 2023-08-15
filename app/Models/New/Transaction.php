<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;

  protected $fillable = [
    "users_id",
    "id_prefix",
    "id_no",
    "first_name",
    "middle_name",
    "last_name",
    "suffix",
    "department_details",

    "tag_no",
    "voucher_no",
    "voucher_month",

    "transaction_id",
    "request_id",

    "date_requested",
    "capex_no",

    "document_id",
    "document_type",
    "document_no",
    "document_amount",
    "document_date",
    "payment_type",

    "category_id",
    "category",
    "company_id",
    "company",
    "department_id",
    "department",
    "location_id",
    "location",
    "supplier_id",
    "supplier",

    "po_total_amount",
    "po_total_qty",
    "rr_total_qty",

    "balance_document_po_amount",
    "balance_document_ref_amount",
    "balance_po_ref_amount",
    "balance_po_ref_qty",

    "referrence_id",
    "referrence_type",
    "referrence_no",
    "referrence_amount",
    "referrence_qty",
    "referrence_total_amount",
    "referrence_total_qty",

    "pcf_name",
    "pcf_date",
    "pcf_letter",

    "utilities_from",
    "utilities_to",
    "utilities_category_id",
    "utilities_category",
    "utilities_account_no_id",
    "utilities_account_no",
    "utilities_consumption",
    "utilities_location_id",
    "utilities_location",
    "utilities_receipt_no",

    "payroll_from",
    "payroll_to",
    "payroll_client",
    "payroll_category_id",
    "payroll_category",
    "payroll_type",
    "payroll_control_no",

    "remarks",
    "state",
    "status",
    "reason_id",
    "reason",
    "reason_remarks",

    "total_gross",
    "total_cwt",
    "total_net",
    "period_covered",
    "prm_multiple_from",
    "prm_multiple_to",
    "cheque_date",
    "gross_amount",
    "witholding_tax",
    "net_amount",
    "release_date",
    "batch_no",
    "amortization",
    "interest",
    "cwt",
    "dst",
    "principal",
    "is_not_editable",
    "is_allowable",
  ];
}
