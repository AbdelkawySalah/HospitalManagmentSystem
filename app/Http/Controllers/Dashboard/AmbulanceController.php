<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use  App\Interfaces\Ambulances\AmbulanceRepositoryInterface; 
use App\Models\Ambulance;
use App\Http\Requests\StoreAmbulanceRequest;

class AmbulanceController extends Controller
{
    private $Ambulance;
    public function __construct(AmbulanceRepositoryInterface $Ambulance)
    {
       //Sections1 اصبح فيها كل اللي في ريبروستري 
        $this->Ambulance=$Ambulance;
    }

    public function index()
    {
        return  $this->Ambulance->index();
    }


    public function create()
    {
        return  $this->Ambulance->create();
    }

    
    public function store(StoreAmbulanceRequest $request)
    {
        return  $this->Ambulance->store($request);

    }


    
    public function edit($id)
    {
        return  $this->Ambulance->edit($id);
    }

    public function update(StoreAmbulanceRequest $request)
    {
        return  $this->Ambulance->update($request);

    }

    public function destroy(Request $request)
    {
        //
        return  $this->Ambulance->destroy($request);
    }
}
