<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification->type == 'App\Notifications\Orders\SendOrderCreatedNotifications') {
            $route = route('employee.order.index');
        }  elseif($notification->type == 'App\Notifications\Payments\PaymentStatusNotification'){
            $route = route('employee.finance.index');
        }else {
            $route = route('dashboard');
        }

        $notification = $notification->update(['read_at' => now()]);

        return redirect($route);
    }
}
