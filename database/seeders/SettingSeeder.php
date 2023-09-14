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
        Setting::set('wallet_address_TRC_20', 'TWzddromYPisoWFAkBhpuWvFErgMryyAjt');
        Setting::set('nowpayments_API_key', '');
        Setting::set('nowpayments_access_token', '');
        Setting::set('rango_1_desde', '1000');
        Setting::set('rango_1_hasta', '50000');
        Setting::set('porcentaje_rango_1', '10');
        Setting::set('rango_2_desde', '50001');
        Setting::set('porcentaje_rango_2', '16');
        Setting::set('porcentaje_comision', '6');
        Setting::set('deposito_minimo', '1000');
        Setting::set('deposito_maximo', '100000');
        Setting::save();
    }
}
