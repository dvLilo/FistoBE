<?php

namespace App\Http\Controllers;

use App\Methods\GenericMethod;
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

        Transaction::whereIn('id', $transactions)
            ->update([
                'state' => $process,
                'status' => $process . '-receive',
            ]);

//        foreach ($transactions as $transaction) {
//            Transaction::find($transaction)
//                ->update([
//                    'state' => $process,
//                    'status' => $process . '-received',
//                ]);
//        }

        return GenericMethod::resultResponse("receive", null, []);
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
