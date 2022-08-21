<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification->type == 'App\Notifications\Orders\SendOrderCreatedNotifications') {
            $route = route('admin.order.index');
        }  elseif($notification->type == 'App\Notifications\Payments\PaymentStatusNotification'){
            $route = route('admin.finance.index');
        }else {
            $route = route('admin.dashboard.index');
        }

        $notification = $notification->update(['read_at' => now()]);

        return redirect($route);
    }
}
