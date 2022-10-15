<?php

namespace App\Console;

use App\Console\Commands\EnsureQueueListenerIsRunning;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
      /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        EnsureQueueListenerIsRunning::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
         $schedule->command('queue:checkup')->everyFiveMinutes();

         $schedule->call(function () {

           $orders = Order::whereHas('payment', function($query){
            $query->where('status', 'PENDING');
           })->where('created_at', '>',  Carbon::now()->subHours(2)->toDateTimeString())
            ->where('order_status', 'booked')
            ->get();

            info($orders);

            if (! $orders->isEmpty()) {
                foreach($orders as $order) :

                    $order->update([
                        'order_status' => 'cancel'
                    ]);

                    $order->payment()->update([
                        'status' => 'EXPIRED'
                    ]);

                    $order->room()->update([
                        'status' => 'available',
                        'booked_untill' => NULL,
                        'stayed_untill' => NULL
                    ]);

                endforeach;
            }
            
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
