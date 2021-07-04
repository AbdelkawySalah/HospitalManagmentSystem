<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use  App\Models\Appointment;
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->delete();
        $Appointments=[
            ['name'=>'السبت'],
            ['name'=>'الأحد'],
            ['name'=>'الإثنين'],
            ['name'=>'الثلاثاء'],
            ['name'=>'الأربعاء'],
            ['name'=>'الخميس'],
            ['name'=>'الجمعة'],
        ];
        foreach($Appointments as $Appointment){
            Appointment::create($Appointment);
        }
    }
}
