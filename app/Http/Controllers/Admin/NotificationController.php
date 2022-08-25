<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('admin.notifications.index')->withNotifications($notifications);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification->type == 'App\Notifications\Orders\SendOrderCreatedNotifications') {
            $route = route('admin.orders.index');
        } elseif($notification->type == 'App\Notifications\Payments\PaymentStatusNotification'){
            $route = route('admin.finance.index');
        } elseif($notification->type == 'App\Notifications\RefundRequestNotification'){
            $route = route('admin.refund.index');
        }else {
            $route = route('admin.dashboard.index');
        }

        $notification = $notification->update(['read_at' => now()]);

        return redirect($route);
    }

    public function destroy(Request $request)
    {
        $notification = auth()->user()->notifications()->where('id', $request->id)->first();

        $notification->delete();

        return redirect(route('admin.notification.index'))->withSuccess('Berhasil Hapus Data');
    }
}
