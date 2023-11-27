<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use App\ReqSurveyor;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $usersToChange = User::where('level', 'surveyor')
                ->where('created_at', '<=', now()->subHours(1)->toDateTimeString())
                ->get();
        
            foreach ($usersToChange as $user) {
                $user->level = 'teknisi';
                $user->save();
        
                // Cari dan perbarui RequesSurveyor yang masih 'pending' dengan 'expired'
                $reqSurveyor = ReqSurveyor::where('state', 'approve')->first();
                if ($reqSurveyor) {
                    $reqSurveyor->update([
                        'state' => 'expired',
                    ]);
                }
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
