<?php

use Illuminate\Database\Seeder;

class SettingsTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name' => 'laravel\'s Blog',
            'adress' => 'morroco rabat',
            'contact_number' => '054 564+ 64165 847',
            'contact_email' => 'jgjhgj@jhbjkh.com'
        ]);
    }
}
