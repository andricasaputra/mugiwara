<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('employee.notifications.index')->withNotifications($notifications);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification->type == 'App\Notifications\Admin\AdminOrderCreatedNotifications') {
            $route = route('employee.order.index');
        } elseif($notification->type == 'App\Notifications\Admin\AdminPaymentStatusNotification'){
            $route = route('employee.finance.index');
        } elseif($notification->type == 'App\Notifications\RefundRequestNotification'){
            $route = route('employee.refund.index');
        }else {
            $route = route('employee.dashboard.index');
        }

        $notification = $notification->update(['read_at' => now()]);

        return redirect($route);
    }

    public function destroy(Request $request)
    {
        $notification = auth()->user()->notifications()->where('id', $request->id)->first();

        $notification->delete();

        return redirect(route('employee.notification.index'))->withSuccess('Berhasil Hapus Data');
    }
}
