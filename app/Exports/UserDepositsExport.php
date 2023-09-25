<?php

namespace App\Exports;

use App\Models\OrderPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserDepositsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
                
                    [
                        '# Orden de pago',
                        'Total',
                        'Estatus',
                        'Fecha',
                    ],
            ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderPayment::select('payment_id', 'amount', 'status', 'order_payments.created_at')
                            ->where('type', 'deposit')
                            ->where('user_id', Auth::user()->id)
                            ->get();
    }
}
