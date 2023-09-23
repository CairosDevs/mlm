<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use App\Models\Profit;
use App\Models\Referral;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $capital = OrderPayment::where('user_id', Auth::user()->id)->where('type', 'deposit')->sum('amount');
        $profit = Profit::where('user_id', Auth::user()->id)->sum('profit');
        $referrals = Referral::where('user_id', Auth::user()->id)->count();
        $referralsProfit = 0;

        $withdraws = OrderPayment::where('user_id', Auth::user()->id)
                                    ->whereIn('type', ['withdraw', 'total'])
                                    ->where('status', 'paid')
                                    ->get()
                                    ->sum(function ($order) {
                                        return $order->amount + $order->profit;
                                    });
        $capitalDisp = $capital - $withdraws;

        $membership = OrderPayment::where('user_id', Auth::user()->id)->where('type', 'membership')->sum('amount');
        $withdrawsp = OrderPayment::where('user_id', Auth::user()->id)->whereIn('type', ['withdraw', 'total'])->where('status', 'paid')->sum('profit');

        $weekProfit = Profit::where('user_id', Auth::user()->id)
                            ->where('start', $this->getWeekRange()['inicio'])
                            ->sum('profit');

        ;

        $weeks = $this->getWeeksOfMonth();
        $start = $weeks[0]['inicio'];
        $end = end($weeks)['fin'];

        $monthProfit = Profit::where('user_id', Auth::user()->id)
                        ->whereBetween('end', [$start, $end])
                        //  ->where('start', $start)
                        //  ->where('end', $end)
                         ->sum('profit');

        $daysRegistered = Auth::user()->daysRegistered();
        // dd($monthProfit);


        return view('dashboard', compact(
            'capital',
            'profit',
            'referrals',
            'referralsProfit',
            'capitalDisp',
            'weekProfit',
            'monthProfit',
            'daysRegistered'
        ));
    }

    public function getWeekRange()
    {
        $today = new DateTime();
        $dayOfWeek = $today->format('N');

        // Si hoy es lunes (1) restamos 7 días, si no restamos los días correspondientes para llegar al lunes anterior
        $lastMonday = $today->sub(new DateInterval('P'.($dayOfWeek == 1 ? 7 : $dayOfWeek - 1).'D'));

        // Creamos una copia de la fecha del lunes y le sumamos 4 días para obtener el viernes
        $lastFriday = clone $lastMonday;
        $lastFriday->add(new DateInterval('P4D'));

        return [
                'inicio' => $lastMonday->format('m/d/Y'),
                'fin' => $lastFriday->format('m/d/Y'),
               ];
    }

    public function getWeeksOfMonth()
    {
        $today = new DateTime();
        $firstDayOfMonth = (new DateTime())->modify('first day of this month');
        $weeks = [];

        // Ajustamos el primer día al lunes más cercano en el pasado
        if ($firstDayOfMonth->format('N') != 1) {
            $firstDayOfMonth->modify('last monday');
        }

        while ($firstDayOfMonth < $today) {
            $weekStart = clone $firstDayOfMonth;
            $weekEnd = (clone $firstDayOfMonth)->modify('+4 days');

            if ($weekEnd > $today) {
                $weekEnd = $today;
            }

            $weeks[] = [
            'inicio' => $weekStart->format('m/d/Y'),
            'fin' => $weekEnd->format('m/d/Y'),
            ];

            $firstDayOfMonth->modify('+7 days');
        }

        return $weeks;
    }
}
