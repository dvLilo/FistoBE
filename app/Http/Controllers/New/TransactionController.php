<?php

namespace App\Http\Controllers\New;

use Illuminate\Http\Request;

use App\Models\New\Transaction;

use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input("search");

    $status = $request->input("status", "pending");
    $page = $request->input("page", 1);
    $rows = $request->input("rows", 10);

    // Filter Params
    $transacted_from = $request->input("transacted_from");
    $transacted_to = $request->input("transacted_to");
    $suppliers = $request->input("suppliers", []);
    $documents = $request->input("documents", []);
    $departments = $request->input("departments", []);

    return Transaction::latest("updated_at")->paginate($rows);
  }
}
