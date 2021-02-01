<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;



class NotificationController extends Controller
{
    public static function create($request, $content)
    {
    	$id = User::where('name', $request['username'])->first()->id;

    	Notification::create([
    		'user_id' => $id,
    		'seen' => 'no',
    		'content' => $content,
    	]);
    }

    public static function countNotifications()
    {
    	return auth()->user()->notifications()->where('seen', 'no')->count();
    }

    public function inbox()
    {
    	$notifications = auth()->user()->notifications()->get();
    	$notfs = auth()->user()->notifications()->get();
    	foreach ($notfs as $notification) {
    		if($notification->seen == 'no')
    		{
    			$notification->seen = 'yes';
    			$notification->save();
    		}
    	}
    	return view('notification.inbox', ['notifications' => $notifications]);
    }
}
