<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
    	$notifications = Auth::user()->notifications;
    	return view('admin.notifications.index', compact('notifications'));
    }

    public function show(DatabaseNotification $notification)
    {
    	abort_if($notification->notifiable_id != auth()->id(), 404);

    	$notification->markAsRead();

    	dd($notification->type);
    	
    	switch ($notifications->type) {
    		case 'App\Notifications\NewOrder':
    			return redirect()->route('orders');
    		default:
    			break;
    	}

    }

    public function markReadAll()
    {
    	Auth::user()->notifications->markAsRead();
    	return back();
    }
}
