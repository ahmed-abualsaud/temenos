<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Rules\UsernameExists;
use App\Rules\AmountLessThanBalance;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;
use App\Mail\Email;


class UserController extends Controller
{
    public function index()
    {
    	$notfs = NotificationController::countNotifications();
    	$cards = auth()->user()->cards;
        return view('user.index', ['balance' => $this->getTotalBalance(), 'notfs' => $notfs, 'cards' => $cards]);
    }


    public function transferView()
    {
    	$notfs = NotificationController::countNotifications();
    	$cards = auth()->user()->cards;
    	return view('user.transfer', ['cards' => $cards, 'balance' => $this->getTotalBalance(), 'notfs' => $notfs]);
    }




    public function transferMoney(Request $request)
    {

    	$card = auth()->user()->cards()->where('card_number', $request['card'])->first();

    	$rules = [
    		'card' => ['required', 'numeric'],
    		'username' => ['required', new UsernameExists],
    		'amount' => ['required', 'numeric', new AmountLessThanBalance($card->balance)],
    	];

    	$messages = [
    		'card.required' => 'Card Is Required',
    		'card.numeric' => 'Card Number Must Be Numeral',
    		'username.required' => 'Username Is Required',
    		'amount.required' => 'Transfer Amount Is Required',
    		'amount.numeric' => 'Transfer Amount Must Be Numeral',
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInputs($request->all());
    	}

    	//------------------------ update balance--------------------
    	$end_user = User::where('name', $request['username'])->first();
    	$default_card = $end_user->cards()->where('default_card', 'yes')->first();
    	$default_card->balance += $request['amount'];
    	$default_card->save();

    	$card->balance -= $request['amount'];
    	$card->save();

    	//----------------------- Create Transaction ------------------------
    	TransactionController::create($request);

    	//----------------------- Send Notification -------------------------

    	$sender = auth()->user()->name;
    	$card_number = User::where('name', $request['username'])->first()->cards()->where('default_card', 'yes')->first()->card_number;

    	$content = 'Hi '.$request['username'].'... '.$sender.' sent '.$request['amount'].'$ to your default card number '.$card_number;
    	

    	NotificationController::create($request, $content);

    	//-------------------------- Send Email -----------------------------

    	$data = [
    		'title' => 'Money Transfer',
    		'body'  => $content,
    	];
    	Mail::to($end_user->email)->send(new Email($data));


    	return redirect()->back()->with('success', 'Money Transfered Successfully');
    }


    public function uploadPhoto(Request $request)
    {
    	$file_extension = $request['photo']->getClientOriginalExtension();
    	$file_name = time().'.'.$file_extension;
    	$request['photo']->move('images/users', $file_name);
    	$user = auth()->user();
    	$user->photo = $file_name;
    	$user->save();

    	return redirect()->back();
    }

    private function getTotalBalance()
    {
    	$cards = auth()->user()->cards;
    	$balance = 0;
    	foreach ($cards as $card) {
    		$balance += $card->balance;
    	}

    	return $balance;
    }

}
