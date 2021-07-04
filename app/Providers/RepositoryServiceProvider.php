<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Sections
use App\Interfaces\Sections\SectionRepositoryInterface; 
use App\Repository\Sections\SectionRepository;

//Doctors
use App\Interfaces\Doctors\DoctorRepositoryInterface; 
use App\Repository\Doctors\DoctorRepository;

//Service
use App\Interfaces\Services\SingleServiceRepositoryInterface; 
use App\Repository\Services\SingleServiceRepository;

//Insurance
use App\Interfaces\insurances\insuranceRepositoryInterface; 
use App\Repository\insurances\insuranceRepository;

//Ambulance
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface; 
use App\Repository\Ambulances\AmbulanceRepository;

//patients
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Repository\Patients\PatientRepository;

//Recipits
use App\Interfaces\Finance\ReceiptRepositoryInterface; 
use App\Repository\Finance\ReceiptRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class, SingleServiceRepository::class);
        $this->app->bind(insuranceRepositoryInterface::class, insuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
