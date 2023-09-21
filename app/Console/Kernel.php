<?php

namespace App\Console;

use App\Models\User;
use App\Models\Profit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use anlutro\LaravelSettings\Facades\Setting;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // procesar cierre y calcular ganancias a socios
        $schedule->call(function () {
            
            $lastMonday = Carbon::now()->subWeek()->startOfWeek();
            $lastFriday = Carbon::now()->subWeek()->endOfWeek()->subDays(2);

            $deposits = DB::table('transactions')
                            ->select('payable_id', DB::raw('SUM(amount) as total_amount'))
                            ->groupBy('payable_id')
                            ->get();

            foreach ($deposits as $userDeposits) {

                $profit = 0;
                $capital = $userDeposits->total_amount;

                if ($capital >= 1000 && $capital <= 50000) {
                    $percentage = Setting::get('porcentaje_rango_1')/100;
                } else if ($capital > 50000) {
                    $percentage = Setting::get('porcentaje_rango_2')/100;
                }

                $weeksInMonth = Carbon::now()->daysInMonth / 7;
                $weeklyPercentage = number_format( $percentage / $weeksInMonth , 2, '.', ',');

                $profit += $capital * $weeklyPercentage;

                Log::debug("probando squeduller  ==>> ", [$capital, $profit] );

                Profit::create([
                    'user_id' => $userDeposits->payable_id,
                    'start' => $lastMonday,
                    'end' => $lastFriday,
                    'capital' => $capital,
                    'profit' => $profit,
                ]);
            }
        })->fridays()->at('16:00');

        // procesar abrir retiros 
        $schedule->call(function () {
            User::query()->update(['can_withdraw' => true]);
        })->fridays()->at('16:01');

        // procesar cerrar retiros 
        $schedule->call(function () {
            User::query()->update(['can_withdraw' => false]);
        })->saturdays()->at('16:01');

        // procesar abonar ganancias retiros 
        $schedule->call(function () {

            $lastMonday = Carbon::now()->subWeek()->startOfWeek();
            $lastFriday = Carbon::now()->subWeek()->endOfWeek()->subDays(2);

            $profits = Profit::where('start', $lastMonday)
                            ->where('end', $lastFriday)
                            ->get();

            foreach ($profits as $userProfits) {

                $user = User::find($userProfits->user_id);
                $user->deposit((integer) $userProfits->profit);
                $user->save();
            }

        })->saturdays()->at('16:01');
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
