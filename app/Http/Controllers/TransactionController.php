<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class TransactionController extends Controller
{
    public function list($pages)
    {
        $notfs = NotificationController::countNotifications();
    	$transactions = auth()->user()->transactions()->simplePaginate($pages);
    	$name = auth()->user()->name;
    	return view('transaction.list', ['transactions'=>$transactions, 'name'=>$name, 'notfs' => $notfs]);
    }

    public static function create($data)
    {
    	Transaction::create([
    		'user_id' => auth()->user()->id,
    		'end_user' => $data['username'],
    		'card' => $data['card'],
    		'type' => 'transfer',
    		'amount' => $data['amount'],
    	]);
    }
}
