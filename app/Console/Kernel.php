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
           })
            ->where('order_status', 'booked')
            ->get();

            $orders2 = Order::doesntHave('payment')
            ->where('order_status', 'booked')
            ->get();
        

            if (! $orders->isEmpty()) {

                foreach($orders as $order) :

                    $this->process($order);

                endforeach;
            }

            if(! $orders2->isEmpty()){

                foreach($orders2 as $order2) :

                    $this->process($order2);

                endforeach;
            }
            
        })->everyTwoHours();
    }

    private function process($data)
    {
        if($data->ceated_at > Carbon::now()->subHours(2)->toDateTimeString()){

            $data->update([
                'order_status' => 'cancel'
            ]);

            $data->payment()?->update([
                'status' => 'EXPIRED'
            ]);

            $data->room()?->update([
                'status' => 'available',
                'booked_untill' => NULL,
                'stayed_untill' => NULL
            ]);

            info($data);
        }
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
