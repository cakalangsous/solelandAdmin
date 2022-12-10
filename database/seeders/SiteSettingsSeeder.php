<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSettings::insert([
            [
                'setting_name' => 'site_name',
                'setting_value' => 'Starter Kit'
            ],

            [
                'setting_name' => 'favicon',
                'setting_value' => 'site_settings/favicon.png'
            ],

            [
                'setting_name' => 'logo_small',
                'setting_value' => 'site_settings/logo_small.png'
            ],

            [
                'setting_name' => 'logo_big',
                'setting_value' => 'site_settings/logo_big.png'
            ],

            [
                'setting_name' => 'login_bg',
                'setting_value' => 'site_settings/login_bg.jpg'
            ],

            [
                'setting_name' => 'theme_color',
                'setting_value' => 'gradient-45deg-indigo-blue'
            ],

            [
                'setting_name' => 'add_btn_bg',
                'setting_value' => 'pink'
            ],

            [
                'setting_name' => 'add_btn_color',
                'setting_value' => 'white-text'
            ]
        ]);
    }
}
