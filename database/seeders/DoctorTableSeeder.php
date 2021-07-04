<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Doctor;
class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //هنا بقوله انه هيتفذ الفاكتور بتاع دكتور 30 مرة
        $doctors =  Doctor::factory()->count(30)->create();
      
      //كل id doctor هيضع معاه appointment id عشوائي
        //ويضعه في جدول appointment_doctor
        foreach ($doctors as $doctor){
             //ثم يروح علي جدول مواعيد ويجيب الاي دي بتاع المواعيد اللي فيه ويحولها لمصفوفة
            $Appointments = Appointment::all()->random()->id;
            $doctor->doctorappointments()->attach($Appointments);
        }
        /*
        Doctor::factory()->count(30)->create();
        $Appointments=Appointment::all();
        Doctor::all()->each(function ($doctor) use ($Appointments)
         {
        $doctor->doctorappointments()->attach(
        $Appointments->random(rand(1,7))->pluck('id')->toArray()
         );
                   });
        */
            
    }
}
