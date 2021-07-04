<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Patients\PatientRepositoryInterface; 

use App\Http\Requests\StorePatientRequest;

class PatientController extends Controller
{
    private $Patient;
    public function __construct(PatientRepositoryInterface $Patient)
    {
       //Sections1 اصبح فيها كل اللي في ريبروستري 
        $this->Patient=$Patient;
    }
    public function index()
    {
        return $this->Patient->index();

    }

    public function create()
    {
        return $this->Patient->create();

    }

    
    public function store(StorePatientRequest $request)
    {
        return $this->Patient->store($request);

    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        return $this->Patient->edit($id);
    }

    public function update(StorePatientRequest $request)
    {
        return $this->Patient->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Patient->destroy($request);
    }
}
