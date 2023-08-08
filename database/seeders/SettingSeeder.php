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
        Setting::set('aurpay_API_key', 'actualice su api key');
        Setting::set('aurpay_access_token', 'actualice su Access Token');
        Setting::set('rango_1_from', '10');
        Setting::set('rango_1_to', '50');
        Setting::set('rango_2_from', '51');
        Setting::set('rango_2_to', '1000');
        Setting::save();
    }
}
