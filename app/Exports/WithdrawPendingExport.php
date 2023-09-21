<?php

namespace App\Exports;

use App\Models\OrderPayment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class WithdrawPendingExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
                
                    [
                        '# Orden de retiro',
                        'Billetera',
                        'Usuario',
                        'Monto',
                        'Fecha solicitud',
                    ],
            ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderPayment::select('payment_id', 'e_wallets.wallet_id', DB::raw("CONCAT(users.name, ' ', users.\"lastName\") AS user_name"), 'amount', 'order_payments.created_at' )
        ->join('e_wallets', 'order_payments.user_id', '=', 'e_wallets.user_id')
        ->join('users', 'e_wallets.user_id', '=', 'users.id')
        ->where('type', 'withdraw')
        ->where('status', 'pending')
        ->get();
    }
}
