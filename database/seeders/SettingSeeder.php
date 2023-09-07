<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facades\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::set('app_name', 'MLM');
        Setting::set('wallet_address_TRC_20', 'actualice su direccion wallet');
        Setting::set('nowpayments_API_key', 'actualice su api key');
        Setting::set('nowpayments_access_token', 'actualice su Access Token');
        Setting::set('rango_bajo_from', '1000');
        Setting::set('rango_bajo_to', '50000');
        Setting::set('porcentaje_rango_bajo', '10');
        Setting::set('rango_alto_from', '50001');
        Setting::set('porcentaje_rango_alto', '16');
        Setting::save();
    }
}
