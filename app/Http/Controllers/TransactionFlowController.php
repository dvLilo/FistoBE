<?php

namespace App\Http\Controllers;

use App\Methods\GenericMethod;
use App\Models\Approver;
use App\Models\Associate;
use App\Models\Tagging;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Methods\TransactionFlow;

class TransactionFlowController extends Controller
{
    public function updateInTransactionFlow(Request $request,$id){
        return TransactionFlow::updateInTransactionFlow($request,$id);
    }

    public function validateVoucherNo(Request $request){
        return TransactionFlow::validateVoucherNo($request);
    }

    public function validateChequeNo(Request $request){
        return TransactionFlow::validateChequeNo($request);
    }

    public function transfer(Request $request, $id){

       return TransactionFlow::transfer($request, $id);
    }

    public function multipleReceive(Request $request) {
        $process = $request->input('process');
        $transactions = $request->input('transactions');

        switch ($process) {
            case 'tag':
                foreach ($transactions as $transaction) {
                    Tagging::create([
                        'transaction_id' => $transaction ,
                        'status' => $process . '-receive',
                        'date_status' => date('Y-m-d'),
                    ]);
                }
                break;
            case 'voucher':
                foreach ($transactions as $transaction) {
                    Associate::create([
                        'transaction_id' => $transaction ,
                        'status' => $process . '-receive',
                        'date_status' => date('Y-m-d'),
                        'tag_id' => Transaction::where('id', $transaction)->first()->tag_no,
                    ]);
                }
                break;
            case 'approve':
                foreach ($transactions as $transaction){
                    Approver::create([
                        'tag_id' => Transaction::where('id', $transaction)->first()->tag_no,
                        'status' => $process . '-receive',
                        'date_status' => date('Y-m-d'),
                        'transaction_id' => $transaction,
                    ]);
                }
                break;
        }

        Transaction::whereIn('id', $transactions)
            ->update([
                'state' => 'receive',
                'status' => $process . '-receive',
            ]);

        return GenericMethod::resultResponse("receive", null, []);
    }

    public function multipleTag(Request $request) {
        $process = $request->input('process');
        $transactions = $request->input('transactions');
        $receipt_type = $request->input('receipt_type');
        $distributed_to = $request->input('distributed_to');

        $tagData = [
            'status' => $process . '-tag',
            'date_status' => date('Y-m-d'),
            'distributed_id' => data_get($distributed_to, 'id'),
            'distributed_name' => data_get($distributed_to, 'name'),
        ];

        foreach ($transactions as $transaction) {
            Tagging::create(array_merge(['transaction_id' => $transaction], $tagData));
        }

        foreach ($transactions as $transaction) {
            Transaction::where('id', $transaction)
                ->update([
                    'state' => 'tag',
                    'status' => $process . '-tag',
                    'receipt_type' => $receipt_type,
                    'distributed_id' => data_get($distributed_to, 'id'),
                    'distributed_name' => data_get($distributed_to, 'name'),
                    'tag_no' => GenericMethod::generateTagNo($receipt_type, $transaction)
                ]);
        }

        return GenericMethod::result(200, "Transaction has been saved.", []);

    }
    // public function pullRequest(Request $request){
    //     $process =  $request['process'];
    //     $subprocess =  $request['subprocess'];
    //     return TransactionFlow::pullRequest($process,$subprocess,$id=0);
    // }

    // public function pullSingleRequest(Request $request,$id){
    //     $process =  $request['process'];
    //     $subprocess =  $request['subprocess'];
    //     return TransactionFlow::pullSingleRequest($process,$subprocess,$id);
    // }

    // public function receivedRequest(Request $request,$id){
    //     return TransactionFlow::receivedRequest($request, $id);
    // }

    // public function searchRequest(Request $request){
    //     $process =  $request['process'];
    //     $subprocess =  $request['subprocess'];
    //     $search =  $request['search'];
    //     return TransactionFlow::searchRequest($process,$subprocess,$search);
    // }

}
